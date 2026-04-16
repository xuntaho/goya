@include('clients.blocks.header')


<section class="tour-grid-page py-100 rel z-2">
    <div class="container">
        <div class="row">

            @if ($tours->isEmpty())
                <h4 class="alert alert-danger text-center">
                    Không có tour nào liên quan đến tìm kiếm của bạn
                </h4>
            @else

                @foreach ($tours as $tour)
                    <div class="col-xl-4 col-md-6" style="margin-bottom: 30px">

                        <div class="destination-item tour-grid style-three bgc-lighter">

                            {{-- IMAGE --}}
                            <div class="image">
                                <a href="#" class="heart"><i class="fas fa-heart"></i></a>

                                <img src="{{ $tour->hinh }}" alt="Tour">
                            </div>

                            {{-- CONTENT --}}
                            <div class="content">

                                <div class="destination-header">
                                    <span class="location">
                                        <i class="fal fa-map-marker-alt"></i>
                                        {{ $tour->diemden }}
                                    </span>

                                    <div class="ratting">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($tour->avg_rating >= $i)
                                                <i class="fas fa-star"></i>
                                            @else
                                                <i class="far fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>

                                    <span>({{ $tour->total_review }} đánh giá)</span>
                                </div>

                                {{-- TITLE --}}
                                <h5>
                                    <a href="{{ route('chitiet_tour', $tour->tourID) }}">
                                        {{ $tour->title }}
                                    </a>
                                </h5>

                                {{-- META --}}
                                <ul class="blog-meta">
                                    <li><i class="far fa-clock"></i> {{ $tour->thoigian }}</li>
                                </ul>

                                {{-- PRICE --}}
                                <div class="destination-footer">
                                    <span class="price">
                                        <span>{{ number_format($tour->gia_nguoiLon) }}đ</span> / người
                                    </span>

                                    <a href="{{ route('chitiet_tour', $tour->tourID) }}"
                                        class="theme-btn style-two style-three">
                                        <span>Đặt ngay</span>
                                        <i class="fal fa-arrow-right"></i>
                                    </a>
                                </div>

                            </div>
                        </div>

                    </div>
                @endforeach

            @endif

        </div>
    </div>
</section>

@include('clients.blocks.letter')
@include('clients.blocks.footer')