@extends('front.common.layout')
@section('content')
@section('title','Aashapura')
@section('header')
<link rel="stylesheet" href="{{ url('website') }}/assets/css/plugins/magnific-popup/magnific-popup.css" />

<style>
    .pending-verification{
            background-color: #ffc800;
    padding: 2px 14px;
    border-radius: 5px;
    color: #fff !important;
    }
</style>
@endsection


<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">My Account</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    My Account
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row p-5" style="border: 1px dotted #000">
                    <aside class="col-md-4 col-lg-3">
                        <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab-dashboard-link" data-toggle="tab"
                                    href="#tab-dashboard" role="tab" aria-controls="tab-dashboard"
                                    aria-selected="true">Dashboard</a>
                            </li>
                      

                            <li class="nav-item">
                                <a class="nav-link" id="tab-Cards-link" data-toggle="tab" href="#tab-Cards" role="tab"
                                    aria-controls="tab-Cards" aria-selected="false">Saved Cards</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab-account-link" data-toggle="tab" href="#tab-account"
                                    role="tab" aria-controls="tab-account" aria-selected="false">Account Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Sign Out</a>
                            </li>
                        </ul>
                    </aside>
                    <!-- End .col-lg-3 -->

                    <div class="col-md-8 col-lg-9" style="border-left: 1px dotted #000">
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="tab-dashboard" role="tabpanel"
                                aria-labelledby="tab-dashboard-link">
                                <p>
                                    Hello
                                    <span class="font-weight-normal text-dark">User</span>
                                    (not
                                    <span class="font-weight-normal text-dark">User</span>?
                                    <a href="#">Log out</a>)
                                    <br />
                                    From your account dashboard you can view your
                                    <a href="#tab-orders" class="tab-trigger-link link-underline">recent Posts</a>,
                                    manage your
                                    <a href="#tab-address" class="tab-trigger-link">
                                        Business Packages</a>, and
                                    <a href="#tab-account" class="tab-trigger-link">edit your password and account
                                        details</a>.
                                        
                                        {{-- <div class="bg-light p-4">
                                            <ul class="mb-0">
                                                <li class="mb-1">Email Verification - <?php if(Auth::user()->email_verify == "Y"){ ?> 
                                                <a href="javascript:void(0)" onclick="this.innerHTML = 'Verified'" class="pending-verification bg-success">Verified</a></li>
                                                <?php }else{ ?>
                                                <a href="/send-verify-email/{{ Auth::user()->email }}" onclick="this.innerHTML = 'Sending Email...' " class="pending-verification">Verify</a> <?php  } ?> </li>
                                                <li>Aadhar Verification - <a href="/verify-email" class="pending-verification">Verify</a> </li>
                                            </ul>
                                        </div> --}}
                                        
                                </p>
                            </div>
                            <!-- .End .tab-pane -->

                         

                            <?php
                            $carddetails = Auth::user()->card_details;
                            $decodecard_details = json_decode($carddetails);
                            if(isset($decodecard_details)){
                                $rr = $decodecard_details->cardnumber;
                            }else{
                                $rr = '0000-0000-0000-0000';
                            }
                            $cardnumber = explode("-",$rr);


                            ?>
                            <div class="tab-pane fade" id="tab-Cards" role="tabpanel" aria-labelledby="tab-Cards-link">
                                <div class="row">
                                    <div class="col-12 col-sm-6">
                                        <div class="bank_card">
                                            <div class="bank_card-inner">
                                                <div class="bank_front">
                                                    <img src="https://i.ibb.co/PYss3yv/map.png" class="bank_map-img" />
                                                    <div class="bank_row">
                                                        <img src="https://i.ibb.co/G9pDnYJ/chip.png" width="60px" />
                                                        <img src="https://i.ibb.co/WHZ3nRJ/visa.png" width="60px" />
                                                    </div>
                                                    <div class="bank_row bank_card-no">
                                                        <p>
                                                            <?php echo  $cardnumber[0] ? $cardnumber[0] : '0000'; ?>
                                                        </p>
                                                        <p>
                                                            <?php echo  $cardnumber[1] ? $cardnumber[1] : '0000'; ?>
                                                        </p>
                                                        <p>
                                                            <?php echo  $cardnumber[2] ? $cardnumber[2] : '0000'; ?>
                                                        </p>
                                                        <p>
                                                            <?php echo  $cardnumber[3] ? $cardnumber[3] : '0000'; ?>
                                                        </p>
                                                    </div>
                                                    <div class="bank_row bank_card-holder">
                                                        <p>
                                                            <?php if(isset($decodecard_details->bank_name)){ echo $decodecard_details->bank_name; }else{echo "Test Bank";} ?>
                                                        </p>
                                                        <p>VALID TILL</p>
                                                    </div>
                                                    <div class="bank_row bank_name">
                                                        <p>
                                                            <?php if(isset($decodecard_details->bank_holder_name)){echo $decodecard_details->bank_holder_name;}else{echo "Test Name";} ?>
                                                        </p>
                                                        <p>
                                                            <?php if(isset($decodecard_details->expiry_month)){echo $decodecard_details->expiry_month;}else{echo "00";} ?>
                                                            /
                                                            <?php if(isset($decodecard_details->expiry_year)){echo $decodecard_details->expiry_year;}else{echo "00";} ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="bank_back">
                                                    <img src="https://i.ibb.co/PYss3yv/map.png" class="bank_map-img" />
                                                    <div class="bank_bar"></div>
                                                    <div class="row bank_card-cvv">
                                                        <div>
                                                            <img src="https://i.ibb.co/S6JG8px/pattern.png" />
                                                        </div>
                                                        <p>
                                                            <?php if(isset($decodecard_details->cvv)){echo $decodecard_details->cvv;}else{echo "000";} ?>
                                                        </p>
                                                    </div>
                                                    <div class="row bank_card-text">
                                                        <p class="text-white">
                                                            this is sbi card of suraj
                                                        </p>
                                                    </div>
                                                    <div class="row bank_signature">
                                                        <p>CUSTOMER SIGNATURE</p>
                                                        <img src="https://i.ibb.co/WHZ3nRJ/visa.png" width="80px" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-5">
                                        <form method="post" action="/savecards" enctype="multipart/form-data">
                                            @csrf
                                            <div class="row bg-gray p-4">
                                                <div class="col-sm-12">
                                                    <label>Card Number *</label>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <input type="text" maxlength="4" id="box1"
                                                                name="card_number[]" value="<?php if($cardnumber[0] == "
                                                                0000"){}else{echo $cardnumber[0];} ?>"
                                                            oninput="moveToNext(this, 'box2')"
                                                            class="form-control p-0 text-center" />
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" maxlength="4" id="box2"
                                                                name="card_number[]" value="<?php if($cardnumber[1] == "
                                                                0000"){}else{echo $cardnumber[1]; } ?>"
                                                            oninput="moveToNext(this, 'box3')"
                                                            class="form-control p-0 text-center" />
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" maxlength="4" id="box3"
                                                                name="card_number[]" value="<?php if($cardnumber[2] == "
                                                                0000"){}else{echo $cardnumber[2];} ?>"
                                                            oninput="moveToNext(this, 'box4')"
                                                            class="form-control p-0 text-center" />
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="text" value="<?php if($cardnumber[3] == "
                                                                0000"){}else{echo $cardnumber[3];} ?>"
                                                            maxlength="4" id="box4" name="card_number[]"
                                                            class="form-control p-0 text-center" />
                                                        </div>
                                                    </div>
                                                    @error('card_number')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <!-- End .col-sm-6 -->

                                                <div class="col-sm-12">
                                                    <label>Bank Name *</label>
                                                    <input type="text" name="bank_name"
                                                        value="<?php if(isset($decodecard_details->bank_name)){ echo $decodecard_details->bank_name; } ?>"
                                                        class="form-control" />
                                                    @error('bank_name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-12">
                                                    <label>Bank Holder Name *</label>
                                                    <input type="text"
                                                        value="<?php if(isset($decodecard_details->bank_holder_name)){echo $decodecard_details->bank_holder_name;} ?>"
                                                        name="bank_holder_name" class="form-control" />
                                                    @error('bank_holder_name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="col-sm-12">
                                                    <label>Expiry Date *</label>
                                                    <div class="d-flex align-items-center">
                                                        <select id="expiry-month" class="form-control m-0"
                                                            name="expiry_month">
                                                            <option <?php if(isset($decodecard_details->
                                                                expiry_month)){if($decodecard_details->expiry_month ==
                                                                "01"){echo "selected";} } ?> value="01">01</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "02"){echo "selected";} } ?> value="02">02</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "03"){echo "selected";}} ?> value="03">03</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "04"){echo "selected";} }?> value="04">04</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "05"){echo "selected";}} ?> value="05">05</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "06"){echo "selected";}} ?> value="06">06</option>
                                                            <option <?php if(isset($decodecard_details->
                                                                expiry_month)){if($decodecard_details->expiry_month ==
                                                                "07"){echo "selected";}} ?> value="07">07</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "08"){echo "selected";} } ?> value="08">08</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "09"){echo "selected";} } ?> value="09">09</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "10"){echo "selected";} } ?> value="10">10</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "11"){echo "selected";}} ?> value="11">11</option>
                                                            <option <?php if(isset($decodecard_details->expiry_month)){
                                                                if($decodecard_details->expiry_month ==
                                                                "12"){echo "selected";}} ?> value="12">12</option>
                                                        </select>
                                                        <select id="expiry-year" class="form-control m-0"
                                                            name="expiry_year">
                                                            <option
                                                                value="<?php if(isset($decodecard_details->expiry_year)){ echo $decodecard_details->expiry_year; } ?>">
                                                                <?php if(isset($decodecard_details->expiry_year)){echo $decodecard_details->expiry_year;} ?>
                                                            </option>
                                                        </select>
                                                    </div>
                                                    @error('expiry_month')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror

                                                    @error('expiry_year')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror

                                                </div>

                                                <div class="col-sm-12">
                                                    <label>cvv *</label>
                                                    <input type="number" class="form-control"
                                                        value="<?php if(isset($decodecard_details->cvv)){echo $decodecard_details->cvv;} ?>"
                                                        name="cvv" />
                                                    @error('cvv')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <!-- End .col-sm-6 -->
                                                <button type="submit" class="btn btn-outline-primary-2">
                                                    <span>SAVE CHANGES</span>
                                                    <i class="icon-long-arrow-right"></i>
                                                </button>
                                            </div>
                                            <!-- End .row -->
                                        </form>
                                    </div>
                                </div>
                                <!-- End .row -->
                            </div>
                            <!-- .End .tab-pane -->

                            <div class="tab-pane fade" id="tab-account" role="tabpanel"
                                aria-labelledby="tab-account-link">
                                <div class="row">
                                    <div class="col-lg-6 col-12">
                                        <table class="table table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">{{ Auth::user()->name }}</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">{{ Auth::user()->email }}</th>
                                                </tr>

                                                <tr>
                                                    <th scope="col">Phone Number</th>
                                                    <th scope="col">{{ Auth::user()->phone }}</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Address 1</th>
                                                    <th scope="col">{{ Auth::user()->address_1 }}</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Address 2</th>
                                                    <th scope="col">{{ Auth::user()->address_2 }}</th>
                                                </tr>
                                               
                                                <tr>
                                                    <th scope="col">Current Address</th>
                                                    <th scope="col">{{ Auth::user()->current_address }}</th>
                                                </tr>
                                              
                                              
                                                <tr>
                                                    <th scope="col">Current Address Document</th>
                                                    <th scope="col">
                                                          @if(Auth::user()->current_address_document)
            <p class="mt-2">
                Existing: 
                <a href="{{ asset('uploads/' . Auth::user()->current_address_document) }}" target="_blank">
                    View Document
                </a>
            </p>
            @else
            No Document Found
        @endif
                                                    </th>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <th scope="col">Pin Code</th>
                                                    <th scope="col">{{ Auth::user()->pincode }}</th>
                                                </tr>
                                                <tr>
                                                    <th scope="col">Photo</th>
                                                    <th scope="col" class="profile_image">
                                                        @if (Auth::user()->image)
                                                        <img src="{{ url('uploads') }}/{{ Auth::user()->image }}"
                                                            width="80px" />
                                                        @else
                                                        <img src="{{ url('') }}/defaultimages/userprofile.png"
                                                            width="80px" loading="lazy" alt="">
                                                        @endif

                                                    </th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="col-lg-6 col-12">
                                        <form action="/update-profile" enctype="multipart/form-data" method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Name *</label>
                                                    <input type="text" name="name" value="{{ Auth::user()->name }}"
                                                        class="form-control" required="" />
                                                    @error('name')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-sm-12">
                                                    <label>Phone Number *</label>
                                                    <input type="number" value="{{ Auth::user()->phone }}" name="phone"
                                                        class="form-control" required="" />
                                                    @error('phone')
                                                    <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <!-- End .col-sm-6 -->
                                            </div>
                                            <!-- End .row -->

                                               <div class="mb-3">
        <label class="form-label">Address 1</label>
        <input type="text" name="address_1" class="form-control"
               value="{{ old('address_1', Auth::user()->address_1) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Address 2</label>
        <input type="text" name="address_2" class="form-control"
               value="{{ old('address_2', Auth::user()->address_2) }}">
    </div>

    <div class="form-check mb-2 d-flex align-items-center">
        <input class="form-check-input" type="checkbox" id="sameAsPermanent">
        <label class="form-check-label" style="margin-left: 10px;margin-top: 6px;" for="sameAsPermanent">
            Current address same as above
        </label>
    </div>

    <div class="mb-3">
        <label class="form-label">Current Address</label>
        <textarea name="current_address" id="current_address"
                  class="form-control">{{ old('current_address', Auth::user()->current_address) }}</textarea>
    </div>

