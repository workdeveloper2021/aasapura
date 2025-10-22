<div class="product product-11 text-center">
    <figure class="product-media">
        <a href="/product/{{ $value->slug }}?checkin={{ $checkin ?? "" }}&checkout={{ $checkout ?? "" }}">
            {{-- <img src="{{ url('website') }}/assets/images/products/1.jpg" alt="Product image"
                class="product-image" /> --}}
            <img src="{{ url('products') }}/{{ $value->image1 }}" alt="{{ $value->title }}" loading="lazy"
                class="product-image" />
            {{-- <img src="{{ url('website') }}/assets/images/products/1.jpg" alt="Product image"
                class="product-image-hover" /> --}}
        </a>

        <div class="product-action-vertical">
            <a href="javascript:void(0)" onclick="addtowishlist('<?=$value->id?>',this)"
                class="btn-product-icon btn-wishlist"><span></span></a>
        </div>
          <div class="booked_product bg-success">Book Now</div>
    </figure>

    <div class="product-body text-left">
        <div class="product-price d-flex justify-content-between">
            <h6 class="font-weight-bold">₹ {{ $value->price }}</h6>
            <h6>
                <i class="la la-star text-warning"></i>
                <i class="la la-star text-warning"></i>
                <i class="la la-star text-warning"></i>
                <i class="la la-star text-warning"></i>
                <i class="la la-star-half text-warning"></i>
            </h6>
        </div>

        <h3 class="product-title mb-1">
            <a href="/product/{{ $value->slug }}?checkin={{ $checkin ?? "" }}&checkout={{ $checkout ?? "" }}">{{ $value->title }}</a>
        </h3>

        <div class="product-cat" style="display: flex; justify-content: space-between">
            <a href="javascript:void(0)">{{ $value->state_name }} , {{ $value->district_name }} </a>
            <a href="javascript:void(0)">
                @if ($value->created_at->isToday())
                <p>Today</p>
                @else
                <p>{{ $value->created_at->format('d M') }}</p>
                @endif
            </a>
        </div>
    </div>

    <div class="product-action">
        <a href="/product/{{ $value->slug }}?checkin={{ $checkin ?? "" }}&checkout={{ $checkout ?? "" }}" class="btn-product"><span>View Details</span></a>
    </div>
</div>
