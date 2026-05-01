<input type="hidden" id="tour-count-hidden" value="{{ $count ?? 0 }}">
    @foreach ($tours as $tour)
        <div class="col-xl-4 col-md-6">
            <div class="destination-item tour-grid style-three bgc-lighter" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                <div class="image">
                    <span class="badge bgc-pink">Nổi bật</span>
                    <a href="#" class="heart"><i class="fas fa-heart"></i></a>
                    <img src="{{ $tour->hinh }}" alt="Tour List">
                </div>
                <div class="content">
                    <div class="destination-header">
                        <span class="location"><i class="fal fa-map-marker-alt"></i>{{ $tour->diemden }}</span>
                        @php
                            $rating = round($tour->avg_rating ?? 0); // làm tròn
                        @endphp
                        <div class="ratting">
                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $rating)
                                    <i class="fas fa-star" style="color: gold;"></i> 
                                @else
                                    <i class="far fa-star" style="color: #ccc;"></i> 
                                @endif
                            @endfor
                        </div>
                    </div>
                    <h6><a href="{{ route('chitiet_tour', ['id' => $tour->tourID]) }}">{{ $tour->title }}</a></h6>
                    <ul class="blog-meta">
                    @php
                        $start = \Carbon\Carbon::parse($tour->ngaybatdau);
                        $end = \Carbon\Carbon::parse($tour->ngayketthuc);

                        $days = $start->diffInDays($end) + 1;
                        $nights = $days - 1;
                    @endphp

                    <li><i class="far fa-clock"></i> {{ $days }}N{{ $nights }}Đ</li>
                    
                        <li>
                            <i class="far fa-user"></i> 
                            {{ $tour->conlai }}
                        </li>
                    </ul>
                    <div class="destination-footer">
                        <span class="price"><span>{{ number_format($tour->gia_nguoiLon, 0, ',', '.') }}</span> VND/ người</span>
                        <a href="{{ route('chitiet_tour', ['id' => $tour->tourID]) }}" class="theme-btn style-two style-three">
                            <i class="fal fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
@endforeach

