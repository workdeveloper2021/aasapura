@extends('admin.layout.layout')
@section('title','Dashboard - Product List')

@section('content')



<style>
    .categoryimage {
        width: 100px;
        height: 60px;
        border-radius: 7px;
        object-fit: contain;
    }

    .success_button {
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
    }

    .br_image {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        border: 1px solid #eee;
        object-fit: contain;
    }

    .products_images img {
        margin-right: 10px;
        width: 70px;
        border: 1px solid #eee;
        padding: 6px;
        height: 70px;
        object-fit: contain;
    }
</style>

<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10 text-capitalize">{{ $row->role }} - {{ $row->name }}</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)" class="text-capitalize">{{
                                    $row->role }} View</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{ $row->name }}</td>
                                    </tr>


                                    <tr>
                                        <th>Email</th>
                                        <td>{{ $row->email }}</td>
                                    </tr>


                                    <tr>
                                        <th>Phone</th>
                                        <td>
                                            <?= $row->phone ? $row->phone : "" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Address 1</th>
                                        <td>
                                            <?= $row->address_1 ? $row->address_1 : "" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Address 2</th>
                                        <td>
                                            <?= $row->address_2 ? $row->address_2 : "" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pincode</th>
                                        <td>
                                            <?= $row->pincode ? $row->pincode : "" ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Profile</th>
                                        <td>
                                            <?php if (isset($row->image)) {
                                            ?>
                                            <img src="{{ url('') }}/uploads/{{ $row->image }}" loading="lazy" width="50"
                                                height="50" style="border-radius: 100%" alt="">
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </thead>
                            </table>
                        </div>



                        <div class="table-responsive">
                            <h5 class="mb-3">Card Details</h5>
                            <?php $carddetails = $row->card_details;

                            $decodecard_details = json_decode($carddetails);
                            if(isset($decodecard_details)){
                                $rr = $decodecard_details->cardnumber;
                            }else{
                                $rr = '0000-0000-0000-0000';
                            }
                            $cardnumber = explode("-",$rr);
                            ?>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Card Number</th>
                                        <td>
                                            <?php echo $rr; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Bank Name</th>
                                        <td>
                                            <?php if(isset($decodecard_details->bank_name)){echo $decodecard_details->bank_name;} ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Bank Holder Name</th>
                                        <td>
                                            <?php if(isset($decodecard_details->bank_holder_name)){echo $decodecard_details->bank_holder_name;} ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Expiry Date</th>
                                        <td>
                                            <?php if(isset($decodecard_details->expiry_month) && $decodecard_details->expiry_year){ ?>
                                            <?php if(isset($decodecard_details->expiry_month)){echo $decodecard_details->expiry_month;} ?>/
                                            <?php if(isset($decodecard_details->expiry_year)){echo $decodecard_details->expiry_year;} ?>
                                            <?php } ?>
                                        </td>

                                    </tr>


                                    <tr>
                                        <th>Cvv</th>
                                        <td>
                                            <?php if(isset($decodecard_details->cvv)){echo $decodecard_details->cvv;} ?>
                                        </td>

                                    </tr>

                                </thead>



                            </table>


                        </div>

                        <?php if($row->role == "vendor"){ ?>
                        <div class="table-responsive">
                            <h5 class="mb-3">Business Details</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>GST Number</th>
                                        <td>
                                            {{ $row->gst_number }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Owner/Manager First Name</th>
                                        <td>
                                            {{ $row->owner_first_name }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Owner/Manager Last Name</th>
                                        <td>
                                            {{ $row->owner_last_name }}
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>Business Location Image</th>
                                        <td>
                                            <a href="{{ url('') }}/products/{{ $row->business_location_image }}">
                                                <img src="{{ url('') }}/products/{{ $row->business_location_image }}"
                                                    alt="" loading="lazy" class="br_image">
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Owner/Manager Image</th>
                                        <td>
                                            <a href="{{ url('') }}/products/{{ $row->owner_image }}">
                                                <img src="{{ url('') }}/products/{{ $row->owner_image }}" alt=""
                                                    loading="lazy" class="br_image">
                                            </a>
                                        </td>
                                    </tr>




                                </thead>
                            </table>


                        </div>
                        <?php } ?>

                        {{-- {{ $data->links('bootstrap-5-custom') }} --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>



@endsection
