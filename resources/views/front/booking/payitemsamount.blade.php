@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Book Cycle')

<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Pay Amount</h1>
        </div>
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Pay Amount
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
            key: "rzp_test_QnDKE8IS9ia1FB", // Enter the Key ID generated from the Dashboard
            // amount: '100', // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            currency: "INR",
            name: "Aashapura",
            description: "Test transaction",
            image: "{{ url('') }}/website/assets/images/logo.png",
            order_id: "{{ $data['order_id'] }}", // This is a sample Order ID. Pass the `id` obtained in the response of Step 1
            prefill: {
                name: "Aashapura",
                email: "gaurav.kumar@example.com",
                contact: "9000090000"
            },
            notes: {
                address: "Razorpay Corporate Office"
            },
              "cancel_url": "/book-cycle", // Redirect URL on cancel
                "modal": {
                    "ondismiss": function() {
                        // User closed the modal, redirect to your desired page
                        window.location.href = "/book-cycle";
                    }
                },
                
            theme: {
                "color": "#3399cc"
            },
            callback_url: "/verify-payment"
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }

    startPayment();
</script>

<script>
    document.querySelector('[data-testid="confirm-positive"]');

</script>


@endsection