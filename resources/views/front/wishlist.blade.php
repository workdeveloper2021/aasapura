@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Wishlist')


<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('') }}/website/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Wishlist</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Wishlist
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <table class="table table-wishlist table-mobile">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($wishlist as $key => $value) {
                    ?>
                    <tr>
                        <td class="">
                            <a href="/product/{{ $value['slug'] }}">
                                <img src="{{ url('') }}/products/{{ $value['image'] }}" alt="Product image"
                                    style="width: 100px; height: 100px; object-fit: contain" />
                            </a>
                        </td>
                        <td class="price-col">
                            <a href="/product/{{ $value['slug'] }}">{{ $value['title'] }}</a>
                        </td>
                        <td class="price-col">₹ {{ $value['price'] }}</td>
                        <td class="price-col">
                            {{-- <form method="post" id="addtocartform">
                                @csrf
                                <input type="number" name="prduct_id" id="" hidden value="{{ $value['prduct_id'] }}">
                                <button data-toggle="modal"
                                    class="btn btn-outline-primary-2 submit-btn-add-to-cart"><span>Add To
                                        Cart</span><i class="icon-long-arrow-right"></i></button>
                            </form> --}}
                        </td>

                        <td class="remove-col">
                            <a href="/remove/wishlist/{{ $value['prduct_id'] }}" class="btn-remove">
                                <i class="icon-close"></i>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- End .table table-wishlist -->
            <div class="wishlist-share">
                <div class="social-icons social-icons-sm mb-2">
                    <label class="social-label">Share on:</label>
                    <a href="#" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
                    <a href="#" class="social-icon" title="Twitter" target="_blank"><i class="icon-twitter"></i></a>
                    <a href="#" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
                    <a href="#" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
                    <a href="#" class="social-icon" title="Pinterest" target="_blank"><i class="icon-pinterest"></i></a>
                </div>
                <!-- End .soial-icons -->
            </div>
            <!-- End .wishlist-share -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-content -->
</main>
<!-- End .main -->


@endsection
