@extends('front.common.layout')
@section('content')
@section('title','Renthub - Packages')

<style>
    .padding-20{
        padding: 20px;
    }
    .padding-20 button{
        border-radius: 100px;
    }

    .row{
        width:100%;
        margin:0;
    }

    .section-title {
    font-size: 22px;
    font-weight: 600;
    color: #007bff;
}

.purchased-card {
    border-radius: 12px;
    transition: transform 0.3s, box-shadow 0.3s;
    background-color: #fff;
}

.purchased-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.purchased-card .card-title {
    font-size: 18px;
    font-weight: 600;
}

.purchased-card p {
    font-size: 14px;
    margin: 6px 0;
}

.modal-header {
    border-bottom: none;
    border-radius: 8px 8px 0 0;
}

.modal-body {
    padding: 20px;
}

.btn-block {
    border-radius: 25px;
    font-size: 14px;
    padding: 6px 20px;
}

@media (max-width: 767px) {
    .purchased-card {
        margin-bottom: 20px;
    }
}

.alert-danger{
    background-color: #df454524;
    margin-bottom: 5px;
    padding: 9px !important;
    border-radius: 8px !important;
    border: 1px solid #0000001a;
}

    .package-card {
    border: 1px solid #e0e0e0;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    background-color: #fff;
    max-width: 250px;
    margin: 15px;
    text-align: center;
    display: inline-block;
}

.package-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.package-header {
        background: #0000001f;
    padding: 15px;
    color: #fff;
}

.package-title {
    font-size: 18px;
    font-weight: 600;
    margin: 0;
}

.package-body {
    padding: 15px;
}

.package-body p {
    margin: 8px 0;
    font-size: 14px;
}

.package-price {
    font-size: 16px;
    font-weight: 700;
    color: #28a745;
}

.btn-purchase {
    margin-top: 10px;
    border-radius: 25px;
    padding: 5px 20px;
    font-size: 14px;
}

</style>


<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">SELECT PACKAGES</h1>
        </div>
        <!-- End .container -->
    </div>
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Packages
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="container mt-5 mb-5" style="display: flex; justify-content: center; align-items: center">
        <!-- category -->

        <div class="row">
            <div class="col-12 col-sm-12">
                <div style="height: auto; ">
                    <div style="">
                        <h5 class="p-4 text-center">SELECT PACKAGES</h5>
                    </div>
                    {{-- <div class="cta bg-image pt-6 pb-7 mb-5" style="
                background-image: url({{ url('website') }}/assets/images/backgrounds/cta/bg-5.jpg);
                background-position: center right;
              ">
                        <div class="row justify-content-center">
                            <div class="col-sm-10 col-md-8 col-lg-6">
                                <div class="cta-text text-center">
                                    <img src="{{ url('website') }}/assets/images/logo.png" alt="logo" />
                                    <!-- End .cta-title -->
                                    <p class="cta-desc">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing
                                        elit. Molestiae tempore, eligendi labore natus vitae
                                        itaque debitis expedita totam laudantium recusandae?
                                    </p>
                                    <!-- End .cta-desc -->
                                </div>
                                <!-- End .cta-text -->
                            </div>
                            <!-- End .col-sm-10 col-md-8 col-lg-6 -->
                        </div>
                        <!-- End .row -->
                    </div> --}}

                    <div class="row">
                        <div class="col-12">

                            @php
    use App\Models\Purchasedplans;
    $plan = Purchasedplans::where('user_id', Auth::id())->latest()->first();
@endphp

@if($plan)
    @php
        $remainingPosts = $plan->post_quantity - $plan->used_posts;
        $remainingDays = now()->diffInDays($plan->end_date, false);
    @endphp

    <div class="card shadow-sm mb-4 border-0" style="background: #f8fafc;">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <h5 class="mb-0 font-weight-bold text-primary">Your Current Package</h5>
                {{-- <span class="badge badge-success p-2">Active</span> --}}
            </div>
            <hr>

            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <h6 class="text-muted mb-1">Remaining Posts</h6>
                    <h4 class="font-weight-bold text-dark">{{ $remainingPosts }}</h4>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-muted mb-1">Package Validity</h6>
                    <h5 class="font-weight-bold text-dark">{{ $remainingDays > 0 ? $remainingDays . ' Days Left' : 'Expired' }}</h5>
                </div>
                <div class="col-md-4 mb-3">
                    <h6 class="text-muted mb-1">Expiry Date</h6>
                    <h5 class="font-weight-bold text-dark">{{ \Carbon\Carbon::parse($plan->end_date)->format('d M, Y') }}</h5>
                </div>
            </div>

            {{-- <div class="text-center mt-3">
                <a href="{{ url('/packages') }}" class="btn btn-primary px-4">
                    <i class="fa fa-arrow-up"></i> Upgrade Now
                </a>
            </div> --}}
        </div>
    </div>
