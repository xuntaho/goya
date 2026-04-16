import mysql.connector
from selenium import webdriver
from selenium.webdriver.common.by import By
from time import sleep
import re

# ===== DB =====
conn = mysql.connector.connect(
    host="localhost",
    user="thao",
    password="",
    database="db_tour"
)
cursor = conn.cursor()

# ===== DRIVER =====
driver = webdriver.Chrome()
driver.maximize_window()

print("🚀 START")

# ===== LOAD LIST =====
driver.get("https://www.luavietours.com/du-lich/du-lich-trong-nuoc")
sleep(3)

driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
sleep(2)

elems = driver.find_elements(By.CSS_SELECTOR, ".tour-lst section.item")

links = []

# ===== LỌC LINK SẠCH =====
for elem in elems:
    try:
        link = elem.find_element(By.CSS_SELECTOR, "a").get_attribute("href")

        # ❌ BỎ LINK RÁC
        if any(x in link for x in ["test", "momo", "tet", "-2", "-3"]):
            continue

        link = link.split("?")[0]

        img = elem.find_element(By.CSS_SELECTOR, "img")
        hinh = img.get_attribute("data-src") or img.get_attribute("src")

        links.append((link, hinh))

    except:
        continue

print("👉 Link sạch:", len(links))

# ===== SCRAPE DETAIL =====
for link, hinh in links:
    try:
        print("➡️", link)

        driver.get(link)
        sleep(3)

        # ❌ BỎ 404
        if "404" in driver.title.lower():
            print("❌ 404:", link)
            continue

        # ===== TITLE =====
        title = driver.find_element(By.CSS_SELECTOR, "h1").text

        print("✔", title)

        # ===== INSERT TOUR =====
        cursor.execute(
            "INSERT INTO tours (title, hinh) VALUES (%s, %s)",
            (title, hinh)
        )
        tourID = cursor.lastrowid

        # ===== SCROLL =====
        for _ in range(3):
            driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
            sleep(1)

        # ===== LẤY ẢNH =====
        imgs = driver.find_elements(By.CSS_SELECTOR, ".gallery .item img")

        image_urls = []

        for img in imgs:
            url = img.get_attribute("data-src") or img.get_attribute("src")

            if url and "http" in url:
                image_urls.append(url)

        # xóa trùng
        image_urls = list(set(image_urls))

        print("👉 Ảnh:", len(image_urls))

        # ===== INSERT IMAGE =====
        for url in image_urls:
            cursor.execute(
                "INSERT INTO image (tourID, imgurl) VALUES (%s, %s)",
                (tourID, url)
            )

        conn.commit()

    except Exception as e:
        print("💥 Lỗi:", e)
        continue

# ===== DONE =====
print("✅ DONE")

driver.quit()
cursor.close()
conn.close()