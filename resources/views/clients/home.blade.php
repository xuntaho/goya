@include('clients.blocks.header_home')
@include('clients.blocks.bannerhome')
<!--Form Back Drop-->
<div class="form-back-drop"></div>
  <!-- Destinations Area start -->
        <section class="destinations-area bgc-black pt-100 pb-70 rel z-1">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-lg-12">
                        <div class="section-title text-white text-center counter-text-wrap mb-70" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <h2>Khám phá Việt Nam cùng GoYa</h2>
                            <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> với những trải nghiệm được yêu thích nhất</p>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    @foreach ($tours as $tour)
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                        <div class="destination-item hh" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image">
                                <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{ $tour->hinh }}" alt="Tour">
                            </div>
                            <div class="content">
                                <span class="location"><i class="fal fa-map-marker-alt"></i> {{ $tour->diemden }}</span>
                                <h5><a href="{{ route('chitiet_tour', ['id' => $tour->tourID]) }}">{{ $tour->title }}</a></h5>
                                @php
                                    $start = \Carbon\Carbon::parse($tour->ngaybatdau);
                                    $end = \Carbon\Carbon::parse($tour->ngayketthuc);

                                    $days = $start->diffInDays($end) + 1;
                                    $nights = $days - 1;
                                @endphp

                                <span class="time">{{ $days }}N{{ $nights }}Đ</span>
                            </div>
                            <div class="destination-footer">
                                <span class="price"><span>{{ number_format($tour->gia_nguoiLon, 0, ',', '.') }}</span> VND/ người</span> 
                                <a href="{{ route('chitiet_tour', ['id' => $tour->tourID]) }}" class="read-more">Book Now <i class="fal fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Destinations Area end -->

<!-- About Us Area start -->
<section class="about-us-area py-100 rpb-90 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-5 col-lg-6">
                <div class="about-us-content rmb-55" data-aos="fade-left" data-aos-duration="1500" data-aos-offset="50">
                    <div class="section-title mb-25">
                        <h2>Du lịch trọn niềm tin – Lý do khách hàng chọn chúng tôi</h2>
                    </div>
                    <p>Chúng tôi luôn nỗ lực để biến ước mơ du lịch của bạn thành hiện thực, từ những điểm đến ẩn mình đến các địa danh nổi bật
                    </p>
                    <div class="divider counter-text-wrap mt-45 mb-55"><span>Chúng tôi có <span><span class="count-text plus"
                                    data-speed="3000" data-stop="5">0</span> Năm</span> kinh nghiệm</span></div>
                    <div class="row">
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
                    <a href="{{ route('noiden') }}" class="theme-btn mt-10 style-two">
                        <span data-hover="Khám phá các điểm đến">Khám phá các điểm đến</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-7 col-lg-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                <div class="about-us-image">
                    <div class="shape"><img src="{{ asset('clients/assets/images/about/shape1.png') }}" alt="Shape"></div>
                    <div class="shape"><img src="{{ asset('clients/assets/images/about/shape2.png') }}" alt="Shape"></div>
                    <div class="shape"><img src="{{ asset('clients/assets/images/about/shape3.png') }}" alt="Shape"></div>
                    <div class="shape"><img src="{{ asset('clients/assets/images/about/shape4.png') }}" alt="Shape"></div>
                    <div class="shape"><img src="{{ asset('clients/assets/images/about/shape5.png') }}" alt="Shape"></div>
                    <div class="shape"><img src="{{ asset('clients/assets/images/about/shape6.png') }}" alt="Shape"></div>
                    <div class="shape"><img src="{{ asset('clients/assets/images/about/shape7.png') }}" alt="Shape"></div>
                    <img src="{{ asset('clients/assets/images/about/about.png') }}" alt="About">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About Us Area end -->





