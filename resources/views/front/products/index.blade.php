@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Products')


<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Cycle Categories</h1>
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
                <div class="col-lg-9">
                    <div class="toolbox">
                        {{-- <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>9 of 56</span> Products
                            </div>
                            <!-- End .toolbox-info -->
                        </div> --}}
                        <!-- End .toolbox-left -->

              

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control">
                                        <option value="popularity" selected="selected">
                                            Most Popular
                                        </option>
                                        <option value="rating">Most Rated</option>
                                        <option value="date">Date</option>
                                    </select>
                                </div>
                            </div>
                            <!-- End .toolbox-sort -->
                            {{-- <div class="toolbox-layout">
                                <a href="category-list.html" class="btn-layout">
                                    <svg width="16" height="10">
                                        <rect x="0" y="0" width="4" height="4" />
                                        <rect x="6" y="0" width="10" height="4" />
                                        <rect x="0" y="6" width="4" height="4" />
                                        <rect x="6" y="6" width="10" height="4" />
                                    </svg>
                                </a>

                                <a href="category.html" class="btn-layout active">
                                    <svg width="16" height="10">
                                        <rect x="0" y="0" width="4" height="4" />
                                        <rect x="6" y="0" width="4" height="4" />
                                        <rect x="12" y="0" width="4" height="4" />
                                        <rect x="0" y="6" width="4" height="4" />
                                        <rect x="6" y="6" width="4" height="4" />
                                        <rect x="12" y="6" width="4" height="4" />
                                    </svg>
                                </a>
                            </div> --}}
                            <!-- End .toolbox-layout -->
                        </div>
                        <!-- End .toolbox-right -->
                    </div>
                    <!-- End .toolbox -->

                    <div class="products mb-3">
                        <div class="row">

                            @foreach($products as $value)
                            <div class="col-6 col-md-4 col-lg-4 col-xl-4col">
                                @include('front.partials.product-new', ['item' => $value,'checkin' => $checkin, 'checkout' => $checkout])
                            </div>
                            @endforeach
                            <div class="col-12">
                                <div class="d-flex justify-content-center w-100">
                                    {{ $products->links('bootstrap-5-custom') }}
                                </div>
                            </div>
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .products -->


                </div>
                <!-- End .col-lg-9 -->
                <aside class="col-lg-3 order-lg-first">
                    <form method="post">
                        @csrf
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="#" class="sidebar-filter-clear">Clean All</a>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true"
                                        aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">

                                            <?php foreach ($categories as $key => $value) { ?>
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input"
                                                        name="categories[]" id="cat<?=$value->id?>"
                                                        value="{{ $value->id }}" />
                                                    <label class="custom-control-label" for="cat<?=$value->id?>">{{
                                                        $value->name
                                                        }}</label>
                                                </div>
                                                <span class="item-count">
                                                    <?= countproductbycategories($value->id) ?>
                                                </span>
                                            </div>
                                            <?php } ?>


                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true"
                                        aria-controls="widget-2">
                                        Size
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" value="10" name="size[]"
                                                        class="custom-control-input" id="size-1" />
                                                    <label class="custom-control-label" value="10" for="size-1">10
                                                        inch</label>
                                                </div>
                                            </div>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="size[]" value="15"
                                                        class="custom-control-input" id="size-2" />
                                                    <label class="custom-control-label" for="size-2">15
                                                        inch</label>
                                                </div>
                                            </div>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="size[]" class="custom-control-input"
                                                        id="size-3" value="20" />
                                                    <label class="custom-control-label" for="size-3">20
                                                        inch</label>
                                                </div>
                                            </div>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="size[]" class="custom-control-input"
                                                        value="30" id="size-4" />
                                                    <label class="custom-control-label" for="size-4">24
                                                        inch</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End .widget -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true"
                                        aria-controls="widget-4">
                                        Locations
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">


                                            <?php foreach ($State as $key => $value) {
                                             ?>

                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="state[]" value="{{ $value->id }}"
                                                        class="custom-control-input" id="loc<?= $value->id ?>" />
                                                    <label class="custom-control-label" for="loc<?= $value->id ?>">{{
                                                        $value->name }}</label>
                                                </div>
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End .widget -->
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true"
                                        aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3>
                                <!-- End .widget-title -->

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            <?php foreach ($brand as $key => $value) {

                                             ?>
                                            <div class="filter-item">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="brand[]" class="custom-control-input"
                                                        id="brand<?= $value->id ?>" />
                                                    <label class="custom-control-label" for="brand<?= $value->id ?>">{{
                                                        $value->name
                                                        }}</label>
                                                </div>
                                            </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- <div class="widget widget-collapsible">
                            <h3 class="widget-title">
                                <a data-toggle="collapse" href="#widget-5" role="button" aria-expanded="true"
                                    aria-controls="widget-5">
                                    Price
                                </a>
                            </h3>

                            <div class="collapse show" id="widget-5">
                                <div class="widget-body">
                                    <div class="filter-price">
                                        <div class="filter-price-text">
                                            Price Range:
                                            <span id="filter-price-range"></span>
                                        </div>

                                        <div id="price-slider"></div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}


                        <button type="submit" class="btn btn-primary d-block w-100">Search</button>
            </div>
            </form>
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