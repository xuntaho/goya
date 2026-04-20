@include ('clients.blocks.header')
@include ('clients.blocks.banner_timkiem')

<!-- Popular Destinations Area start -->
<section class="popular-destinations-area pt-100 pb-90 rel z-1">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-40" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám phá các điểm đến phổ biến</h2>
                    <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> với những trải
                        nghiệm được yêu thích nhất</p>
                    <ul class="destinations-nav mt-30">
                        <li data-filter="*">Tất cả</li>
                        <li data-filter=".domain-Bac">Miền Bắc</li>
                        <li data-filter=".domain-Trung">Miền Trung</li>
                        <li data-filter=".domain-Nam">Miền Nam</li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="row gap-10 destinations-active justify-content-center">
            @php $count = 0; @endphp
            @foreach ($tours as $tour)
                @if ($count % 3 == 2)
                    <div class="col-md-6 item domain-{{ $tour->mien }}">
                @else
                        <div class="col-xl-3 col-md-6 item domain-{{ $tour->mien }}">
                    @endif
                        <div class="destination-item style-two" data-aos-duration="1500" data-aos-offset="50">
                            <div class="image" style="max-height: 250px">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                                <img src="{{ $tour->hinh }}" alt="Destination">
                            </div>
                            <div class="content">
                                <h6 class="tour-title"><a
                                        href="{{ route('chitiet_tour', ['id' => $tour->tourID]) }}">{{ $tour->title }}</a>
                                </h6>
                                <span class="time">{{ $tour->thoigian }}</span>
                                <a href="{{ route('chitiet_tour', ['id' => $tour->tourID]) }}" class="more"><i
                                        class="fas fa-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @php $count++; @endphp
            @endforeach

            </div>
</section>
<!-- Popular Destinations Area end -->



<!-- Hot Deals Area start -->
<section class="hot-deals-area pt-70 pb-50 rel z-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title text-center counter-text-wrap mb-50" data-aos="fade-up"
                    data-aos-duration="1500" data-aos-offset="50">
                    <h2>Khám phá các ưu đãi hấp dẫn</h2>
                    <p>Website <span class="count-text plus" data-speed="3000" data-stop="34500">0</span> mang đến những
                        trải nghiệm đáng nhớ nhất bạn từng có</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($hotTours as $tour)
                <div class=" col-xl-4 col-md-6">
                    <div class="destination-item hh" data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
                        data-aos-offset="50">
                        <div class="image">
                            @if(trim(strtolower($tour->type)) == 'percent')
                                <span class="badge">{{ $tour->discount }}% Off</span>
                            @else
                                <span class="badge">-{{ number_format($tour->discount) }}đ</span>
                            @endif

                            <img src="{{ $tour->hinh }}" alt="Hot Deal">
                            <div class="ratting"><i class="fas fa-star"></i> 4.8</div>
                            <a href="#" class="heart"><i class="fas fa-heart"></i></a>

                        </div>
                        <div class="content">
                            <span class="location"><i class="fal fa-map-marker-alt"></i> {{ $tour->diemden }}</span>
                            <h5><a href="{{ route('chitiet_tour', ['id' => $tour->tourID]) }}">{{ $tour->title }}</a></h5>
                            <span class="time">{{ $tour->thoigian }}</span>
                        </div>
                        <div class="destination-footer">
                            <span class="price"><span>{{ number_format($tour->gia_nguoiLon, 0, ',', '.') }}</span> VND/
                                người</span>
                            <a href="{{ route('chitiet_tour', ['id' => $tour->tourID]) }}" class="read-more">Book Now <i
                                    class="fal fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Hot Deals Area end -->



<!-- Newsletter Area end -->
@include ('clients.blocks.letter')
@include ('clients.blocks.footer')
<style>
    
.image {
    position: relative;
}

.badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: red;
    color: #fff;
    padding: 5px 10px;
    border-radius: 5px;
    z-index: 10;
    font-weight: bold;
}
</style>