<!-- Hero Area Start -->
<section class="hero-area bgc-black pt-200 rpt-120 rel z-2">
    <div class="container-fluid">
        <h1 class="hero-title" data-aos="flip-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">tour
            & Travel</h1>
        <div class="main-hero-image bgs-cover"
            style="background-image: url({{ asset('clients/assets/images/hero/hero.jpg') }});"></div>
    </div>
    <form action="{{ route('search') }}" method="GET">
        <div class="container container-1400">
            <div class="search-filter-inner" data-aos="zoom-out-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-map-marker-alt"></i></div>
                    <span class="title">Điểm đến</span>

                    <select name="mien" id="mien">
                        <option value="">Tất cả</option>
                        <option value="Bac">Miền Bắc</option>
                        <option value="Trung">Miền Trung</option>
                        <option value="Nam">Miền Nam</option>
                    </select>
                </div>


                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-calendar-alt"></i></div>
                    <span class="title">Ngày khởi hành</span>
                    <input type="text" id="start_date" name="start_date" class="datetimepicker custom"
                        placeholder="Chọn ngày đi" readonly>
                </div>
                <div class="filter-item clearfix">
                    <div class="icon"><i class="fal fa-calendar-alt"></i></div>
                    <span class="title">Ngày kết thúc</span>
                    <input type="text" id="end_date" name="end_date" class="datetimepicker custom"
                        placeholder="Chọn ngày về" readonly>
                </div>

                <div class="search-button">
                    <button class="theme-btn">
                        <span data-hover="Tìm kiếm">Tìm kiếm</span>
                        <i class="far fa-search"></i>
                    </button>
                </div>
            </div>
    </form>
</section>
<!-- Hero Area End -->