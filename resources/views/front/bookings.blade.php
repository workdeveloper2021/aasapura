@extends('front.common.layout')
@section('content')
@section('title','Aashapura')
@section('header')
<link rel="stylesheet" href="{{ url('website') }}/assets/css/plugins/magnific-popup/magnific-popup.css" />
<style>
    
    .dd_danger {
        background-color: #dc3545;
        width: max-content;
        margin: auto;
        color: #fff;
        padding: 4px 17px;
        font-size: 12px;
        font-weight: 600;
        min-width: 120px;
    }
    .mybutton{
     background-color: #4CAF50;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    font-size: 12px;
    transition: background-color 0.3s ease
    }

    .mybutton:hover {
  background-color: #45a049;
}


    .rounded-box-pr {
        width: 20px;
        height: 20px;
        border-radius: 100%;
    }

    .star-rating {
        direction: rtl;
        font-size: 2rem;
        unicode-bidi: bidi-override;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        color: #ccc;
        cursor: pointer;
        font-size: 30px;
    }

    .star-rating input[type="radio"]:checked~label {
        color: #f5b301;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #f5b301;
    }

</style>
</head>
@endsection

<!--  View modal -->
<div class="modal fade" id="viewEditModal" tabindex="-1" aria-labelledby="viewEditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-4">
                    <div class="col-12">
                        <div id="booking_detils"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="bookingEditModal" tabindex="-1" aria-labelledby="bookingEditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Booking Edit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="">
                    <form action="/calculate-checkout-payment" class="row p-4" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <div>
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label" style="color: #000">Check Out Date *</label>
                                      

                                            <input type="date" name="checkout_date" class="form-control" id="checkout_date_input" required
    style="height: 50px; background: none; border: 1px dotted #000;" />


                                            <input type="hidden" name="check_in_date" id="check_in_date">
                                        </div>
                                    </div>

                                    <div class="col-12 col-sm-6">
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label" style="color: #000">Check Out Product Pic *</label>
                                            <input type="number" name="booking" hidden id="bookingidenty">
                                            <input type="hidden" name="product_id" id="product_id">

                                            <input type="file" class="form-control" name="check_out_image" id="exampleInputPassword1" required
                                                style="height: 50px; background: none; border: 1px dotted #000;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Calculate & Proceed to Payment
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>






<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">My Booking</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    My Booking
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-12">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif


                        <table class="table table-bordered table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Cycle</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Check In</th>
                                    <th scope="col">Check Out</th>
                                    <th scope="col">Deposit</th>
                                    <th scope="col">Booking Status</th>
                                    <th scope="col">Checkout Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($booking as $key => $value) { ?>
                                    <tr>
                                        <th scope="row">
                                            <?= $key + 1 ?>
                                        </th>
                                        <td><?= $value->product->title ?? "N/A" ?></td>
                                        <td><?= $value->name ?></td>
                                        <td><?php
                                            $dateTime = new DateTime($value->check_in);
                                            echo $dateTime->format('d-m-Y');
                                        ?></td>
                                        <td>
                                            <?php
                                            $dateTime = new DateTime($value->check_out);
                                            echo $dateTime->format('d-m-Y');

                                            ?></td>
                                        <td>
                                            <span class="badge px-5"
                                                style="background: #00800069; color: #fff">Rs.<?= $value->paid_amount ?></span>
                                        </td>
                                        <td>

                                            <?php if ($value->booking_status_user == "running") {
                                                if ($value->owner_status == "accept") { ?>
                                                    <p class="dd_danger bg-success">Booked</p>
                                                <?php } else { ?>
                                                    <p class="dd_danger bg-warning">Panding</p>
                                                <?php } ?>

                                            <?php } else { ?>
                                                <div class="dd_danger">Cancelled</div>
                                            <?php } ?>

                                        </td>

                                        <td>
                                            <?php if ($value->checkout_status == "pending") { ?>
                                                <p class="dd_danger bg-warning">Pending</p>
                                            <?php } elseif ($value->checkout_status == "applied") { ?>
                                                <p class="dd_danger bg-info">Applied</p>
                                            <?php } elseif ($value->checkout_status == "accept") { ?>
                                                <p class="dd_danger bg-success">Success</p>

                                                {{-- @if( empty($value->product->reviews[0]['id'])) --}}

                                                <button class="mybutton mt-1" data-toggle="modal" data-target="#feedbackmodel{{ $key }}">Feedback</button>
                                                
                                                @include('partials.feedbackModal' , ['product' => $value->product ?? [] , 'key' => $key ])
                                               {{-- @endif --}}
                                            <?php } else { ?>
                                                <p class="dd_danger bg-danger">Rejected</p>
                                            <?php } ?>
                                        </td>

                                        <td style="padding:0px">
                                            <?php if ($value->booking_status_user == "running") { ?>
                                                <button type="button" class="btn-info btn-sm"
                                                    style="width: 50px; height: 30px" data-toggle="modal"
                                                    data-target="#viewEditModal" onclick="viewmodel('<?= $value->id ?>')">
                                                    View
                                                </button>
                                                <?php if ($value->checkout_status == "accept") {
                                                } else { ?>


                                                    <button type="button" class="btn-warning btn-sm"
                                                        style="width: 50px; height: 30px" data-toggle="modal"
                                                        data-target="#bookingEditModal" onclick="openeditmodel('<?= $value->id ?>', '<?= $value->check_in ?>', '<?= $value->product_id ?>')">
                                                        Edit
                                                    </button>

                                                <?php } ?>
                                                <?php if ($value->owner_status == "accept") {
                                                } else { ?>
                                                    <button type="button" onclick="cancelbooking(<?= $value->id ?>)" class="btn-danger btn-sm"
                                                        style="width: 50px; height: 30px">
                                                        Cancel
                                                    </button>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <button type="button" class="btn-info btn-sm"
                                                    style="width: 50px; height: 30px" data-toggle="modal"
                                                    data-target="#viewEditModal" onclick="viewmodel('<?= $value->id ?>')">
                                                    View
                                                </button>
                                            <?php } ?>
                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End .col-lg-9 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .dashboard -->
    </div>
</main>

@section('footer')




<script>

    
function openeditmodel(id, check_in_date, product_id) {
    document.getElementById('bookingidenty').setAttribute("value", id);
    document.getElementById('check_in_date').setAttribute("value", check_in_date);
    document.getElementById('product_id').setAttribute("value", product_id);
    
    // Directly set the min attribute using the database format (YYYY-MM-DD)
    // This should work because HTML date inputs expect YYYY-MM-DD format
    document.getElementById('checkout_date_input').min = check_in_date;
    
    console.log("Setting min date to:", check_in_date); // For debugging
}





    function viewmodel(id) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        $.ajax({
            url: "/bookingview", // Route to handle the request
            method: "POST",
            data: {
                booking: id,
            },
            success: function(response) {
                if (response.status == "error") {
                    var data = "Item Not Found !";
                    $("#booking_detils").html(data);
                } else {
                    $("#booking_detils").html(response);
                }

            },
            error: function(xhr, status, error) {
                console.log(xhr);
                console.log(status);
                console.log(error);
            },
        });
    }
</script>

@endsection


@endsection