@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Checkout Payment')

<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Checkout Payment</h1>
        </div>
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item"><a href="/my-bookings">My Bookings</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Checkout Payment
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>Payment Details</h5>
                            </div>
                            <div class="card-body">

                                @php
                                    $totalAmount = $finalamount;
                                  
                                    $remainAmount = $totalAmount - $booking->paid_amount;
                                    
                                @endphp

                                <p><strong>Rental Days:</strong> {{ $checkoutData['days'] }} days</p>
                                <p><strong>Total Amount:</strong> ₹{{ $totalAmount ?? 0 }}</p>
                                <p><strong>Your Paid Amount:</strong> ₹{{ $booking->paid_amount ?? 0 }}</p>
                              
                               
                                
                                <?php 
                                
                                if ($remainAmount > 0) {
                                ?>
                                   <p class="alert alert-danger"><strong>Please Make Your Remaining Payment :</strong> ₹{{ $remainAmount ?? 0 }}</p>
                                <div class="text-center mt-4">
                                  
                                    <button class="btn btn-primary" onclick="startPayment()">Proceed to Payment</button>
                                </div>
                                <?php } else {  ?>

                                  <p class="alert alert-success">
                                                <strong>Good news!</strong> ₹{{ abs($remainAmount ?? 0) }} will be credited back to you at checkout..
                                                
                                    <div class="text-center mt-4">
                                    <a href="/continue-to-checkout-without-gt?remainamt=<?= $booking->id ?? 0 ?>" class="btn btn-primary text-white">Confirm & Continue to Checkout</a>
                                </div>

                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End .container -->
        </div>
        <!-- End .checkout -->
    </div>
    <!-- End .page-content -->
</main>

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    function startPayment() {
        var options = {
            key: "rzp_test_QnDKE8IS9ia1FB",
            currency: "INR",
            name: "Aashapura",
            description: "Checkout Payment",
            image: "{{ url('') }}/website/assets/images/logo.png",
            order_id: "{{ $orderId }}",
            prefill: {
                name: "{{ Auth::user()->name }}",
                email: "{{ Auth::user()->email }}",
                contact: "{{ Auth::user()->phone }}"
            },
            notes: {
                address: "Razorpay Corporate Office"
            },
            "cancel_url": "/my-bookings",
            "modal": {
                "ondismiss": function() {
                    window.location.href = "/my-bookings";
                }
            },
            theme: {
                "color": "#3399cc"
            },
            // Remove the callback_url
            // Instead, use the handler function:
            handler: function (response){
                // Get the payment ID and other details
                var paymentId = response.razorpay_payment_id;
                var razorpay_order_id = response.razorpay_order_id;
                var razorpay_signature = response.razorpay_signature;
                
                // Create a form dynamically to submit these details
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/verify-checkout-payment';
                
                // Add CSRF token
                var csrfField = document.createElement('input');
                csrfField.type = 'hidden';
                csrfField.name = '_token';
                csrfField.value = '{{ csrf_token() }}';
                form.appendChild(csrfField);
                
                // Add payment details
                var paymentIdField = document.createElement('input');
                paymentIdField.type = 'hidden';
                paymentIdField.name = 'razorpay_payment_id';
                paymentIdField.value = paymentId;
                form.appendChild(paymentIdField);
                
                var orderIdField = document.createElement('input');
                orderIdField.type = 'hidden';
                orderIdField.name = 'razorpay_order_id';
                orderIdField.value = razorpay_order_id;
                form.appendChild(orderIdField);
                
                var signatureField = document.createElement('input');
                signatureField.type = 'hidden';
                signatureField.name = 'razorpay_signature';
                signatureField.value = razorpay_signature;
                form.appendChild(signatureField);
                
                // Append form to body and submit
                document.body.appendChild(form);
                form.submit();
            }
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }
</script>

@endsection
