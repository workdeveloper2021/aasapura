@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Wishlist')


<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Cart</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cart</li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="cart">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <table class="table table-cart table-mobile">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                foreach ($cartitems as $key => $value) {
                                 ?>
                                <tr>
                                    <td class="product-col">
                                        <div>
                                            <h6>{{ $value->title }}</h6>
                                        </div>
                                    </td>
                                    <td class="price-col">₹ {{ $value->price }}</td>
                                    <td class="quantity-col">
                                        <div class="cart-product-quantity">

                                            <div class="product-dbr" id="product-3">
                                                <form action="/updatecartquantity" method="post">
                                                    @csrf
                                                    <div class="quantity-container">
                                                        <button type="submit"
                                                            class="quantity-btn decrease-btn">-</button>
                                                        <input type="text" name="quantity" class="quantity-input"
                                                            value="{{ $value->quantity }}" min="1" max="10">
                                                        <input type="number" value="{{ $value->cartid }}" hidden
                                                            name="cartidentity" id="">
                                                        <button type="submit"
                                                            class="quantity-btn increase-btn">+</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End .cart-product-quantity -->
                                    </td>
                                    <td class="total-col">₹
                                        <?= $value->price*$value->quantity ?>
                                    </td>
                                    <td class="remove-col">
                                        <a onclick="checkandgocartdelete('<?= $value->cartid?>')"
                                            href="javascript:void(0)" class="btn-remove">
                                            <i class="icon-close"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                        <!-- End .table table-wishlist -->

                        {{-- <div class="cart-bottom">
                            <div class="cart-discount">
                                <form action="#">
                                    <div class="input-group">
                                        <input type="text" class="form-control" required placeholder="coupon code" />
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary-2" type="submit">
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </div>
                                        <!-- .End .input-group-append -->
                                    </div>
                                    <!-- End .input-group -->
                                </form>
                            </div>
                            <!-- End .cart-discount -->

                            <a href="#" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i
                                    class="icon-refresh"></i></a>
                        </div> --}}
                        <!-- End .cart-bottom -->
                    </div>
                    <!-- End .col-lg-9 -->
                    <aside class="col-lg-3">
                        <div class="summary summary-cart">
                            <h3 class="summary-title">Cart Total</h3>
                            <!-- End .summary-title -->

                            <table class="table table-summary">
                                <tbody>
                                    <tr class="summary-subtotal">
                                        <td>Subtotal:</td>
                                        <td>₹ 30,999</td>
                                    </tr>
                                    <!-- End .summary-subtotal -->
                                    <tr class="summary-shipping">
                                        <td>Shipping:</td>
                                        <td>&nbsp;</td>
                                    </tr>

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="free-shipping" name="shipping"
                                                    class="custom-control-input" />
                                                <label class="custom-control-label" for="free-shipping">GST</label>
                                            </div>
                                            <!-- End .custom-control -->
                                        </td>
                                        <td>₹0.00</td>
                                    </tr>
                                    <!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-row">
                                        <td>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="standart-shipping" name="shipping"
                                                    class="custom-control-input" />
                                                <label class="custom-control-label"
                                                    for="standart-shipping">Standart:</label>
                                            </div>
                                            <!-- End .custom-control -->
                                        </td>
                                        <td>₹10.00</td>
                                    </tr>
                                    <!-- End .summary-shipping-row -->

                                    <tr class="summary-shipping-estimate">
                                        <td>
                                            <a href="choose-packages.html">Change Plan</a>
                                        </td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <!-- End .summary-shipping-estimate -->

                                    <tr class="summary-total">
                                        <td>Total:</td>
                                        <td>₹ 31000.00</td>
                                    </tr>
                                    <!-- End .summary-total -->
                                </tbody>
                            </table>
                            <!-- End .table table-summary -->

                            <a href="checkout.html" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO
                                CHECKOUT</a>
                        </div>
                        <!-- End .summary -->

                        <a href="category.html" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE
                                PRODUCTS</span><i class="icon-refresh"></i></a>
                    </aside>
                    <!-- End .col-lg-3 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .cart -->
    </div>
    <!-- End .page-content -->
</main>
<!-- End .main -->


@section('header')
<style>
    .quantity-container {
        display: flex;
        align-items: center;
        gap: 10px;
        max-width: 150px;
        margin-bottom: 20px;
    }

    .quantity-btn {
        background-color: #007bff;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .quantity-btn:hover {
        background-color: #0056b3;
    }

    .quantity-input {
        width: 50px;
        height: 30px;
        text-align: center;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .quantity-input:focus {
        outline: none;
        border-color: #007bff;
    }
</style>
@endsection
@section('footer')

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
    // Get all quantity containers
    const quantityContainers = document.querySelectorAll('.quantity-container');

    quantityContainers.forEach(function(container) {
        const decreaseBtn = container.querySelector('.decrease-btn');
        const increaseBtn = container.querySelector('.increase-btn');
        const quantityInput = container.querySelector('.quantity-input');

        // Increase quantity
        increaseBtn.addEventListener('click', function() {
            let currentVal = parseInt(quantityInput.value);
            if (currentVal < quantityInput.max) {
                quantityInput.value = currentVal + 1;
            }
        });

        // Decrease quantity
        decreaseBtn.addEventListener('click', function() {
            let currentVal = parseInt(quantityInput.value);
            if (currentVal > quantityInput.min) {
                quantityInput.value = currentVal - 1;
            }
        });
    });
});

</script>
@endsection
@endsection
