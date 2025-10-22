@section('title','Dashboard - About Us')
@extends('admin.layout.layout')
@section('content')
<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">Advanced Setting</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Advanced Setting</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="/admin/update-servicetime">
                            @csrf
                            <div class="row ">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Service Duration ( in days )</label>
                                        <input type="text" name="time" value="<?= $data->service_time ?>" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('time')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                              <div class="col-sm-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Product Offer Setting (Set percentage here.)</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $offerrow = json_decode($offer->info_first);
                          
                            $offer_7 = $offerrow->offer_7 ?? ''; // Added to retrieve offer_7
                            $offer_15 = $offerrow->offer_15 ?? ''; // Added to retrieve offer_15
                            $offer_30 = $offerrow->offer_30 ?? ''; // Added to retrieve offer_30
                        @endphp
                        <form method="post" enctype="multipart/form-data" action="/admin/update-offersetting">
                            @csrf
                            <div class="row ">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_7">Check-in and check-out within 0-7 days</label>
                                        <input type="text" name="offer_7" value="<?= $offer_7 ?>" class="form-control" id="offer_7"
                                            aria-describedby="offer_7Help">
                                            @error('offer_7')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_15">Check-in and check-out within 7-15 days</label>
                                        <input type="text" name="offer_15" value="<?= $offer_15 ?>" class="form-control" id="offer_15"
                                            aria-describedby="offer_15Help">
                                            @error('offer_15')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_30">Check-in and check-out within 15-30 days & above</label>
                                        <input type="text" name="offer_30" value="<?= $offer_30 ?>" class="form-control" id="offer_30"
                                            aria-describedby="offer_30Help">
                                            @error('offer_30')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                              <div class="col-sm-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

@endsection
