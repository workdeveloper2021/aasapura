@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Help')

<main class="main">
    <div class="cta cta-horizontal cta-horizontal-box bg-image" style="
        background-image: url({{ url('website') }}/assets/images/backgrounds/cta/bg-1.jpg);
        background-position: center right;
      ">
        <div class="row align-items-center">
            <div class="col-lg-4 col-xl-3 offset-xl-1">
                <h3 class="cta-title">Help & Support</h3>
                <!-- End .cta-title -->
                <p class="cta-desc">Hi, HOW CAN WE HELP YOU?</p>
                <!-- End .cta-desc -->
            </div>
            <!-- End .col-xl-3 -->

            <div class="col-lg-8 col-xl-7">
                <form action="#">
                    <div class="input-group">
                        <input type="search" class="form-control" placeholder="Search The Help Center..." aria-label=""
                            required="" />
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-rounded" type="submit">
                                <span>Search</span><i class="icon-long-arrow-right"></i>
                            </button>
                        </div>
                        <!-- .End .input-group-append -->
                    </div>
                    <!-- .End .input-group -->
                </form>
            </div>
            <!-- End .col-xl-7 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">FAQ</li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="container mb-5">
        <div class="row elements">
            <?php foreach($helping as $key=> $val) { ?>
            <div class="col-xl-4col col-lg-4 col-md-3 col-6">
                <a href="help/{{$val->slug}}" class="element-type">
                    <div class="element">
                         <img src="{{url('')}}/uploads/<?=$val->image ?>" alt="">
                        <p><?=$val->short_title ?></p>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</main>
<!-- End .main -->

@endsection
