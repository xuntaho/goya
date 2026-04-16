@include('clients.blocks.header')
@include('clients.blocks.banner')
 <!-- Tour Grid Area start -->
        <section class="tour-grid-page tour-listing py-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-10 rmb-75">
                        <div class="shop-sidebar">
                            <div class="filter_clear">
                                <button class="clear_filter" name="btn_clear">Xóa</button>
                            </div>
                            <div class="widget widget-filter" data-aos="fade-up" data-aos-delay="50" data-aos-duration="1500" data-aos-offset="50">
                                <h6 class="widget-title">Lọc theo giá</h6>
                                <div class="price-filter-wrap">
                                    <div class="price-slider-range"></div>
                                    <div class="price">
                                        <span>Giá </span>
                                        <input type="text" id="price" readonly>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="widget widget-activity" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h6 class="widget-title">Điểm đến</h6>
                                <ul class="radio-filter">
                                    <li>
                                        <input class="form-check-input" type="radio" name="mien" id="id_mien_bac" value="Bac">
                                        <label for="activity1">Miền Bắc <span>{{ $mienCount['mien_bac'] }}</span></label>
                                    </li>
                                    
                                    <li>
                                        <input class="form-check-input" type="radio" name="mien" id="id_mien_trung" value="Trung">
                                        <label for="activity6">Miền Trung <span>{{ $mienCount['mien_trung'] }}</span></label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="mien" id="id_mien_nam" value="Nam">
                                        <label for="activity6">Miền Nam <span>{{ $mienCount['mien_nam'] }}</span></label>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="widget widget-reviews" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h6 class="widget-title">Đánh giá</h6>
                                <ul class="radio-filter">
                                    <li>
                                        <input class="form-check-input" type="radio" name="star" id="5star" value="5">
                                        <label for="5star">
                                            <span class="ratting">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </span>
                                        </label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="star" id="4star" value="4">
                                        <label for="4star">
                                            <span class="ratting">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt white"></i>
                                            </span>
                                        </label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="star" id="3star" value="3">
                                        <label for="3star">
                                            <span class="ratting">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star white"></i>
                                                <i class="fas fa-star-half-alt white"></i>
                                            </span>
                                        </label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="star" id="2star" value="2">
                                        <label for="2star">
                                            <span class="ratting">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star white"></i>
                                                <i class="fas fa-star white"></i>
                                                <i class="fas fa-star-half-alt white"></i>
                                            </span>
                                        </label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="star" id="1star" value="1">
                                        <label for="1star">
                                            <span class="ratting">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star white"></i>
                                                <i class="fas fa-star white"></i>
                                                <i class="fas fa-star white"></i>
                                                <i class="fas fa-star-half-alt white"></i>
                                            </span>
                                        </label>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="widget widget-duration" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h6 class="widget-title">Thời gian</h6>
                                <ul class="radio-filter">
                                    <li>
                                        <input class="form-check-input" type="radio" name="thoigian" id="3ngay2dem"  value="3N2D">
                                        <label for="3ngay2dem" value="3n2d">3 ngày 2 đêm</label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="thoigian" id="4ngay3dem" value="4N3D">
                                        <label for="4ngay3dem" value="4n3d">4 ngày 3 đêm</label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="thoigian" id="5ngay4dem" value="5N4D">
                                        <label for="5ngay4dem" value="5n4d">5 ngày 4 đêm</label>
                                    </li>
                                    <li>
                                        <input class="form-check-input" type="radio" name="thoigian" id="6ngay5dem" value="6N5D">
                                        <label for="6ngay5dem" value="6n5d">6 ngày 5 đêm</label>
                                    </li>
                                    
                                </ul>
                            </div>
                            
                            <div class="widget widget-tour" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                <h6 class="widget-title">Tours Phổ biến</h6>
                                <div class="destination-item tour-grid style-three bgc-lighter">
                                    <div class="image">
                                        <span class="badge">10% Off</span>
                                        <img src="{{ asset('clients/assets/images/widgets/tour1.jpg') }}" alt="Tour">
                                    </div>
                                    <div class="content">
                                        <div class="destination-header">
                                            <span class="location"><i class="fal fa-map-marker-alt"></i> Bali, Indonesia</span>
                                            <div class="ratting">
                                                <i class="fas fa-star"></i>
                                                <span>(4.8)</span>
                                            </div>
                                        </div>
                                        <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                                    </div>
                                </div>
                                <div class="destination-item tour-grid style-three bgc-lighter">
                                    <div class="image">
                                        <span class="badge">10% Off</span>
                                        <img src="{{ asset('clients/assets/images/widgets/tour1.jpg') }}" alt="Tour">
                                    </div>
                                    <div class="content">
                                        <div class="destination-header">
                                            <span class="location"><i class="fal fa-map-marker-alt"></i> Bali, Indonesia</span>
                                            <div class="ratting">
                                                <i class="fas fa-star"></i>
                                                <span>(4.8)</span>
                                            </div>
                                        </div>
                                        <h6><a href="tour-details.html">Relinking Beach, Bali, Indonesia</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="widget widget-cta mt-30" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                            <div class="content text-white">
                                <span class="h6">Khám phá Việt Nam</span>
                                <h3>Top điểm đến du lịch</h3>
                                <a href="tour-list.html" class="theme-btn style-two bgc-secondary">
                                    <span data-hover="Khám phá ngay">Khám phá ngay</span>
                                    <i class="fal fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="image">
                                <img src="{{ asset('clients/assets/images/widgets/cta-widget.png') }}" alt="CTA">
                            </div>
                            <div class="cta-shape"><img src="{{ asset('clients/assets/images/widgets/cta-shape2.png') }}" alt="Shape"></div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="shop-shorter rel z-3 mb-20">
                            
                            <div id="total-tours" class="sort-text mb-15 me-4 me-xl-auto">
                                {{ $count ?? 0 }} tours được tìm thấy
                            </div>
                            <select id="orderBy">
                                <option value="default" selected="">Sắp xếp theo</option>
                                <option value="new">Mới nhất</option>
                                <option value="old">Cũ nhất</option>
                                <option value="hight-to-low">Cao đến Thấp</option>
                                <option value="low-to-high">Thấp đến Cao</option>
                            </select>
                        </div>
                        
                        <div class="tour-grid-wrap">
                            <div class="row" id="tours-container">
                               @include('clients.partials.filter-tours')
                            
                                <div class="col-lg-12">
                                    <ul class="pagination justify-content-center pt-15 flex-wrap" data-aos="fade-up" data-aos-duration="1500" data-aos-offset="50">
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="far fa-chevron-left"></i></span>
                                        </li>
                                        <li class="page-item active">
                                            <span class="page-link">
                                                1
                                                <span class="sr-only">(current)</span>
                                            </span>
                                        </li>
                                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                                        <li class="page-item">
                                            <a class="page-link" href="#"><i class="far fa-chevron-right"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </section>
        <!-- Tour Grid Area end -->
        


@include('clients.blocks.letter')
@include('clients.blocks.footer')
<script>
    var filterToursUrl = "{{ route('filter-tours') }}";
</script>