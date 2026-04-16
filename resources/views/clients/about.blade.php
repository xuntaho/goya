@include('clients.blocks.header')
@include('clients.blocks.banner')


 <!-- About Area start -->
        <section class="about-area-two py-100 rel z-1">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-xl-3" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                        <span class="subtitle mb-35">Về chúng tôi</span>
                    </div>
                    <div class="col-xl-9">
                        <div class="about-page-content" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                            <div class="row">
                                <div class="col-lg-8 pe-lg-5 me-lg-5">
                                    <div class="section-title mb-25">
                                        <h2>Đơn vị lữ hành chuyên nghiệp giàu kinh nghiệm tại Việt Nam</h2>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="experience-years rmb-20">
                                        <span class="title bgc-secondary">Năm kinh nghiệm</span>
                                        <span class="text">Chúng tôi có</span>
                                        <span class="years">5+</span>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <p>Chúng tôi mang đến những hành trình khám phá đầy thú vị, giúp bạn cảm nhận trọn vẹn nhịp sống và vẻ đẹp riêng của từng điểm đến. 
                                        Đồng hành cùng bạn, đội ngũ hướng dẫn viên sẽ dẫn lối qua những con phố nhộn nhịp, các địa danh nổi tiếng và cả những góc nhỏ bình dị ít người biết đến.</p>
                                    <ul class="list-style-two mt-35">
                                        <li>Kinh nghiệm dày dặn</li>
                                        <li>Đội ngũ chuyên nghiệp</li>
                                        <li>Chi phí hợp lý</li>
                                        <li>Hỗ trợ online 24/7</li>
                                    </ul>
                                    <a href="{{ route('tours') }}" class="theme-btn style-three mt-30">
                                        <span data-hover="Khám phá Tours">Khám phá Tours</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Area end -->
        
        
        <!-- Features Area start -->
        <section class="about-features-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-4 col-md-6">
                        <div class="about-feature-image" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/about/about-feature1.jpg') }}" alt="About">
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6">
                        <div class="about-feature-image" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/about/about-feature2.jpg') }}" alt="About">
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-8">
                        <div class="about-feature-boxes" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                            <div class="feature-item style-three bgc-secondary">
                                <div class="icon-title">
                                    <div class="icon"><i class="flaticon-award-symbol"></i></div>
                                    <h5><a href="{{ route('tours') }}">Chúng tôi là công ty đạt được nhiều giải thưởng</a></h5>
                                </div>
                                <div class="content">
                                    <p>Tại Pinnacle Business Solutions được ghi nhận nhờ cam kết về chất lượng và sự đổi mới.</p>
                                </div>
                            </div>
                            <div class="feature-item style-three bgc-primary">
                                <div class="icon-title">
                                    <div class="icon"><i class="flaticon-tourism"></i></div>
                                    <h5><a href="{{ route('tours') }}">5000+ Điểm đến du lịch phổ biến</a></h5>
                                </div>
                                <div class="content">
                                    <p>Đội ngũ chuyên gia của chúng tôi luôn tận tâm xây dựng các chiến lược tiên tiến, góp phần tạo nên thành công.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Features Area end -->
        
        
        <!-- About Us Area start -->
        <section class="about-us-area pt-70 pb-100 rel z-1">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-5 col-lg-6">
                        <div class="about-us-content rmb-55" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                            <div class="section-title mb-25">
                                <h2>Du lịch trọn niềm tin <br> Lý do bạn nên chọn chúng tôi</h2>
                            </div>
                            <p>Chúng tôi đồng hành cùng khách hàng để thấu hiểu những thách thức và mục tiêu, 
                                từ đó mang đến các giải pháp tối ưu giúp nâng cao hiệu quả, gia tăng lợi nhuận và hướng đến phát triển bền vững.</p>
                            <div class="row pt-25">
                                <div class="col-6">
                                    <div class="counter-item counter-text-wrap">
                                        <span class="count-text k-plus" data-speed="3000" data-stop="3">0</span>
                                        <span class="counter-title">Điểm đến phổ biến</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="counter-item counter-text-wrap">
                                        <span class="count-text m-plus" data-speed="3000" data-stop="9">0</span>
                                        <span class="counter-title">Khách hàng hài lòng</span>
                                    </div>
                                </div>
                            </div>      
                            <a href="{{ route('tours') }}" class="theme-btn mt-10 style-two">
                                <span data-hover="Khám phá các điểm đến">Khám phá các điểm đến</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-7 col-lg-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                        <div class="about-us-page">
                            <img src="{{ asset('clients/assets/images/about/about-page.jpg') }}" alt="About">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Us Area end -->
         
         
        <!-- Team Area start -->
        <section class="about-team-area pb-70 rel z-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h2>Gặp gỡ đội ngũ hướng dẫn viên giàu kinh nghiệm</h2>
                            <p>Webiste <span class="count-text plus bgc-primary" data-speed="3000" data-stop="34500">0</span> mang đến những trải nghiệm đáng nhớ nhất bạn từng có</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/guide1.jpg') }}" alt="Guide">
                            <div class="content">
                                <h6>John L. Simmons</h6>
                                <span class="designation">Co-founder</span>
                                <div class="social-style-one inner-content">
                                    <a href="contact.html"><i class="fab fa-twitter"></i></a>
                                    <a href="contact.html"><i class="fab fa-facebook-f"></i></a>
                                    <a href="contact.html"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/guide2.jpg') }}" alt="Guide">
                            <div class="content">
                                <h6>Andrew K. Manley</h6>
                                <span class="designation">Senior Guide</span>
                                <div class="social-style-one inner-content">
                                    <a href="contact.html"><i class="fab fa-twitter"></i></a>
                                    <a href="contact.html"><i class="fab fa-facebook-f"></i></a>
                                    <a href="contact.html"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/guide3.jpg') }}" alt="Guide">
                            <div class="content">
                                <h6>Drew J. Bridges</h6>
                                <span class="designation">Travel Guide</span>
                                <div class="social-style-one inner-content">
                                    <a href="contact.html"><i class="fab fa-twitter"></i></a>
                                    <a href="contact.html"><i class="fab fa-facebook-f"></i></a>
                                    <a href="contact.html"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/guide4.jpg') }}" alt="Guide">
                            <div class="content">
                                <h6>Byron F. Simpson</h6>
                                <span class="designation">Travel Guide</span>
                                <div class="social-style-one inner-content">
                                    <a href="contact.html"><i class="fab fa-twitter"></i></a>
                                    <a href="contact.html"><i class="fab fa-facebook-f"></i></a>
                                    <a href="contact.html"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Team Area end -->
        
        
        <!-- Features Area start -->
        <section class="about-feature-two bgc-black pt-100 pb-45 rel z-1">
            <div class="container">
                <div class="section-title text-center text-white counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                    <h2>Vì sao nên chọn GOYA Tours & Travels</h2>
                    <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> mang đến những trải nghiệm đáng nhớ nhất bạn từng có</p>
                </div>
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="feature-item style-two">
                            <div class="icon"><i class="flaticon-save-money"></i></div>
                            <div class="content">
                                <h5><a href="{{ route('tours') }}">Cam kết giá tốt nhất</a></h5>
                                <p>Cắm trại bằng lều là một cách tuyệt vời để hòa mình vào thiên nhiên</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                        <div class="feature-item style-two">
                            <div class="icon"><i class="flaticon-travel-1"></i></div>
                            <div class="content">
                                <h5><a href="{{ route('tours') }}">Điểm đến đa dạng</a></h5>
                                <p>Đạp xe địa hình là một môn thể thao đầy phấn khích, giúp nâng cao sức khỏe và thể lực</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                        <div class="feature-item style-two">
                            <div class="icon"><i class="flaticon-booking"></i></div>
                            <div class="content">
                                <h5><a href="{{ route('tours') }}">Đặt tour nhanh chóng</a></h5>
                                <p>Chèo thuyền kayak là một hoạt động ngoài trời đầy thú vị, mang lại cảm giác phiêu lưu và hào hứng</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500" data-aos-offset="50">
                        <div class="feature-item style-two">
                            <div class="icon"><i class="flaticon-guidepost"></i></div>
                            <div class="content">
                                <h5><a href="{{ route('tours') }}">Hướng dẫn viên chuyên nghiệp</a></h5>
                                <p>Câu cá và đi thuyền là những hoạt động đặc trưng, mang đến cảm giác thư giãn và những trải nghiệm thú vị</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shape">
                <img src="{{ asset('clients/assets/images/video/shape1.png') }}" alt="shape">
            </div>
        </section>
        <!-- Features Area end -->
        
        
        
        
        
        



@include('clients.blocks.footer')