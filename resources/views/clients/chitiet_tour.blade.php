@include('clients.blocks.header')
<section class="page-banner-two rel z-1">
    <div class="container-fluid">
        <hr class="mt-0">
        <div class="container">
            <div class="banner-inner pt-15 pb-25 __web-inspector-hide-shortcut__">
                <h2 class="page-title mb-10 aos-init aos-animate" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">{{ $chitiet_tour->diemden ?? '' }}</h2>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-20 aos-init aos-animate" data-aos="fade-right"
                        data-aos-delay="200" data-aos-duration="1500" data-aos-offset="50">
                        <li class="breadcrumb-item"><a href="{{ route('home')}}">Trang chủ</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- Tour Gallery start -->
<div class="tour-gallery">
    <div class="container-fluid">
        <div class="row justify-content-center rel">
            <div class="col-lg-6 col-md-12">
                @if(isset($chitiet_tour->images[0]))
                    <div class="gallery-item">
                        <img src="{{ asset('clients/assets/images/gallery/' . $chitiet_tour->images[0] ) }}">
                    </div>
                @endif
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="row ">
                    @for ($i = 1; $i <= 4; $i++)
                        @if(isset($chitiet_tour->images[$i]))
                            <div class="col-6">
                                <div class="gallery-item">
                                    <img src="{{ asset('clients/assets/images/gallery/' . $chitiet_tour->images[$i] ) }}">
                                    
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Tour Gallery End -->

<!-- Tour Header Area start -->
<section class="tour-header-area pt-70 rel z-1">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-6 col-lg-7">
                <div class="tour-header-content mb-15" data-aos="fade-left" data-aos-duration="1500"
                    data-aos-offset="50">
                    <span class="location d-inline-block mb-10"><i class="fal fa-map-marker-alt"></i>
                        {{ $chitiet_tour->diemden ?? '' }}</span>
                    <div class="section-title pb-5">
                        <h2>{{ $chitiet_tour->title ?? '' }}</h2>
                    </div>
                    <div class="ratting">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 text-lg-end" data-aos="fade-right" data-aos-duration="1500"
                data-aos-offset="50">
                
            </div>
        </div>
        <hr class="mt-50 mb-70">
    </div>
</section>
<!-- Tour Header Area end -->