<div class="mb-3">
        <label class="form-label">Current Address Document</label>
        <input type="file" name="current_address_document" class="form-control"
               accept=".pdf,.jpg,.jpeg,.png">
        @if(Auth::user()->current_address_document)
            <p class="mt-2">
                Existing: 
                <a href="{{ asset('uploads/' . Auth::user()->current_address_document) }}" target="_blank">
                    View Document
                </a>
            </p>
        @endif
    </div>
    
                                            <label>Pin Code *</label>
                                            <input type="number" name="pincode" value="{{ Auth::user()->pincode }}"
                                                class="form-control" required="" />
                                            @error('pin_code')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                            <label>Profile Image</label>
                                            <input type="file" class="form-control" name="image" accept="image/*" />

                                            <button type="submit" class="btn btn-outline-primary-2">
                                                <span>SAVE CHANGES</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                        </form>
                                        
                                        
                                        <script>
                                            document.addEventListener('DOMContentLoaded', function () {
    const checkbox = document.getElementById('sameAsPermanent');
    const currentAddr = document.getElementById('current_address');
    const addr1 = document.querySelector('[name="address_1"]');
    const addr2 = document.querySelector('[name="address_2"]');

    checkbox.addEventListener('change', function () {
        if (this.checked) {
            currentAddr.value = `${addr1.value} ${addr2.value}`.trim();
            currentAddr.setAttribute('readonly', true);
        } else {
            currentAddr.removeAttribute('readonly');
        }
    });

    // If user edits address1/2 while checkbox ticked, update current automatically
    [addr1, addr2].forEach(el => {
        el.addEventListener('input', () => {
            if (checkbox.checked) {
                currentAddr.value = `${addr1.value} ${addr2.value}`.trim();
            }
        });
    });
});
                                        </script>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- .End .tab-pane -->
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
    function moveToNext(current, nextFieldID) {
if (current.value.length >= current.maxLength) {
    document.getElementById(nextFieldID).focus();
}
}


document.addEventListener("DOMContentLoaded", function() {
    const yearSelect = document.getElementById('expiry-year');
    const currentYear = new Date().getFullYear();
    const endYear = currentYear + 10; // You can adjusst the number of years

    for (let year = currentYear; year <= endYear; year++) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }
});


</script>

@endsection


@endsection
