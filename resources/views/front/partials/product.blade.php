<div class="col-6 col-md-4 col-lg-3 col-xl-4col">
    <div class="product product-11 text-center">
        <figure class="product-media">
            <a href="/product/{{ $value->slug }}">
                <img src="{{ url('products') }}/{{ $value->image1 }}" alt="{{ $value->title }}" loading="lazy"
                    class="product-image" />
                {{-- <img src="{{ url('website') }}/assets/images/products/1.jpg" alt="Product image"
                    class="product-image-hover" /> --}}
            </a>

            <div class="product-action-vertical">
                <a href="javascript:void(0)" onclick="addtowishlist('<?=$value->id?>',this)"
                    class="btn-product-icon btn-wishlist"><span></span></a>

<div class="share-wrapper position-relative d-inline-block">
    <a href="javascript:void(0)" class="btn-product-icon btn-share">
        <i class="la la-share-alt"></i>
    </a>

    <!-- Share Icons -->
    <div class="share-menu-horizontal position-absolute">
        <a href="https://api.whatsapp.com/send?text=Check out this product: {{ url('/product/' . $value->slug) }}" 
           target="_blank" class="share-icon-small">
            <i class="la la-whatsapp"></i>
        </a>
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url('/product/' . $value->slug) }}" 
           target="_blank" class="share-icon-small">
            <i class="la la-facebook"></i>
        </a>
        <a href="https://twitter.com/intent/tweet?url={{ url('/product/' . $value->slug) }}&text={{ $value->title }}" 
           target="_blank" class="share-icon-small">
            <i class="la la-twitter"></i>
        </a>
    </div>
</div>





<style>
   .share-wrapper {
  position: relative;
}

.share-menu-horizontal {
  position: absolute;
  top: 110%;
  left: 0%;
  transform: translateX(-70%);
  background: #fff;
  border-radius: 5px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.2);
  z-index: 100;
  display: none;
  gap: 5px;
  padding: 5px;
  transition: all 0.2s ease-in-out;
}

.share-icon-small {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background: #f0f0f0;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #333;
  transition: all 0.2s;
}

.share-icon-small:hover {
  background: #ddd;
}

.btn-share i {
  font-size: 18px;
}

/* 👇 The magic: Show menu when hovering share button OR the menu */
.share-wrapper:hover .share-menu-horizontal {
  display: flex;
}

</style>
            </div>
            <div class="booked_product <?php if(bookornotbook($value->id) == "Booked"){}else{echo "bg-success";} ?>"><?= bookornotbook($value->id) ?></div>
        </figure>

        <div class="product-body text-left">
            <div class="product-price d-flex justify-content-between">
                <h6 class="font-weight-bold">₹ {{ $value->rent }}</h6>
                <h6>
                    <i class="la la-star text-warning"></i>
                    <i class="la la-star text-warning"></i>
                    <i class="la la-star text-warning"></i>
                    <i class="la la-star text-warning"></i>
                    <i class="la la-star-half text-warning"></i>
                </h6>
            </div>

            <h3 class="product-title mb-1">
                <a href="/product/{{ $value->slug }}">{{ $value->title }}</a>
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
            <a href="/product/{{ $value->slug }}" class="btn-product"><span>View Details</span></a>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const shareButtons = document.querySelectorAll('.btn-share');

    shareButtons.forEach(btn => {
        const menu = btn.nextElementSibling;

        btn.addEventListener('mouseenter', () => menu.style.display = 'flex');
        btn.addEventListener('mouseleave', () => menu.style.display = 'none');
        menu.addEventListener('mouseenter', () => menu.style.display = 'flex');
        menu.addEventListener('mouseleave', () => menu.style.display = 'none');
    });
});


</script>