<!-- Tour Details Area start -->
<section class="tour-details-page pb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="tour-details-content">
                    <h3>Tổng quan </h3>
                    <p>{!! nl2br(e($chitiet_tour->mota)) !!}</p>
                    <div class="row pb-55">
                        <div class="col-md-6">
                            <div class="tour-include-exclude mt-30">
                                <h5>Bao gồm</h5>
                                <ul class="list-style-one check mt-25">
                                    <li><i class="far fa-check"></i> Xe tiêu chuẩn du lịch sử dụng theo chương trình</li>
                                    <li><i class="far fa-check"></i> Lưu trú tiêu chuẩn: 02 – 03 người lớn/phòng</li>
                                    <li><i class="far fa-check"></i> Các bữa ăn chính theo chương trình</li>
                                    <li><i class="far fa-check"></i> Nước uống: 01 chai 500 ml/khách/ngày</li>
                                    <li><i class="far fa-check"></i> Đội phục vụ theo đoàn. Ngôn ngữ chính: tiếng Việt</li>
                                    <li><i class="far fa-check"></i> Bảo hiểm du lịch với mức bồi thường tối đa là 100,000,000 VNĐ/khách</li>
                                    <li><i class="far fa-check"></i> Thuế Giá trị gia tăng theo quy định của Pháp Luật Việt Nam</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="tour-include-exclude mt-30">
                                <h5>Không bao gồm</h5>
                                <ul class="list-style-one mt-25">
                                    <li><i class="far fa-times"></i> Chi phí cá nhân: điểm tham quan ngoài chương trình, giặt ủi trong khách sạn,…</li>
                                    <li><i class="far fa-times"></i> Chi phí các dịch vụ không được liệt kê trong phần bao gồm</li>
                                    <li><i class="far fa-times"></i> Chi phí tham gia: tour cano 4 đảo, vé tham quan Vinwonders, vé tham quan Vinpearl Safari, vé cáp treo Hòn Thơm…</li>
                                    <li><i class="far fa-times"></i> Chi phí tham gia các trò chơi trên biển, câu mực đêm, vé vào cổng ngắm hoàng hôn và phương tiện di chuyển trở về khách sạn</li>
                                    <li><i class="far fa-times"></i> Phụ thu phòng đơn resort 4*: 2,100,000 VNĐ/khách/tour</li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <h3>Lịch trình</h3>
                <div class="accordion-two mt-25 mb-60" id="faq-accordion-two">
                    @php
                        $day=0;
                    @endphp
                    @foreach($chitiet_tour->timeline as $timeline)
                        <div class="accordion-item">
                            <h5 class="accordion-header">
                                <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseTwo{{ $timeline->tlID }}">
                                    Ngày {{ ++$day }} - {{ $timeline->title }}
                                </button>
                            </h5>
                            <div id="collapseTwo{{ $timeline->tlID }}" class="accordion-collapse collapse"
                                data-bs-parent="#faq-accordion-two">
                                <div class="accordion-body">
                                    <p>{!! nl2br(e($timeline->mota)) !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                 <div id="partials_reviews">
                    @include('clients.partials.review')
                </div>
                    <hr class="mt-30 mb-40">
                    @if(session('error'))
                        <div style="color:red; margin-bottom:10px;">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div style="color:green; margin-bottom:10px;">
                            {{ session('success') }}
                        </div>
                    @endif
                @if($bookingID)
                <form action="{{ route('review') }}" method="POST" class="mt-30">
                    @csrf
                    <input type="hidden" name="bookingID" value="{{ $bookingID }}">
                    <input type="hidden" name="tourID" value="{{ $chitiet_tour->tourID }}">
                    <input type="hidden" name="sosao" id="sosao">

                    <h5>Để lại phản hồi</h5>

                    <div id="rating-stars" class="mb-3">
                        <i class="far fa-star" data-value="1"></i>
                        <i class="far fa-star" data-value="2"></i>
                        <i class="far fa-star" data-value="3"></i>
                        <i class="far fa-star" data-value="4"></i>
                        <i class="far fa-star" data-value="5"></i>
                    </div>

                    <textarea name="binhluan" class="form-control mb-3"></textarea>

                    <button type="submit" class="theme-btn bgc-secondary">
                        Gửi đánh giá
                    </button>
                </form>
                @else
                    <p style="color:red">
                        Bạn cần đặt và hoàn thành tour này mới được đánh giá!
                    </p>
                @endif
            </div>
            <div class="col-lg-4 col-md-8 col-sm-10 rmt-75">
                <div class="blog-sidebar tour-sidebar">

                    <div class="widget widget-booking" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h5 class="widget-title"> Đặt Tour</h5>
                        <form action="{{ route('checkout', ['id' => $chitiet_tour->tourID]) }}" method="get">
                          
                            <div class="date mb-25">
                                <b>Ngày bắt đầu :</b>
                                <input type="text" value="{{ date('d-m-Y', strtotime($chitiet_tour->ngaybatdau)) }}" name="startdate" disabled>
                            </div>
                            <hr>
                            <div class="date mb-25">
                                <b>Ngày kết thúc :</b>
                                <input type="text " value="{{ date('d-m-Y', strtotime($chitiet_tour->ngayketthuc)) }}" name="enddate" disabled>
                            </div>
                            <hr>
                            <div class="time py-5">
                            @php
                                $start = \Carbon\Carbon::parse($chitiet_tour->ngaybatdau);
                                $end = \Carbon\Carbon::parse($chitiet_tour->ngayketthuc);
                                $days = $start->diffInDays($end) + 1;
                                $nights = $days - 1;
                            @endphp

                            <div style="display:flex; ">
                                <b style="min-width:120px;">Thời gian :</b>

                                <span style="flex:1;  ">
                                    {{ $days }}N{{ $nights }}Đ
                                </span>
                            </div>

                            <input type="hidden" name="time">
                        </div>
                           <hr>
                            <div style="display:flex; gap:10px;">
                                <b style="min-width:150px;">Số chỗ còn lại :</b>
                               @php
                                $booked = DB::table('booking')
                                    ->where('tourID', $chitiet_tour->tourID)
                                    ->where('status', 'confirmed')
                                    ->selectRaw('SUM(adult_count + child_count) as total')
                                    ->value('total') ?? 0;

                                $conlai = $chitiet_tour->socho - $booked;
                            @endphp
                                <span style="flex:1; ">
                                    @if($conlai <= 0)
                                        <span style="color:red;">Hết chỗ</span>
                                    @else
                                        <span >{{ $conlai }} chỗ</span>
                                    @endif
                                </span>
                            </div>
                            <hr class="mb-25">
                            <h6>Vé:</h6>
                            <ul class="tickets clearfix">
                                <li>
                                    Trẻ em 5 - 11 tuổi <span class="price"><span>{{ number_format($chitiet_tour->gia_emBe, 0, ',', '.') }}</span> VND</span>
                                    
                                </li>
                                <li>
                                    Người lớn <span class="price"><span>{{ number_format($chitiet_tour->gia_nguoiLon, 0, ',', '.') }}</span> VND</span>
                                    
                                </li>
                            </ul>
                                @if($conlai <= 0)
                                    <button type="button" class="theme-btn style-two w-100 mt-15 mb-5" disabled style="background: gray;">
                                        Hết chỗ
                                    </button>
                                @else
                                    <button type="submit" class="theme-btn style-two w-100 mt-15 mb-5">
                                        <span data-hover="Đặt ngay">Đặt ngay</span>
                                    </button>
                                @endif
                            <div class="text-center">
                                <a href="{{ route('contact') }}">Bạn cần trợ giúp không?</a>
                            </div>
                        </form>
                    </div>

                    <div class="widget widget-contact" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <h5 class="widget-title">Cần trợ giúp?</h5>
                        <ul class="list-style-one">
                            <li><i class="far fa-envelope"></i> <a
                                    href="emilto:xuanthao0124@gmail.com">xuanthao0124@gmail.com</a></li>
                            <li><i class="far fa-phone-volume"></i> <a href="callto:+000(123)45688">+000 (123) 456
                                    88</a></li>
                        </ul>
                    </div>

                    <div class="widget widget-cta" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                        <div class="content text-white">
                            <span class="h6">Khám phá Việt Nam</span>
                            <h3>Best Tourist Place</h3>
                            <a href="{{ route('tours') }}" class="theme-btn style-two bgc-secondary">
                                <span data-hover="Khám phá ngay">Khám phá ngay</span>
                                <i class="fal fa-arrow-right"></i>
                            </a>
                        </div>
                        <div class="image">
                            <img src="{{ asset('clients/assets/images/widgets/cta-widget.png') }}" alt="CTA">
                        </div>
                        <div class="cta-shape"><img src="{{ asset('clients/assets/images/widgets/cta-shape3.png') }}" alt="Shape"></div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Tour Details Area end -->


@include('clients.blocks.letter')
@include('clients.blocks.footer')
<script>
@if(session('success'))
    window.onload = function() {
        document.getElementById("review-section").scrollIntoView({
            behavior: "smooth"
        });
    }
@endif
</script>