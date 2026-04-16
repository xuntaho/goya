@include('clients.blocks.header')
@include('clients.blocks.banner')
     <!-- Benefit Area start -->
        <section class="benefit-area mt-100 rel z-1">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-5 col-lg-6">
                        <div class="mobile-app-content rmb-55" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="section-title counter-text-wrap mb-40">
                                <h2>Cẩm nang khám phá<br> Hướng dẫn đầy đủ cho mọi chuyến đi</h2>
                            </div>
                            <p>Chúng tôi đồng hành cùng khách hàng để thấu hiểu những thách thức và mục tiêu, 
                                từ đó mang đến các giải pháp tối ưu giúp nâng cao hiệu quả, gia tăng lợi nhuận và hướng đến phát triển bền vững.</p>
                            <div class="skillbar mt-80" data-percent="93">
                                <span class="skillbar-title">Mức độ hài lòng của khách hàng</span>
                                <div class="progress-bar-striped skillbar-bar progress-bar-animated" role="progressbar" aria-valuenow="93" aria-valuemin="0" aria-valuemax="100"></div>
                                <span class="skill-bar-percent"></span>
                            </div>
                            <ul class="list-style-two mt-35 mb-30">
                                <li>Kinh nghiệm dày dặn</li>
                                <li>Đội ngũ chuyên nghiệp</li>
                            </ul>
                            <a href="{{ route('about') }}" class="theme-btn style-two">
                                <span data-hover="Khám phá cẩm nang du lịch">Khám phá cẩm nang du lịch</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="benefit-image-part style-two">
                            <div class="image-one" data-aos="fade-down" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                                <img src="{{ asset('clients/assets/images/benefit/benefit1.png') }}" alt="Benefit">
                            </div>
                            <div class="image-two" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                                <img src="{{ asset('clients/assets/images/benefit/benefit2.png') }}" alt="Benefit">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Benefit Area end -->
         
         
        <!-- Team Area start -->
        <section class="about-team-area pt-100 rel z-1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h2>Gặp gỡ đội ngũ hướng dẫn viên giàu kinh nghiệm</h2>
                            <p>Website <span class="count-text plus bgc-primary" data-speed="3000" data-stop="34500">0</span> mang đến những trải nghiệm đáng nhớ nhất bạn từng có</p>
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
                                    <a href="{{ route('contact') }}"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest-p"></i></a>
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
                                    <a href="{{ route('contact') }}"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest-p"></i></a>
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
                                    <a href="{{ route('contact') }}"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest-p"></i></a>
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
                                    <a href="{{ route('contact') }}"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/guide5.jpg') }}" alt="Guide">
                            <div class="content">
                                <h6>John L. Simmons</h6>
                                <span class="designation">Co-founder</span>
                                <div class="social-style-one inner-content">
                                    <a href="{{ route('contact') }}"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/guide6.jpg') }}" alt="Guide">
                            <div class="content">
                                <h6>Andrew K. Manley</h6>
                                <span class="designation">Senior Guide</span>
                                <div class="social-style-one inner-content">
                                    <a href="{{ route('contact') }} "><i class="fab fa-twitter"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/guide7.jpg') }}" alt="Guide">
                            <div class="content">
                                <h6>Drew J. Bridges</h6>
                                <span class="designation">Travel Guide</span>
                                <div class="social-style-one inner-content">
                                    <a href="{{ route('contact') }} "><i class="fab fa-twitter"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-6">
                        <div class="team-item hover-content" data-aos="fade-up" data-aos-delay="150" data-aos-duration="1500" data-aos-offset="50">
                            <img src="{{ asset('clients/assets/images/team/guide8.jpg') }}" alt="Guide">
                            <div class="content">
                                <h6>Byron F. Simpson</h6>
                                <span class="designation">Travel Guide</span>
                                <div class="social-style-one inner-content">
                                    <a href="{{ route('contact') }} "><i class="fab fa-twitter"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ route('contact') }}"><i class="fab fa-pinterest-p"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center mt-20">
                        <a href="{{ route('about') }}" class="theme-btn style-three">
                            <span data-hover="Xem tất cả hướng dẫn viên">Xem tất cả hướng dẫn viên</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- Team Area end -->
        
        
@include('clients.blocks.letter')
@include('clients.blocks.footer')