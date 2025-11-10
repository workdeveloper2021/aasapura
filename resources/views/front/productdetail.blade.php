@extends('front.common.layout')
@section('content')
@section('title','Aashapura')
@section('header')

<style>
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
<style>
.booked-date a {
    background-color: #4caf50 !important;
    color: white !important;
    border-radius: 50%;
}
</style>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
<main class="main">
    <div class="page-content">
        <div class="product-details-top">
            <div class="bg-light pb-5 mb-4">
                <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
                    <div class="container d-flex align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ $product->title }}
                            </li>
                        </ol>
                    </div>
                    <!-- End .container -->
                </nav>
                <!-- End .breadcrumb-nav -->
                <div class="container">
                    <div class="col-md-12">
                        <div class="product-gallery product-gallery-vertical">
                            <div class="row">
                                <figure class="product-main-image">
                                    <img id="product-zoom" src="{{ url('products') }}/{{ $product->image1 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image1 }}"
                                        alt="product image" style="width: 100%; height: 500px; object-fit: fill" />

                                    <a href="javascript:void(0)" id="btn-product-gallery" class="btn-product-gallery">
                                        <i class="icon-arrows"></i>
                                    </a>
                                </figure>
                                <!-- End .product-main-image -->

                                <div id="product-zoom-gallery" class="product-image-gallery active">
                                    <a class="product-gallery-item" href="#"
                                        data-image="{{ url('products') }}/{{ $product->image1 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image1 }}">
                                        <img src="{{ url('products') }}/{{ $product->image1 }}" alt="product side"
                                            style="width: 100%; height: 100px !important" loading="lazy" />
                                    </a>

                                    <a class="product-gallery-item" href="#"
                                        data-image="{{ url('products') }}/{{ $product->image2 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image2 }}">
                                        <img src="{{ url('products') }}/{{ $product->image2 }}" alt="product side"
                                            style="width: 100%; height: 100px" loading="lazy" />
                                    </a>

                                    <a class="product-gallery-item" href="#"
                                        data-image="{{ url('products') }}/{{ $product->image3 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image3 }}">
                                        <img src="{{ url('products') }}/{{ $product->image3 }}" alt="product side"
                                            style="width: 100%; height: 100px" loading="lazy" />
                                    </a>


                                    <a class="product-gallery-item" href="#"
                                        data-image="{{ url('products') }}/{{ $product->image4 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image4 }}">
                                        <img src="{{ url('products') }}/{{ $product->image4 }}" alt="product side"
                                            style="width: 100%; height: 100px" loading="lazy" />
                                    </a>
                                    <?php if(isset($product->image5)){ ?>
                                    <a class="product-gallery-item" href="#"
                                        data-image="{{ url('products') }}/{{ $product->image5 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image5 }}">
                                        <img src="{{ url('products') }}/{{ $product->image5 }}" alt="product side"
                                            style="width: 100%; height: 100px" loading="lazy" />
                                    </a>
                                    <?php } ?>

                                    <?php if(isset($product->image6)){ ?>
                                    <a class="product-gallery-item" href="#"
                                        data-image="{{ url('products') }}/{{ $product->image6 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image6 }}">
                                        <img src="{{ url('products') }}/{{ $product->image6 }}" alt="product side"
                                            style="width: 100%; height: 100px" loading="lazy" />
                                    </a>
                                    <?php } ?>


                                    <?php if(isset($product->image7)){ ?>
                                    <a class="product-gallery-item" href="#"
                                        data-image="{{ url('products') }}/{{ $product->image7 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image7 }}">
                                        <img src="{{ url('products') }}/{{ $product->image7 }}" alt="product side"
                                            style="width: 100%; height: 100px" loading="lazy" />
                                    </a>
                                    <?php } ?>


                                    <?php if(isset($product->image8)){ ?>
                                    <a class="product-gallery-item" href="#"
                                        data-image="{{ url('products') }}/{{ $product->image8 }}"
                                        data-zoom-image="{{ url('products') }}/{{ $product->image8 }}">
                                        <img src="{{ url('products') }}/{{ $product->image8 }}" alt="product side"
                                            style="width: 100%; height: 100px" loading="lazy" />
                                    </a>
                                    <?php } ?>


                                </div>
                                <!-- End .product-image-gallery -->
                            </div>
                            <!-- End .row -->
                        </div>
                        <!-- End .product-gallery -->
                    </div>
                </div>
                <!-- End .container -->
            </div>
            <!-- End .bg-light pb-5 -->

            <div class="product-details product-details-separator">
                <div class="container">
                    <div class="row mb-5">
                        <div class="col-md-8 col-12">
                            <h1 class="product-title">
                                {{ $product->title }}
                            </h1>
                            <!-- End .product-title -->

                            <div class="ratings-container">
                                <div class="ratings">
                                    <div class="ratings-val" style="width: 80%"></div>
                                </div>

                                <a class="ratings-text" href="#product-review-link" id="review-link">( 200 Reviews )</a>
                            </div>

                            <div class="" style="
                    border-top: 1px dotted #000;
                    border-bottom: 1px dotted #000;
                    padding: 30px;
                  ">
                                <div class="d-flex align-center align-items-center" style="gap: 15px">
                                    <div style="width: 50px; height: 50px">
                                        <?php if (isset($user->image)) {?>

                                        <img src="{{ url('') }}/uploads/{{ $user->image }}" alt="user" style="
                                            border-radius: 50%;
                                            width: 100%;
                                            height: 100%;
                                          " />
                                        <?php }else{ ?>
                                        <img src="{{ url('') }}/defaultimages/userprofile.png" alt="user" style="
                          border-radius: 50%;
                          width: 100%;
                          height: 100%;
                        " />
                                        <?php  } ?>
                                    </div>
                                    <div class="text-left">
                                        <p class="font-weight-bold">Hosted by {{ $user->name }}</p>
                                        {{-- <p>Superhost · 5 years hosting</p> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="" style="border-bottom: 1px dotted #000; padding: 30px">
                                <div class="text-left">
                                    <div class="">
                                        <table>
                                            <tr>
                                                <th>Model Name : </th>
                                                <td>{{ $product->model_name }}</td>
                                            </tr>

                                            <tr>
                                                <th>Color : </th>
                                                <td>
                                                    <div class="rounded-box-pr" style="background-color:  <?php if ( $product->other_color) {
                                                    echo  $product->other_color;
                                                }else{echo $product->color;} ?>"></div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Model Name : </th>
                                                <td>{{ $product->model_name }}</td>
                                            </tr>

                                            <tr>
                                                <th>Depost : </th>
                                                <td>Rs.{{ $product->price }}</td>
                                            </tr>

                                            <tr>
                                                <th>Rent : </th>
                                                <td>Rs.{{ $product->rent }} Per/day</td>
                                            </tr>

                                            <tr>
                                                <th>Frame Size : </th>
                                                <td>{{ $product->frame_size }}</td>
                                            </tr>

                                            <tr>
                                                <th>Frame No : </th>
                                                <td>{{ $product->frame_no }}</td>
                                            </tr>

                                            <tr>
                                                <th>Frame Material : </th>
                                                <td>{{ $product->frame_material }}</td>
                                            </tr>

                                            <tr>
                                                <th>Speed. : </th>
                                                <td>{{ $product->speed }}</td>
                                            </tr>

                                            <tr>
                                                <th>Fork : </th>
                                                <td>{{ $product->fork }}</td>
                                            </tr>

                                            <tr>
                                                <th>Shifters : </th>
                                                <td>{{ $product->shifters }}</td>
                                            </tr>

                                            <tr>
                                                <th>Front Gear : </th>
                                                <td>{{ $product->front_gear }}</td>
                                            </tr>

                                            <tr>
                                                <th>Rear Gear : </th>
                                                <td>{{ $product->rear_gear }}</td>
                                            </tr>

                                            <tr>
                                                <th>Front Derailleur : </th>
                                                <td>{{ $product->front_derailleur }}</td>
                                            </tr>

                                            <tr>
                                                <th>Rear Derailleur : </th>
                                                <td>{{ $product->rear_derailleur }}</td>
                                            </tr>

                                            <tr>
                                                <th>Brake : </th>
                                                <td>{{ $product->brake }}</td>
                                            </tr>


                                            <?php  ?>

                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex align-center mb-3" style="gap: 15px">

                                    <div class="text-left">
                                        <?= $product->large_desc ?>
                                    </div>
                                </div>

                            </div>

                            <div class="text-left" style="border-bottom: 1px dotted #000; padding: 30px">
                                <div>
                                    <p>
                                        {{ \Illuminate\Support\Str::limit($product->description, 200, '...') }}
                                    </p>

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Show More
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        Description
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <p>
                                                        {{ $product->description }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="" style="border-bottom: 1px dotted #000; padding: 30px"> --}}
                                {{-- <div>
                                    <h4>What this place offers</h4>
                                </div> --}}
                                {{-- <div class="row"> --}}
                                    {{-- <div class="col-12 col-sm-6">
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-12 col-sm-6">
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-center mb-3" style="gap: 15px">
                                            <div>
                                                <div class="icon icon-ubuntu"></div>
                                            </div>
                                            <div class="text-left">
                                                <p class="font-weight-bold">
                                                    Dedicated workspace
                                                </p>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <!-- Button trigger modal -->
                                    {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#amenities">
                                        Show all 57 amenities
                                    </button> --}}

                                    <!-- Modal -->
                                    {{-- <div class="modal fade" id="amenities" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                        What this place offers
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row">
                                                        <div class="col-12 col-sm-12">
                                                            <div class="d-flex align-center mb-3" style="gap: 15px">
                                                                <div>
                                                                    <div class="icon icon-ubuntu"></div>
                                                                </div>
                                                                <div class="text-left">
                                                                    <p class="font-weight-bold">
                                                                        Dedicated workspace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-center mb-3" style="gap: 15px">
                                                                <div>
                                                                    <div class="icon icon-ubuntu"></div>
                                                                </div>
                                                                <div class="text-left">
                                                                    <p class="font-weight-bold">
                                                                        Dedicated workspace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-center mb-3" style="gap: 15px">
                                                                <div>
                                                                    <div class="icon icon-ubuntu"></div>
                                                                </div>
                                                                <div class="text-left">
                                                                    <p class="font-weight-bold">
                                                                        Dedicated workspace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-center mb-3" style="gap: 15px">
                                                                <div>
                                                                    <div class="icon icon-ubuntu"></div>
                                                                </div>
                                                                <div class="text-left">
                                                                    <p class="font-weight-bold">
                                                                        Dedicated workspace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex align-center mb-3" style="gap: 15px">
                                                                <div>
                                                                    <div class="icon icon-ubuntu"></div>
                                                                </div>
                                                                <div class="text-left">
                                                                    <p class="font-weight-bold">
                                                                        Dedicated workspace
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{--
                                </div> --}}
                                {{-- </div> --}}

                            {{-- <div class="">
                                <div>
                                    <p class="font-weight-bold">Select check-in date</p>
                                    <p>Add your travel dates for exact pricing</p>

                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1new" >Check In</label>
                                                <input type="date" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1new2">Check out</label>
                                                <input type="date" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <a href="#" class="btn-product"><span>Clear Dates</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>

                        <div class="col-md-4 col-12">
                   @php
    $checkIn = request('checkin');
    $checkOut = request('checkout');
@endphp

@if($checkIn && $checkOut)
    @if(!isProductAvailable($product->id, $checkIn, $checkOut))
        <div>
            <p style="text-align: center;color: #fff;background-color: #ff0000;padding: 15px 0px;">This cycle has been already booked.</p>
        </div>
    @else
        {{-- Show booking form --}}
        @include('partials.booking-form', ['product' => $product])
    @endif
@else
    {{-- @if(bookornotbook($product->id) == "Booked")
        <div>
            <p style="text-align: center;color: #fff;background-color: #ff0000;padding: 15px 0px;">This cycle has been already booked.</p>
        </div>
    @else --}}
        {{-- Show booking form --}}
        @include('partials.booking-form', ['product' => $product])
    {{-- @endif --}}
@endif

                        </div>
                    </div>
                    <!-- End .row -->

                    <div class="" style="border-top: 1px dotted #000; padding: 40px 0">
                        <div>
                            <h4>
                                <span class="icon icon-star mx-2" style="color: #e8c97a"></span>4.80 · 178 reviews
                            </h4>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-lg-3 col-sm-6">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <i class="icon-info-circle"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h3 class="icon-box-title">Accuracy</h3>
                                        <p style="color: #000; font-weight: bold">4.9</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End .col-lg-3 col-sm-6 -->

                            <div class="col-lg-3 col-sm-6">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <i class="icon-star-o"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h3 class="icon-box-title">Check-in</h3>
                                        <p style="color: #000; font-weight: bold">4.9</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End .col-lg-3 col-sm-6 -->

                            <div class="col-lg-3 col-sm-6">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <i class="icon-heart-o"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h3 class="icon-box-title">Communication</h3>
                                        <p style="color: #000; font-weight: bold">5</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End .col-lg-3 col-sm-6 -->

                            <div class="col-lg-3 col-sm-6">
                                <div class="icon-box text-center">
                                    <span class="icon-box-icon">
                                        <i class="icon-cog"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h3 class="icon-box-title">Location</h3>
                                        <p style="color: #000; font-weight: bold">5</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End .col-lg-3 col-sm-6 -->
                        </div>
                    </div>
                    <div class="" style="border-top: 1px dotted #000; padding: 40px 0">
                        <div class="row">
                            <?php foreach ($productreviews as $key => $value) {?>
                            <div class="col-12 col-sm-6">
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="javascript:void(0)">
                                                    <?= $value->name ?>
                                                </a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%"></div>
                                                    <!-- End .ratings-val -->
                                                </div>
                                                <!-- End .ratings -->
                                            </div>
                                            <!-- End .rating-container -->
                                            <?php if ($value->created_at->diffInDays(now(), false) == 0) {  ?>
                                            <span class="review-date">Today</span>
                                            <?php } else{ ?>
                                            <span class="review-date">{{ $value->created_at->diffInDays(now(), false)
                                                }} Days Ago</span>
                                            <?php } ?>
                                        </div>
                                        <!-- End .col -->
                                        <div class="col">

                                            <div class="review-content">
                                                <p>
                                                    <?= $value->feedback ?>
                                                </p>
                                            </div>

                                            <!-- End .review-action -->
                                        </div>
                                        <!-- End .col-auto -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                            </div>
                            <?php } ?>

                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

{{-- 
                        <a href="javascript:void(0)" onclick="loadallreviews('{{ $product->id }}')"
                            class="btn btn-primary btn-rounded mt-5 mb-5" data-toggle="modal"
                            data-target="#reviewModal"><i class="icon-thumbs-up"></i>Show all reviews</a> --}}
                    </div>

                    <div class="" style="border-top: 1px dotted #000; padding: 40px 0">
                        <div>
                            <h4>Meet your Host</h4>
                        </div>
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <!-- card user -->

                                <div class="shadow bg-white rounded mb-4" style="width: 100%; height: 230px">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="ml-5 mb-3">
                                            <div style="width: 100px; height: 100px">
                                                <img src="{{ url('website') }}/assets/images/blog/1.webp" alt="user"
                                                    style="
                              width: 100%;
                              height: 100%;
                              border-radius: 50%;
                            " />
                                                <div class="text-center">
                                                    <p style="color: #000; font-weight: bold">
                                                        Surajjamdade
                                                    </p>
                                                    <p style="color: #000; font-weight: 400">
                                                        Superhost
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="mb-1">
                                                <p style="
                              color: #000;
                              font-size: 18px;
                              font-weight: bold;
                            ">
                                                    738
                                                </p>
                                                <p style="
                              color: #000;
                              font-size: 10px;
                              font-weight: bold;
                            ">
                                                    Reviews
                                                </p>
                                            </div>

                                            <div class="mb-1" style="
                            width: 100%;
                            border-top: 1px solid #949292c3;
                            padding: 0;
                          ">
                                                <div class="mr-5 mt-1">
                                                    <p style="
                                color: #000;
                                font-size: 18px;
                                font-weight: bold;
                              ">
                                                        4.75
                                                    </p>
                                                    <p style="
                                color: #000;
                                font-size: 10px;
                                font-weight: bold;
                              ">
                                                        Rating
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="mb-1" style="
                            width: 100%;
                            border-top: 1px solid #949292c3;
                            padding: 0;
                          ">
                                                <div class="mr-5 mt-1">
                                                    <p style="
                                color: #000;
                                font-size: 18px;
                                font-weight: bold;
                              ">
                                                        7
                                                    </p>
                                                    <p style="
                                color: #000;
                                font-size: 10px;
                                font-weight: bold;
                              ">
                                                        Years hosting
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- education -->
                                <div class="d-flex align-center mb-3" style="gap: 20px">
                                    <span class="icon-box-icon">
                                        <i class="icon-star-o text-dark"></i>
                                    </span>
                                    <h6>
                                        Where I went to school: Parahyangan University Bandung
                                    </h6>
                                </div>
                                <div class="d-flex align-center mb-4" style="gap: 20px">
                                    <span class="icon-box-icon">
                                        <i class="icon-accusoft text-dark"></i>
                                    </span>
                                    <h6>My work: KHK + Gluck Stays</h6>
                                </div>
                                {{-- <p class="mb-3">
                                    Hello, I am Esther, together with Rudi, my husband we
                                    manage 7 unique holiday units with different...
                                </p> --}}
                                {{-- <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#userDetailModal">
                                    Show More
                                </button> --}}
                            </div>
                            <div class="col-12 col-md-8">
                                <div>
                                    <h5>Esther is a Superhost</h5>
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetur adipisicing
                                        elit. Reiciendis laborum alias repellendus sunt sit
                                        repudiandae unde quaerat. Officiis nostrum tenetur
                                        debitis perspiciatis. Vitae impedit minus repellendus
                                        quos? Sint veritatis reprehenderit est, quidem quia
                                        assumenda. Beatae fuga at quidem veritatis mollitia?
                                    </p>

                                    <div class="mt-4 mb-4">
                                        <h5>Host details</h5>
                                        <div>
                                            <h6>Response rate: 100%</h6>
                                            <h6>Responds within an hour</h6>
                                        </div>
                                    </div>
                                    {{-- <a href="#" class="btn btn-primary">Message To Host</a> --}}
                                    <div class="mt-5" style="border-top: 1px dotted #000; padding: 10px">
                                        <div>
                                            <img src="{{ url('website') }}/assets/images/logo.png" alt="logo"
                                                style="width: 100px; height: 20px" />
                                            <p style="font-size: 12px">
                                                To protect your payment, never transfer money or
                                                communicate outside of the Airbnb website or app.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End .container -->
            </div>
            <!-- End .product-details -->
        </div>
        <!-- End .product-details-top -->

        <div class="container">
            <div class="product-details-tab"></div>
            <!-- End .product-details-tab -->
        </div>
        <!-- End .container -->

        <div class="container">
            <h2 class="title text-center mb-4">Esther’s listings</h2>
            <!-- End .title text-center -->
            <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                data-owl-options='{
                        "nav": false,
                        "dots": true,
                        "margin": 20,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":1
                            },
                            "480": {
                                "items":2
                            },
                            "768": {
                                "items":3
                            },
                            "992": {
                                "items":4
                            },
                            "1200": {
                                "items":4,
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>


                @foreach($relatedproducts as $value)
                @include('front.partials.product-new', ['item' => $value])
                @endforeach
                <!-- End .product -->
            </div>
            <!-- End .owl-carousel -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-content -->
</main>

@section('footer')

<script>
$(function() {
    const bookedRanges = @json($bookedRanges);
    const today = new Date();

    // ✅ Utility: Parse date string (YYYY-MM-DD) as *local date* (not UTC)
    function parseLocalDate(str) {
        const parts = str.split('-');
        return new Date(parts[0], parts[1] - 1, parts[2]);
    }

    // ✅ Function to check if a date falls in any fully booked range
    function isDateBooked(date) {
        // compare in local timezone, not UTC
        for (let range of bookedRanges) {
            const start = parseLocalDate(range.start);
            const end = parseLocalDate(range.end);

            // Include both start and end dates in booked period
            if (date >= start && date <= end) {
                return [false, "booked-date", "Fully Booked"];
            }
        }
        return [true, "", "Available"];
    }

    // ✅ Initialize Check-In Datepicker
    $("#datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        minDate: today,
        beforeShowDay: isDateBooked,
        onSelect: function(selectedDate) {
            const checkinDate = $(this).datepicker('getDate');

            let maxCheckoutDate = null;
            for (let range of bookedRanges) {
                const start = parseLocalDate(range.start);
                if (start > checkinDate && (!maxCheckoutDate || start < maxCheckoutDate)) {
                    maxCheckoutDate = start;
                }
            }

            if (maxCheckoutDate) {
                maxCheckoutDate.setDate(maxCheckoutDate.getDate() - 1);
            }

            $("#datepicker2").datepicker("option", {
                minDate: checkinDate,
                maxDate: maxCheckoutDate || null
            });

            const checkoutDate = $("#datepicker2").datepicker('getDate');
            if (checkoutDate && checkoutDate < checkinDate) {
                $("#datepicker2").datepicker('setDate', checkinDate);
            }
        }
    });

    // ✅ Initialize Check-Out Datepicker
    $("#datepicker2").datepicker({
        dateFormat: "dd/mm/yy",
        minDate: today,
        beforeShowDay: isDateBooked
    });

    // ✅ Form Validation before submit
    $("form[action^='/book-items/']").on('submit', function(e) {
        const checkinDate = $("#datepicker").datepicker('getDate');
        const checkoutDate = $("#datepicker2").datepicker('getDate');

        if (!checkinDate || !checkoutDate) {
            alert("Please select both Check-In and Check-Out dates");
            e.preventDefault();
            return false;
        }

        if (checkoutDate < checkinDate) {
            alert("Check-Out date cannot be before Check-In date");
            e.preventDefault();
            return false;
        }

        // ✅ Check overlap with booked ranges
        for (let range of bookedRanges) {
            const start = parseLocalDate(range.start);
            const end = parseLocalDate(range.end);

            if ((checkinDate >= start && checkinDate <= end) ||
                (checkoutDate >= start && checkoutDate <= end) ||
                (checkinDate <= start && checkoutDate >= end)) {
                alert("Selected dates include a booked period. Please choose different dates.");
                e.preventDefault();
                return false;
            }
        }

        return true;
    });
});
</script>




<style>
/* ✅ Highlight booked dates in green */
.booked-date a {
    background-color: #4caf50 !important;
    color: white !important;
    border-radius: 50%;
}
</style>


<style>
/* Highlight booked dates in green */
.booked-date a {
    background-color: #4CAF50 !important;
    color: white !important;
    text-decoration: line-through;
    pointer-events: none;
}
</style>


<script src="{{ url('website') }}/assets/js/bootstrap-input-spinner.js"></script>

<script src="{{ url('website') }}/assets/js/jquery.magnific-popup.min.js"></script>
<script src="{{ url('website') }}/assets/js/jquery.elevateZoom.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

   <script>
        // Initialize Flatpickr
        flatpickr("#startdate", {
            dateFormat: "Y-m-d", // Specify date format
        });
    </script>
    
   

    


   <script>
    function parseDate(dateStr) {
        // Expected format: dd/mm/yyyy
        const parts = dateStr.split('/');
        return new Date(parts[2], parts[1] - 1, parts[0]); // year, month (0-based), day
    }

    function getDateDiff(checkIn, checkOut) {
        const oneDay = 24 * 60 * 60 * 1000;
        return Math.round((checkOut - checkIn) / oneDay);
    }

    function checkDiscount() {
        const checkInStr = $('.checkin_date').val();
        const checkOutStr = $('.checkout_date').val();

        if (!checkInStr || !checkOutStr) return;

        const checkIn = parseDate(checkInStr);
        const checkOut = parseDate(checkOutStr);

        const diffDays = getDateDiff(checkIn, checkOut);

        if (diffDays > 0) {
            $.ajax({
                url: '{{ route("check.offer") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    days: diffDays,
                    product_id: '{{ $product->id }}',
                    checkIn : checkInStr,
                    checkOut : checkOutStr
                },
         success: function(response) {
    // 🔹 1️⃣ Check availability first
    if (response.status === 'unavailable' || response.available === false) {
        let html = `
            <div class="alert alert-danger text-center p-4 rounded shadow-sm">
                <i class="bi bi-exclamation-triangle-fill fs-4"></i><br>
                ${response.message}
                ${response.available_from 
                    ? `<br><small class="text-muted">Next available from: <b>${response.available_from}</b></small>` 
                    : ''
                }
            </div>
        `;

        // Only show error
        $('#offer-message').html(html);

        // Change booking button text
        $('#bookingAmountvvv').text('Not Available');

        // ❌ Stop further execution (no summary, no discount etc.)
        return;
    }else{

    // 🔹 2️⃣ If available → show full booking summary
    const { message, discount, discount_amount, rent, deposit, days, total_rent, discounted_rent, extra_charge, pay_now, remaining_rent } = response;

    let extraHtml = '';
    if (parseFloat(extra_charge) > 0) {
        extraHtml = `
            <div class="col-md-12 mb-2">
                <span class="text-muted"><i class="bi bi-cash-stack"></i> Extra Refundable Charge:</span>
                <div class="fw-bold text-warning">₹${extra_charge} 
                    <small class="text-muted">(Refunded at checkout)</small>
                </div>
            </div>
        `;
    }

    let html = `
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <h4 class="mt-2 card-title mb-2 text-primary">
                    <i class="bi bi-receipt"></i> Booking Summary
                </h4>
                <div class="row mb-3">
                    <div class="col-md-6 mb-2">
                        <span class="text-muted"><i class="bi bi-cash-coin"></i> Per Day Rent:</span>
                        <div class="fw-bold text-dark">₹${rent}</div>
                    </div>
                    <div class="col-md-6 mb-2">
                        <span class="text-muted"><i class="bi bi-calendar-event"></i> Total Rent (${days} days):</span>
                        <div class="fw-bold text-dark">₹${total_rent}</div>
                    </div>
                    
                    <div class="col-md-6 mb-2">
                        <span class="text-muted"><i class="bi bi-percent"></i> Discount:</span>
                        <div class="fw-bold text-success">${discount}% (You saved ₹${discount_amount})</div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <span class="text-muted"><i class="bi bi-cash"></i> Discounted Rent:</span>
                        <div class="fw-bold text-dark">₹${discounted_rent}</div>
                    </div>

                    <div class="col-md-6 mb-2">
                        <span class="text-muted"><i class="bi bi-shield-lock"></i> Security Deposit:</span>
                        <div class="fw-bold text-dark">₹${deposit}</div>
                    </div>

                    ${extraHtml}

                    <div class="col-12 mt-3">
                        <div class="p-3 bg-light rounded border">
                            <h5 class="mb-0 fw-bold text-success">
                                <i class="bi bi-wallet2"></i> Pay Now: ₹${pay_now}
                            </h5>
                        </div>
                    </div>

                    <div class="col-12 mt-3">
                        <div class="p-3 bg-warning-subtle rounded border">
                            <h5 class="mb-0 fw-bold text-dark">
                                <i class="bi bi-clock"></i> You Will Get at Checkout: ₹${remaining_rent}
                            </h5>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info mt-4 mb-0">
                    <i class="bi bi-gift"></i> ${message}
                </div>
            </div>
        </div>
    `;

    $('#offer-message').html(html);
    $('#bookingAmountvvv').text(`Book Rs.${pay_now}`);
}

}

            });
        }
    }

    $(document).ready(function () {
        $('.checkin_date, .checkout_date').on('change', checkDiscount);
    });
</script>

    @endsection


<!-- reviewModal -->
{{-- <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                  Reviews
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-5">
                <div class="" style="border-top: 1px dotted #000; padding: 40px 0">
                    <div>
                        <h4>
                            <span class="icon icon-star mx-2" style="color: #e8c97a"></span>4.80 · 178 reviews
                        </h4>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-info-circle"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Accuracy</h3>
                                    <p style="color: #000; font-weight: bold">4.9</p>
                                </div>
                            </div>
                        </div>
                        <!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-star-o"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Check-in</h3>
                                    <p style="color: #000; font-weight: bold">4.9</p>
                                </div>
                            </div>
                        </div>
                        <!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-heart-o"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Communication</h3>
                                    <p style="color: #000; font-weight: bold">5</p>
                                </div>
                            </div>
                        </div>
                        <!-- End .col-lg-3 col-sm-6 -->

                        <div class="col-lg-3 col-sm-6">
                            <div class="icon-box text-center">
                                <span class="icon-box-icon">
                                    <i class="icon-cog"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Location</h3>
                                    <p style="color: #000; font-weight: bold">5</p>
                                </div>
                            </div>
                        </div>
                        <!-- End .col-lg-3 col-sm-6 -->
                    </div>
                </div>
                <div class="" style="border-top: 1px dotted #000; padding: 40px 0">


                    <div class="row" id="show_reviews"></div>

                    <div class="row">
                        <?php if (Auth::check()) { ?>
                        <div class="col-12">
                            <form action="/submit-rating" method="post" class="mt-2">
                                @csrf
                                <h5 class="mb-0">Give Review</h5>
                                <input type="text" name="product_id" id="" value="{{ $product->id }}" hidden>
                                <div class="star-rating">
                                    <input type="radio" name="rating" id="5-stars" value="5">
                                    <label for="5-stars">&#9733;</label>

                                    <input type="radio" name="rating" id="4-stars" value="4">
                                    <label for="4-stars">&#9733;</label>

                                    <input type="radio" name="rating" id="3-stars" value="3">
                                    <label for="3-stars">&#9733;</label>

                                    <input type="radio" name="rating" id="2-stars" value="2">
                                    <label for="2-stars">&#9733;</label>

                                    <input type="radio" name="rating" id="1-star" value="1">
                                    <label for="1-star">&#9733;</label>
                                </div>

                                <div class="review_descritpiton">
                                    <label for="">Feedback</label>
                                    <textarea name="feedback" id="" cols="30" rows="3"
                                        style="height:auto;min-height:auto;" class="form-control"></textarea>
                                </div>

                                <button type="submit" class="btn btn-success">Submit Rating</button>
                            </form>
                        </div>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> --}}


@endsection