@else
    <div class="alert alert-warning text-center" role="alert">
        <strong>⚠️ No Active Package:</strong> You don’t have any active package. 
        {{-- <a href="{{ url('/packages') }}" class="btn btn-sm btn-warning ml-2">Buy Now</a> --}}
    </div>
@endif



  @if($purchased->count())
    <h4 class="mb-4 section-title text-white">Your Purchased Packages</h4>
    <div class="row">
        @foreach($purchased as $item)
            @php
                $package = DB::table('packages')->where('id', $item->package_id)->first();
                $remainingDays = \Carbon\Carbon::now()->diffInDays(\Carbon\Carbon::parse($item->end_date), false);
                $remainingValue = round(($item->amount_paid / 365) * max($remainingDays,0),2);
            @endphp
            <div class="col-md-4 mb-4">
                <div class="card purchased-card h-100 shadow-sm border-primary">
                    <div class="card-body text-center">
                        <h5 class="card-title font-weight-bold">{{ $package->title ?? "" }}</h5>
                        <p class="mb-1"><b>{{ $item->post_quantity }} Posts</b></p>
                        <p class="mb-1 text-muted">Remaining Days: {{ $remainingDays }}</p>
                        
                        <div class="d-flex justify-content-center gap-2 mt-3 flex-column">
                            {{-- Renew Button --}}
                            @if($remainingDays <= 21 && $remainingDays > 0)
                                <form method="post" action="{{ route('package.renew', $item->id) }}">
                                    @csrf
                                    <button class="btn btn-warning btn-sm btn-block">Renew</button>
                                </form>
                            @endif

                            {{-- Upgrade Button --}}
                            <button class="btn btn-success btn-sm btn-block" data-toggle="modal" data-target="#upgradeModal{{ $item->id }}">
                                Upgrade
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Modal for Upgrade --}}
           <div class="modal fade" id="upgradeModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="upgradeModalLabel{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title text-white">Upgrade Package - {{ $package->title ?? "" }}</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('package.upgrade', $item->id) }}" id="upgradeForm{{ $item->id }}">
                    @csrf
                    <div class="form-group">
                        <label>Select Package to Upgrade</label>
                        <select name="package_id" class="form-control upgrade-select" data-id="{{ $item->id }}" data-current-post="{{ $package->post_quantity }}">
                            <option value="">-- Select Package --</option>
                            @foreach($packages as $p)
                                @if($p->id != $package->id)
                                    <option value="{{ $p->id }}" 
                                            data-price="{{ $p->purchase_price }}" 
                                            data-post="{{ $p->post_quantity }}">
                                        {{ $p->name ?? "" }} - ₹ {{ $p->purchase_price ?? "" }} - {{ $p->post_quantity ?? "" }} Posts
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- Error message area --}}
                    <div id="error-msg-{{ $item->id }}" class="alert alert-danger py-2 px-3 d-none" role="alert" style="font-size:14px;">
                        ⚠️ You cannot downgrade your package. Please select a higher plan.
                    </div>

                    <p class="mt-2 mb-1">Remaining Value: ₹ <span id="modal-remaining-{{ $item->id }}">{{ $remainingValue }}</span></p>
                    <p class="mb-3">Payable Amount: ₹ <span id="payable-{{ $item->id }}">0</span></p>

                    <button class="btn btn-success btn-block mt-2 upgrade-submit" type="submit">Confirm Upgrade</button>
                </form>
            </div>
        </div>
    </div>
</div>


        @endforeach
    </div>
@endif



    
        </div>

        {{-- Available Packages --}}
     
       <div class="row">
    <div class="col-12">
        <h4 class="mt-2 mb-2">Available Packages</h4>
    </div>

    @php
        // Current user ka latest purchased plan
        $activePlan = $purchased->first();
        $activePackage = null;
        if($activePlan){
            $activePackage = DB::table('packages')->where('id', $activePlan->package_id)->first();
        }
    @endphp

    @foreach($packages as $value)
        @php
            $isCurrent = $activePackage && $activePackage->id == $value->id;
            $isDowngrade = $activePackage && $value->post_quantity < $activePackage->post_quantity;
            $isUpgrade = $activePackage && $value->post_quantity > $activePackage->post_quantity;
        @endphp

        <div class="col-md-3 mb-3">
            <form method="post" action="/buypackage">
                @csrf
                <input type="hidden" name="package_id" value="{{ $value->id }}">
                <div class="card border-info shadow-sm text-center">
                    <div class="package-card">
                        <div class="package-header">
                            <h5 class="package-title">{{ $value->name }}</h5>
                        </div>
                        <div class="package-body">
                            <p><b>{{ $value->post_quantity }} Posts</b></p>
                            <p><b>{{ $value->name }} Posts</b></p>
                            <p class="package-price">₹ {{ $value->purchase_price }}</p>

                            {{-- Logic Section (UI same, sirf button logic alag) --}}
                            @if(!$activePackage)
                                {{-- No package purchased yet --}}
                                <button class="btn btn-primary btn-sm btn-purchase">Purchase</button>

                            @elseif($isCurrent)
                                {{-- Current plan --}}
                                <button class="btn btn-secondary btn-sm btn-purchase" disabled>Current Plan</button>

                            @elseif($isDowngrade)
                                {{-- Downgrade not allowed --}}
                                <button class="btn btn-outline-danger btn-sm btn-purchase" disabled title="Downgrade not allowed">
                                    Downgrade Not Allowed
                                </button>

                            @elseif($isUpgrade)
                                {{-- Upgrade allowed --}}
                                <button type="button" class="btn btn-success btn-sm btn-purchase" data-toggle="modal" data-target="#upgradeModal{{ $activePlan->id }}">
                                    Upgrade
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
</div>

