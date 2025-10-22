
<?php

    $metatitle =  'Bulk Enquires - Aashapura';
    $metatags =   'not found';
    $desc =   'not found';

?>

@section('title', $metatitle)
@section('metatags', $metatags)
@section('desc', $desc)

@extends('front.common.layout')
@section('content')
@section('title','Aashapura')

<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title text-white">Bulk Enquiry to Vendors</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Enquiry
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="row">
                                <div class="col-12 text-center">
                                    <h4 class="border-bottom pb-3  height_vr">Need Products in Bulk? Connect with Multiple Vendors Instantly!</h4>
                                <br>
                                </div>
                                <div class="col-sm-6 col-md-4">
                                    <label for="">Name</label>
                                    <input type="text" required name="name" value="{{ old('name',Auth::user()->name ?? "") }}" class="form-control">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6  col-md-4">
                                    <label for="">Email</label>
                                    <input type="text" required name="email" value="{{ old('email', Auth::user()->email ?? "") }}" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-sm-6  col-md-4">
                                    <label for="">Phone</label>
                                    <input type="text" required name="phone" value="{{ old('phone', Auth::user()->phone ?? "") }}" class="form-control">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="">Address 1</label>
                                    <textarea required name="address_1" id="" rows="2" style="min-height: auto"
                                        class="form-control">{{ old('address_1',Auth::user()->address_1 ?? "") }}</textarea>
                                    @error('address_1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="">Check In Date</label>
                                    <input type="text" id="datepicker" required name="check_in_date" value="{{ old('check_in_date') }}" class="form-control">
                                    @error('check_in_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6 col-md-4">
                                    <label for="">Check Out Date</label>
                                    <input type="text" id="datepicker2" required name="check_out_date" value="{{ old('check_out_date') }}" class="form-control">
                                    @error('check_out_date')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                              
                                <div class="col-sm-6  col-md-4">
                                    <label for="">Entery Your Quantity Here</label>
                                    <input type="text" required name="quantity" value="{{ old('quantity') }}" class="form-control">
                                    @error('quantity')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                @php
                                    $vendors = \App\Models\User::where('role', 'vendor')->get();
                                @endphp

<div class="col-sm-6 col-md-4">
    <label for="">Select Vendor</label>
    <select class="form-control" name="vendor_id" id="vendor_id" required>
        <option value="">Select Vendor</option>
        @foreach($vendors as $vendor)
            <option value="{{ $vendor->id }}" {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                {{ $vendor->name }}
            </option>
        @endforeach
    </select>
    @error('vendor_id')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>



                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Send Enquiry</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .dashboard -->
    </div>
</main>

@section('header')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('footer')
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
      // Get today's date
    var today = new Date();
    
    // Initialize checkin datepicker with min date as today
    $("#datepicker").datepicker({
        dateFormat: "dd/mm/yy",
        minDate: today,
        onSelect: function(selectedDate) {
            // When a checkin date is selected, update checkout min date
            var checkinDate = $(this).datepicker('getDate');
            
            // Update the checkout datepicker's minimum date
            $("#datepicker2").datepicker("option", "minDate", checkinDate);
            
            // If checkout date is before the new checkin date, reset it to checkin date
            var checkoutDate = $("#datepicker2").datepicker('getDate');
            if (checkoutDate && checkoutDate < checkinDate) {
                $("#datepicker2").datepicker('setDate', checkinDate);
            }
        }
    });

      // Initialize checkout datepicker
      $("#datepicker2").datepicker({
        dateFormat: "dd/mm/yy",
        minDate: $("#datepicker").datepicker('getDate') || today
    });
    
</script>
@endsection

@endsection



