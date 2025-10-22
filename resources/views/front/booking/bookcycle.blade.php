@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Book Cycle')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Booking</h1>
        </div>
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Book Cycle - {{ $product->title }}
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <!-- End .checkout-discount -->
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-10">
                            <div class="row p-3" style="border: 1px dotted #000">
                                <div class="col-lg-8">
                                    <h2 class="checkout-title">Billing Details</h2>
                                    <!-- End .checkout-title -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Name *</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ Auth::user()->name }}" disabled required />
                                            @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- End .col-sm-6 -->
                                    </div>
                                    <!-- End .row -->

                                    <label>Street address *</label>
                                    <input type="text" class="form-control" name="address_1"
                                        value="{{ Auth::user()->address_1 }}" disabled placeholder="House number and Street name"
                                        required />
                                    @error('address_1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <input type="text" name="address_2" disabled value="{{ Auth::user()->address_2 }}"
                                        class="form-control" placeholder="Appartments, suite, unit etc ..." required />
                                    @error('address_2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>Postcode / ZIP *</label>
                                            <input type="text" name="pincode" disabled value="{{ Auth::user()->pincode }}"
                                                class="form-control" required />
                                            @error('pincode')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- End .col-sm-6 -->

                                        <div class="col-sm-6">
                                            <label>Phone *</label>
                                            <input type="number" disabled name="phone" value="{{ Auth::user()->phone }}"
                                                class="form-control" required />
                                            @error('phone')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <!-- End .col-sm-6 -->
                                    </div>
                                    <!-- End .row -->

                                    {{-- <label>Check In Pic Upload *</label>
                                    <input type="file" name="check_in_image" accept="image/*" capture="environment" class="form-control"
                                        required />
                                    @error('check_in_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror --}}

                                    <label>Deposited Amount *</label>
                                    <input type="number" value="{{ $product->price }}" readonly class="form-control"
                                        required />
                                </div>
                                <!-- End .col-lg-9 -->
                               <aside class="col-lg-4">
    <div class="summary">
        <h3 class="summary-title">Booking Information</h3>

        <table class="table table-summary">
            <tbody>
                <tr><td>Check In:</td>  <td>{{ $booking['check_in'] }}</td></tr>
                <tr><td>Check Out:</td> <td>{{ $booking['check_out'] }}</td></tr>
                <tr><td>Rent Days:</td> <td>{{ $days }} days</td></tr>

                <tr class="summary-subtotal">
                    <td>Base Rent:</td>
                    <td>₹ {{ number_format($totalRent,2) }}</td>
                </tr>

                @if($discount > 0)
                <tr>
                    <td>Discount ({{ $discount }}%):</td>
                    <td>- ₹ {{ number_format($discountAmount,2) }}</td>
                </tr>
                @endif

                <!--<tr>-->
                <!--    <td>Discounted Rent:</td>-->
                <!--    <td>₹ {{ number_format($discountedRent,2) }}</td>-->
                <!--</tr>-->

                <!--<tr class="summary-subtotal">-->
                <!--    <td>Deposit (Now):</td>-->
                <!--    <td>₹ {{ number_format($deposit,2) }}</td>-->
                <!--</tr>-->

                @if($refundAtCheckout > 0)
                <tr class="summary-subtotal">
                    <td>Extra Refundable Charge:</td>
                    <td>₹ {{ number_format($refundAtCheckout,2) }}
                        <small class="text-muted">(Refund at checkout)</small>
                    </td>
                </tr>
                @endif

                <tr class="summary-subtotal">
                    <td><b>Now Payable:</b></td>
                    <td><b>₹ {{ number_format($payNow,2) }}</b></td>
                </tr>

                <!--<tr class="summary-subtotal">-->
                <!--    <td><b>Refund at Checkout:</b></td>-->
                <!--    <td><b>₹ {{ number_format($refundAtCheckout,2) }}</b></td>-->
                <!--</tr>-->
            </tbody>
        </table>

        <button type="submit" class="placeorder_button">
            <span class="btn-text">Place Order</span>
        </button>
    </div>
</aside>

                                <!-- End .col-lg-3 -->
                            </div>
                        </div>
                    </div>
                    <!-- End .row -->
                </form>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .checkout -->
    </div>
    <!-- End .page-content -->
</main>
<!-- End .main -->



@endsection