<script>
$(function () {
  $('[title]').tooltip();
});
</script>

                        {{-- <div class="col-12 col-sm-12">
                            <div class="row">
                                <?php foreach ($packages as $key => $value) { ?>
                                <div class="col-xl-3col col-lg-4 mb-2">
                                    <form method="post" action="/buypackage">
                                        <input type="number" value="{{ $value->id }}" name="package_id" hidden>
                                        @csrf
                                        <div class="" style="border: 1px dotted #000">
                                            <div class=" py-2 text-center">
                                                <p><b>{{ $value->post_quantity }} Post</b></p>
                                            </div>
                                            <div style="border-bottom: 1px solid #000" class=""></div>
                                            <div class="text-right">
                                                <span class="badge badge-warning">-
                                                    <?php    $percentageDifference = (($value->price - $value->purchase_price) / $value->purchase_price) * 100;
                                                echo round($percentageDifference, 0) . '%';
                                                ?>
                                                </span>
                                            </div>
                                            <div class="p-4">
                                                <div class="d-flex justify-content-between">
                                                    <p class="text-primary font-weight-bold">₹ {{ $value->purchase_price
                                                        }}
                                                    </p>
                                                    <del class="text-muted font-weight-bold">₹ {{ $value->price }}</del>
                                                </div>

                                                <div class="purchase_button text-center mt-2">
                                                    <button class="btn btn-primary">Purchase</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <?php } ?>

                            </div>
                        </div> --}}




                        {{-- <div class="col-12 col-sm-4">
                            <div style="border: 1px dotted #000" class="p-3">
                                <h6>Include some details</h6>
                                <hr />
                                <div class="text-right">
                                    <h6>
                                        <span class="text-primary">3</span> items Selected
                                    </h6>
                                </div>
                                <div class="text-right">
                                    <h6>Total</h6>
                                </div>
                                <hr />
                                <div class="text-right">
                                    <h6 class="text-primary font-weight-bold">₹ 5,999</h6>
                                </div>
                                <a href="cart.html">
                                    <button type="submit" class="btn btn-outline-primary-2">
                                        <span>VIEW CART</span>
                                        <i class="icon-long-arrow-right"></i>
                                    </button>
                                </a>
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <div class="cta bg-image pt-6 pb-7 mb-5" style="
                    background-image: url({{ url('website') }}/assets/images/backgrounds/error-bg.jpg);
                    background-position: center right;
                  ">
                                <div class="row justify-content-center">
                                    <div class="col-sm-10 col-md-8 col-lg-6">
                                        <div class="cta-text text-center">
                                            <h4>Need help?</h4>
                                            <!-- End .cta-title -->
                                            <p class="cta-desc" style="color: #000; font-weight: bold">
                                                Call us on - +91 9999999999
                                            </p>
                                            <p class="cta-desc" style="color: #000; font-weight: bold">
                                                Email on - support@Aashapura.in
                                            </p>
                                            <!-- End .cta-desc -->
                                        </div>
                                        <!-- End .cta-text -->
                                    </div>
                                    <!-- End .col-sm-10 col-md-8 col-lg-6 -->
                                </div>
                                <!-- End .row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End .error-content text-center -->
</main>

@section('footer')

<script>
$(document).ready(function(){
    $('.upgrade-select').on('change', function(){
        var selectedOption = $(this).find(':selected');
        var id = $(this).data('id');
        var currentPost = parseInt($(this).data('current-post'));
        var newPost = parseInt(selectedOption.data('post'));
        var packagePrice = parseFloat(selectedOption.data('price')) || 0;
        var remainingValue = parseFloat($('#modal-remaining-'+id).text()) || 0;

        var errorMsg = $('#error-msg-'+id);
        var payableEl = $('#payable-'+id);
        var submitBtn = $('#upgradeForm'+id).find('.upgrade-submit');

        // Downgrade check
        if(newPost < currentPost){
            errorMsg.removeClass('d-none');
            payableEl.text('0.00');
            submitBtn.prop('disabled', true).addClass('disabled');
        } else {
            errorMsg.addClass('d-none');
            submitBtn.prop('disabled', false).removeClass('disabled');
            var payable = packagePrice - remainingValue;
            if(payable < 0) payable = 0;
            payableEl.text(payable.toFixed(2));
        }
    });

    // Trigger change to initialize
    $('.upgrade-select').trigger('change');
});
</script>

@endsection

@endsection