<!-- Features Area start -->
<section class="features-area pt-100 pb-45 rel z-1">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-6">
                <div class="features-content-part mb-55" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">
                    <div class="section-title mb-60">
                        <h2>Trải nghiệm du lịch tuyệt đỉnh làm nên sự khác biệt của chúng tôi</h2>
                    </div>
                    <div class="features-customer-box">
                        <div class="image">
                            <img src="{{ asset('clients/assets/images/features/features-box.jpg') }}" alt="Features">
                        </div>
                        <div class="content">
                            <div class="feature-authors mb-15">
                                <img src="{{ asset('clients/assets/images/features/feature-author1.jpg') }}" alt="Author">
                                <img src="{{ asset('clients/assets/images/features/feature-author2.jpg') }}" alt="Author">
                                <img src="{{ asset('clients/assets/images/features/feature-author3.jpg') }}" alt="Author">
                                <span>4k+</span>
                            </div>
                            <h6>850K+ Khách hàng hài lòng</h6>
                            <div class="divider style-two counter-text-wrap my-25"><span><span class="count-text plus"
                                        data-speed="3000" data-stop="5">0</span> Năm</span></div>
                            <p>Chúng tôi tự hào cung cấp các hành trình cá nhân hóa</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                <div class="row pb-25">
                    <div class="col-md-6">
                        <div class="feature-item">
                            <div class="icon"><i class="flaticon-tent"></i></div>
                            <div class="content">
                                <h5><a href="{{route('tours')}}">Cắm trại bằng lều</a></h5>
                                <p>Cắm trại bằng lều là cách tuyệt vời để kết nối với thiên nhiên</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="icon"><i class="flaticon-tent"></i></div>
                            <div class="content">
                                <h5><a href="{{route('tours')}}">Chèo thuyền Kayak</a></h5>
                                <p>Chèo thuyền Kayak là một hoạt động ngoài trời thú vị mang lại cảm giác hồi hộp</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="feature-item mt-20">
                            <div class="icon"><i class="flaticon-tent"></i></div>
                            <div class="content">
                                <h5><a href="{{route('tours')}}">Xe đạp leo núi</a></h5>
                                <p>Xe đạp leo núi là môn thể thao thú vị giúp rèn luyện thể lực</p>
                            </div>
                        </div>
                        <div class="feature-item">
                            <div class="icon"><i class="flaticon-tent"></i></div>
                            <div class="content">
                                <h5><a href="{{route('tours')}}">Chèo thuyền & câu cá</a></h5>
                                <p>Chèo thuyền và câu cá là những hoạt động mang lại niềm vui thiết yếu</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Features Area end -->

<!-- Testimonials Area start -->
<section class="testimonials-area rel z-1">
    <div class="container">
        <div class="testimonials-wrap bgc-lighter">
            <div class="row">
                <div class="col-lg-5 rel" data-aos="fade-right" data-aos-duration="1500" data-aos-offset="50">
                    <div class="testimonial-left-image rmb-55"
                        style="background-image: url({{ asset('clients/assets/images/testimonials/testimonial-left.jpg') }});"></div>
                </div>
                <div class="col-lg-7">
                    <div class="testimonial-right-content" data-aos="fade-left" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="section-title mb-55">
                            <h2><span>5280</span> Global Clients Say About Us Services</h2>
                        </div>
                        <div class="testimonials-active">
                            <div class="testimonial-item">
                                <div class="testi-header">
                                    <div class="quote"><i class="flaticon-double-quotes"></i></div>
                                    <h4>Quality Services</h4>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="text">"Our trip was absolutely a perfect, thanks this travel agency! They
                                    took care of every detail, from to accommodations, and even suggested incredible
                                    experiences"</div>
                                <div class="author">
                                    <div class="image"><img src="{{ asset('clients/assets/images/testimonials/author.jpg') }}" alt="Author">
                                    </div>
                                    <div class="content">
                                        <h5>Randall V. Vasquez</h5>
                                        <span>Graphics Designer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="testimonial-item">
                                <div class="testi-header">
                                    <div class="quote"><i class="flaticon-double-quotes"></i></div>
                                    <h4>Quality Services</h4>
                                    <div class="ratting">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                                <div class="text">"Our trip was absolutely a perfect, thanks this travel agency! They
                                    took care of every detail, from to accommodations, and even suggested incredible
                                    experiences"</div>
                                <div class="author">
                                    <div class="image"><img src="{{ asset('clients/assets/images/testimonials/author.jpg') }}" alt="Author">
                                    </div>
                                    <div class="content">
                                        <h5>Randall V. Vasquez</h5>
                                        <span>Graphics Designer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Testimonials Area end -->


<!-- CTA Area start -->
<section class="cta-area pt-100 rel z-1">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-duration="1500" data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta1.jpg') }});">
                    <span class="category">Cắm trại bằng lều</span>
                    <h2>Khám phá du lịch tốt nhất Việt Nam</h2>
                    <a href="{{route('tours')}}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Khám phá tour">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="50" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/cta/cta2.jpg') }});">
                    <span class="category">Bãi biển</span>
                    <h2>Thành phố biển - thiên đường nghỉ dưỡng</h2>
                    <a href="{{route('tours')}}" class="theme-btn style-two">
                        <span data-hover="Khám phá tour">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="col-xl-4 col-md-6" data-aos="zoom-in-down" data-aos-delay="100" data-aos-duration="1500"
                data-aos-offset="50">
                <div class="cta-item" style="background-image: url({{ asset('clients/assets/images/gallery/5n4d-DN1.jpg') }});">
                    <span class="category">Động Phong Nha</span>
                    <h2>Kì quan đệ nhất động</h2>
                    <a href="{{route('tours')}}" class="theme-btn style-two bgc-secondary">
                        <span data-hover="Khám phá tour">Khám phá</span>
                        <i class="fal fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- CTA Area end -->





@include('clients.blocks.footer_home')