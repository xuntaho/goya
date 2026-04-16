<footer class="main-footer bgs-cover overlay rel z-1 pb-25" style="background-image: url({{ asset('clients/assets/images/backgrounds/footer.jpg') }});">
            <div class="container">
                <div class="footer-top pt-100 pb-30">
                    <div class="row justify-content-between">
                        <div class="col-xl-5 col-lg-6" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="footer-widget footer-text">
                                <div class="footer-logo mb-25">
                                    <a href="{{ route('home') }}"><img src="{{ asset('clients/assets/images/logos/logo-5.png') }}" alt="Logo"></a>
                                </div>
                                <p>Chúng tôi thiết kế những hành trình riêng biệt theo sở thích của bạn, đảm bảo mọi chuyến đi đều suôn sẻ, phong phú và khám phá được những viên ngọc ẩn giấu.</p>
                                <div class="social-style-one mt-15">
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-youtube"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-twitter"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                            <div class="section-title counter-text-wrap mb-35">
                                <h2>Đăng ký nhận tin</h2>
                                <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> nơi tập hợp những trải nghiệm phổ biến và đáng nhớ nhất</p>
                            </div>
                            <form class="newsletter-form mb-50" action="#">
                                <input id="news-email" type="email" placeholder="Email Address" required>
                                <button type="submit" class="theme-btn bgc-secondary style-two">
                                    <span data-hover="Subscribe">Đăng ký</span>
                                    <i class="fal fa-arrow-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="widget-area pt-95 pb-45">
                <div class="container">
                    <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2">
                        <div class="col col-small" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="footer-widget footer-links">
                                <div class="footer-title">
                                    <h5>Dịch vụ</h5>
                                </div>
                                <ul class="list-style-three">
                                    <li><a href="{{ route('huongdanvien') }}">Hướng dẫn viên tốt nhất</a></li>
                                    <li><a href="{{ route('tours') }}">Đặt tour</a></li>
                                    <li><a href="{{ route('noiden') }}">Đặt khách sạn</a></li>
                                    <li><a href="{{ route('noiden') }}">Đặt vé</a></li>
                                    <li><a href="{{ route('noiden') }}">Dịch vụ cho thuê</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-small" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                            <div class="footer-widget footer-links">
                                <div class="footer-title">
                                    <h5>Công ty</h5>
                                </div>
                                <ul class="list-style-three">
                                    <li><a href="{{ route('about') }}">Về chúng tôi</a></li>
                                    <li><a href="{{ route('blog') }}">Blog cộng đồng</a></li>
                                    <li><a href="{{ route('contact') }}">Cơ hội và việc làm</a></li>
                                    <li><a href="{{ route('blog') }}">Blog mới nahats</a></li>
                                    <li><a href="{{ route('contact') }}">Liên hệ</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-small" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                            <div class="footer-widget footer-links">
                                <div class="footer-title">
                                    <h5>Điểm đến</h5>
                                </div>
                                <ul class="list-style-three">
                                    <li><a href="{{ route('noiden') }}">Đà Nẵng</a></li>
                                    <li><a href="{{ route('noiden') }}">Phú Quốc</a></li>
                                    <li><a href="{{ route('noiden') }}">Hà Nội</a></li>
                                    <li><a href="{{ route('noiden') }}">Lào Cai</a></li>
                                    <li><a href="{{ route('noiden') }}">Quảng Bình</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-small" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500" data-aos-offset="50">
                            <div class="footer-widget footer-links">
                                <div class="footer-title">
                                    <h5>Danh mục</h5>
                                </div>
                                <ul class="list-style-three">
                                    <li><a href="{{ route('contact') }}">Mạo hiểm</a></li>
                                    <li><a href="{{ route('contact') }}">Đi bộ và leo núi</a></li>
                                    <li><a href="{{ route('contact') }}">Đạp xe đạp</a></li>
                                    <li><a href="{{ route('contact') }}">Tour gia đình</a></li>
                                    <li><a href="{{ route('contact') }}">Du lịch hoang dã</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-md-6 col-10 col-small" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                            <div class="footer-widget footer-contact">
                                <div class="footer-title">
                                    <h5>Liên hệ</h5>
                                </div>
                                <ul class="list-style-one">
                                    <li><i class="fal fa-map-marked-alt"></i> 180 Cao Lỗ, Phường 4, Quận 8, TP.HCM</li>
                                    <li><i class="fal fa-envelope"></i> <a href="mailto:xuanthao0214@gmail.com">xuanthao0214@gmail.com</a></li>
                                    <li><i class="fal fa-clock"></i> T2 - T6, 08am - 05pm</li>
                                    <li><i class="fal fa-phone-volume"></i> <a href="callto:+88012334588">+880 (123) 345 88</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom pt-20 pb-5">
                <div class="container">
                    <div class="row">
                       <div class="col-lg-5">
                            <div class="copyright-text text-center text-lg-start">
                                <p>@Copy 2024 <a href="{{ route('home') }}">Goya</a>, All rights reserved</p>
                            </div>
                       </div>
                       <div class="col-lg-7 text-center text-lg-end">
                           <ul class="footer-bottom-nav">
                               <li><a href="{{ route('about') }}">Điều khoản</a></li>
                               <li><a href="{{ route('about') }}">Chính sách bảo mật</a></li>
                               <li><a href="{{ route('about') }}">Thông báo pháp lý</a></li>
                               <li><a href="{{ route('about') }}">Khả năng tiếp cận</a></li>
                           </ul>
                       </div>
                    </div>
                    <!-- Scroll Top Button -->
                    <button class="scroll-top scroll-to-target" data-target="html"><img src="{{ asset('clients/assets/images/icons/scroll-up.png') }}" alt="Scroll  Up"></button>
                </div>
            </div>
        </footer>
        <!-- footer area end -->

    </div>
    <!--End pagewrapper-->
   
    
    <!-- Jquery -->
    <!-- 1. jQuery -->
<script src="{{ asset('clients/assets/js/jquery-3.6.0.min.js') }}"></script>

<!-- 2. Plugin -->
<script src="{{ asset('clients/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/appear.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/skill.bars.jquery.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('clients/assets/js/aos.js') }}"></script>

<!-- 3. jQuery UI + datetime -->
<script src="{{ asset('clients/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('clients/assets/css_login/js/jquery.datetimepicker.full.min.js') }}"></script>

<!-- 4. Script phụ -->
<script src="{{ asset('clients/assets/js/script.js') }}"></script>

<!-- 5. Custom (LUÔN CUỐI) -->
<script src="{{ asset('clients/assets/js/custom.js') }}"></script>


</body>
</html>
