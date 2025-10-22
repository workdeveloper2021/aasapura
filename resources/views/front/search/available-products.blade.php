@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Products')


<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Bulk Searching Cycles</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Categories
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row">

                            @foreach($products as $value)
                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                @include('front.partials.bulksearch', ['item' => $value,'checkin' => Request('check_in'), 'checkout' => Request('check_out')])
                            </div>
                            @endforeach
                            <div class="col-12">
                                {{-- <div class="d-flex justify-content-center w-100">
                                    {{ $products->links('bootstrap-5-custom') }}
                                </div> --}}
                            </div>
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .products -->


                </div>
                <!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    
            </aside>
        </div>
    </div>
    </div>
</main>
<!-- End .main -->

@section('footer')

<script src="{{ url('website') }}/assets/js/nouislider.min.js"></script>
<script src="{{ url('website') }}/assets/js/wNumb.js"></script>

@endsection
@endsection