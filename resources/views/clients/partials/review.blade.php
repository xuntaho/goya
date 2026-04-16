<h3>Đánh giá của khách hàng</h3>
<div class="clients-reviews bgc-black mt-30 mb-60">
    <div class="left">
        <b>{{ number_format($avgStar ?? 0, 1) }}</b>
        <span>({{ $countReview ?? 0 }} đánh giá)</span>

        <div class="ratting">
            @for ($i = 1; $i <= 5; $i++)
                @if ($avgStar >= $i)
                    <i class="fas fa-star"></i>
                @else
                    <i class="far fa-star"></i>
                @endif
            @endfor
        </div>
    </div>
</div>

<h3>Ý kiến ​​của khách hàng</h3>

<div class="comments mt-30 mb-60">
    @forelse ($getReviews as $review)
        <div class="comment-body">
           <img src="{{ asset('clients/assets/images/users/' . ($review->hinh ?: 'default.png')) }}"
     style="width:60px; height:60px; object-fit:cover; border-radius:50%;">

            <div class="content">
                <h6>{{ $review->fullname }}</h6>

                <div class="ratting">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($review->sosao >= $i)
                            <i class="fas fa-star"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>

                <span class="time">
                    {{ \Carbon\Carbon::parse($review->created_at)->format('d/m/Y') }}
                </span>

                <p>{{ $review->binhluan }}</p>
            </div>
        </div>
    @empty
        <p>Chưa có đánh giá nào</p>
    @endforelse
</div>
