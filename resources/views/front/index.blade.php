<?php

$metatitle = $meta_title ? $meta_title : 'not found';
$metatags = $meta_tags ? $meta_tags : 'not found';
$desc = $meta_descraption ? $meta_descraption : 'not found';

?>

@section('title', $metatitle)
@section('metatags', $metatags)
@section('desc', $desc)

@extends('front.common.layout')
@section('content')
@section('title','Aashapura')



<main class="main">
    <div class="intro-slider-container">
        <div class="owl-carousel owl-simple owl-light owl-nav-inside" data-toggle="owl"
            data-owl-options='{"nav": false}'>
            <?php foreach ($banners as $key => $value) { ?>
                <div class="intro-slide" style="
                background-image: url('{{url('')}}/uploads/{{$value->image}}');
              ">
                </div>
            <?php } ?>
            <!-- End .intro-slide -->
        </div>
        <!-- End .owl-carousel owl-simple -->

        <span class="slider-loader text-white"></span><!-- End .slider-loader -->
    </div>
    <!-- End .intro-slider-container -->

    <div class="mb-3 mb-lg-5"></div>
    <!-- End .mb-3 mb-lg-5 -->

    <div class="container">
        <div class="heading mb-3">
            <h2 class="title text-center text-sm-left mb-2 mb-sm-0">
                Recently added cycles
            </h2>
            <!-- End .title -->

            <ul class="nav nav-pills nav-border-anim justify-content-start justify-content-sm-end" role="tablist">
                <li class="nav-item mb-2 mb-sm-0">
                    <a class="nav-link active" id="top-all-link" data-toggle="tab" href="#top-all-tab" role="tab"
                        aria-controls="top-all-tab" aria-selected="true">All</a>
                </li>
                <?php foreach ($categories_latest as $key => $c_val) { ?>
                    <li class="nav-item mb-2 mb-sm-0">
                        <a class="nav-link" id="top-fur-link" data-toggle="tab"
                            href="#<?= str_replace(' ', '', $c_val->name) . $c_val->id ?>"
                            role="<?= str_replace(' ', '', $c_val->name) . $c_val->id ?>"
                            aria-controls="<?= str_replace(' ', '', $c_val->name) . $c_val->id ?>" aria-selected="false">{{
                        $c_val->name }}</a>
                    </li>
                <?php } ?>

            </ul>
        </div>
        <!-- End .heading -->

        <div class="tab-content">
            <div class="tab-pane p-0 fade show active" id="top-all-tab" role="tabpanel" aria-labelledby="top-all-link">
                <div class="products">
                    {{-- justify-content-center --}}
                    <div class="row ">
                        @foreach($recent_product as $value)
                        @include('front.partials.product', ['item' => $value])
                        @endforeach
                    </div>
                </div>
                
            </div>
            <!-- .End .tab-pane -->
            <?php $count_llr = ""; ?>
            <?php foreach ($categories_latest as $key => $c_val) { ?>
                <div class="tab-pane p-0 fade" id="<?= str_replace(' ', '', $c_val->name) . $c_val->id ?>" role="tabpanel"
                    aria-labelledby="top-fur-link">
                    <div class="products">
                        <div class="row justify-content-center">
                            @foreach($recent_product as $value)
                            <?php if ($value->category == $c_val->id) { ?>
                                @include('front.partials.product', ['item' => $value])
                            <?php } else {
                                $count_llr = "Item Not Found"; ?>

                            <?php  } ?>
                            @endforeach
                            <!-- End .col-sm-6 col-md-4 col-lg-3 -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .products -->
                </div>
            <?php } ?>


            {{--
            <!-- .End .tab-pane -->
            <div class="tab-pane p-0 fade" id="top-decor-tab" role="tabpanel" aria-labelledby="top-decor-link">
                <div class="products">
                    <div class="row justify-content-center">
                        <div class="col-6 col-md-4 col-lg-3 col-xl-4col">
                            <div class="product product-11 text-center">
                                <figure class="product-media">
                                    <span class="product-label label-circle label-new">New</span>
                                    <a href="product.html">
                                        <img src="{{ url('website') }}/assets/images/products/14.jpg"
            alt="Product image" class="product-image" />
            <img src="{{ url('website') }}/assets/images/products/14.jpg"
                alt="Product image" class="product-image-hover" />
            </a>

            <div class="product-action-vertical">
                <a href="wishlist.html" class="btn-product-icon btn-wishlist"><span>add
                        to wishlist</span></a>
            </div>
            </figure>

            <div class="product-body text-left">
                <div class="product-price d-flex justify-content-between">
                    <h6 class="font-weight-bold">₹ 500.00</h6>
                    <h6>
                        <i class="la la-star text-warning"></i>
                        <i class="la la-star text-warning"></i>
                        <i class="la la-star text-warning"></i>
                        <i class="la la-star text-warning"></i>
                        <i class="la la-star-half text-warning"></i>
                    </h6>
                </div>

                <h3 class="product-title mb-1">
                    <a href="product.html">Hercules bicycle</a>
                </h3>

                <div class="product-cat" style="display: flex; justify-content: space-between">
                    <a href="#">Kothrud , Pune </a>
                    <a href="#">Aug 03 </a>
                </div>
            </div>

            <div class="product-action">
                <a href="product.html" class="btn-product"><span>View Details</span></a>
            </div>
        </div>
    </div>
    <!-- End .col-sm-6 col-md-4 col-lg-3 -->
    </div>
    <!-- End .row -->
    </div>
    <!-- End .products -->
    </div>
    <!-- .End .tab-pane -->
    <div class="tab-pane p-0 fade" id="top-light-tab" role="tabpanel" aria-labelledby="top-light-link">
        <div class="products">
            <div class="row justify-content-center">
                <div class="col-6 col-md-4 col-lg-3 col-xl-4col">
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <span class="product-label label-circle label-new">New</span>
                            <a href="product.html">
                                <img src="{{ url('website') }}/assets/images/products/15.jpg"
                                    alt="Product image" class="product-image" />
                                <img src="{{ url('website') }}/assets/images/products/15.jpg"
                                    alt="Product image" class="product-image-hover" />
                            </a>

                            <div class="product-action-vertical">
                                <a href="wishlist.html" class="btn-product-icon btn-wishlist"><span>add
                                        to wishlist</span></a>
                            </div>
                        </figure>

                        <div class="product-body text-left">
                            <div class="product-price d-flex justify-content-between">
                                <h6 class="font-weight-bold">₹ 500.00</h6>
                                <h6>
                                    <i class="la la-star text-warning"></i>
                                    <i class="la la-star text-warning"></i>
                                    <i class="la la-star text-warning"></i>
                                    <i class="la la-star text-warning"></i>
                                    <i class="la la-star-half text-warning"></i>
                                </h6>
                            </div>

                            <h3 class="product-title mb-1">
                                <a href="product.html">Hercules bicycle</a>
                            </h3>

                            <div class="product-cat" style="display: flex; justify-content: space-between">
                                <a href="#">Kothrud , Pune </a>
                                <a href="#">Aug 03 </a>
                            </div>
                        </div>

                        <div class="product-action">
                            <a href="product.html" class="btn-product"><span>View Details</span></a>
                        </div>
                    </div>
                </div>
                <!-- End .col-sm-6 col-md-4 col-lg-3 -->

                <div class="col-6 col-md-4 col-lg-3 col-xl-4col">
                    <div class="product product-11 text-center">
                        <figure class="product-media">
                            <span class="product-label label-circle label-new">New</span>
                            <a href="product.html">
                                <img src="{{ url('website') }}/assets/images/products/16.webp"
                                    alt="Product image" class="product-image" />
                                <img src="{{ url('website') }}/assets/images/products/16.webp"
                                    alt="Product image" class="product-image-hover" />
                            </a>

                            <div class="product-action-vertical">
                                <a href="wishlist.html" class="btn-product-icon btn-wishlist"><span>add
                                        to wishlist</span></a>
                            </div>
                        </figure>

                        <div class="product-body text-left">
                            <div class="product-price d-flex justify-content-between">
                                <h6 class="font-weight-bold">₹ 500.00</h6>
                                <h6>
                                    <i class="la la-star text-warning"></i>
                                    <i class="la la-star text-warning"></i>
                                    <i class="la la-star text-warning"></i>
                                    <i class="la la-star text-warning"></i>
                                    <i class="la la-star-half text-warning"></i>
                                </h6>
                            </div>

                            <h3 class="product-title mb-1">
                                <a href="product.html">Hercules bicycle</a>
                            </h3>

                            <div class="product-cat" style="display: flex; justify-content: space-between">
                                <a href="#">Kothrud , Pune </a>
                                <a href="#">Aug 03 </a>
                            </div>
                        </div>

                        <div class="product-action">
                            <a href="product.html" class="btn-product"><span>View Details</span></a>
                        </div>
                    </div>
                </div>
                <!-- End .col-sm-6 col-md-4 col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
    </div> --}}
    </div>
    <!-- End .tab-content -->
    <div class="dropdown text-center mt-3 mb-3">
        <a href="/rental-products" class="btn btn-outline-primary-2"><span>View More</span><i
                class="icon-long-arrow-right"></i></a>
    </div>
    </div>
    <!-- End .container -->

    <!-- testimonials start -->
    <div class="about-testimonials bg-light-2 pt-6 pb-6">
        <div class="container">
            <h2 class="title text-center mb-3">What Customer Say About Us</h2>
            <!-- End .title text-center -->

            <div class="owl-carousel owl-theme owl-testimonials owl-loaded owl-drag" data-toggle="owl" data-owl-options='{
              "nav": false,
              "dots": true,
              "margin": 20,
              "loop": true,
              "responsive": {
                  "0": {
                      "items":1
                  },
                  "768": {
                      "items":2
                  },
                  "992": {
                      "items":3
                  },
                  "1200": {
                      "items":3,
                      "nav": true
                  }
              }
          }'>
                <!-- End .testimonial -->
                <div class="owl-stage-outer">
                    <div class="owl-stage" style="
                    transform: translate3d(-2076px, 0px, 0px);
                    transition: all;
                    width: 3462px;
                  ">
                        <?php foreach ($testimonials as $key => $Val) { ?>

                            <div class="owl-item active" style="width: 326.133px; margin-right: 20px">
                                <blockquote class="testimonial text-center">
                                    <img src="{{ url('') }}/uploads/<?= $Val->image ?>" alt="img"
                                        style="width: 60px; height: 60px" />
                                    <p>
                                        <?= $Val->description ?>
                                    </p>

                                    <cite>
                                        <?= $Val->name ?>
                                        <span><?= $Val->destination ?></span>
                                    </cite>
                                </blockquote>
                            </div>

                        <?php } ?>


                    </div>
                </div>
                <div class="owl-nav disabled">
                    <button type="button" role="presentation" class="owl-prev">
                        <i class="icon-angle-left"></i></button><button type="button" role="presentation"
                        class="owl-next">
                        <i class="icon-angle-right"></i>
                    </button>
                </div>
            </div>
            <!-- End .testimonials-slider owl-carousel -->
        </div>
        <!-- End .container -->
    </div>
    <!-- testimonials end -->

    <!-- gallery start -->
    <div class="blog-posts pt-6">
        <div class="container">
            <h2 class="title text-center">Pictures of good cycles</h2>
            <!-- End .title-lg text-center -->

            <div class="grid-wrapper">
                <div>
                    <img src="https://images.unsplash.com/photo-1541845157-a6d2d100c931?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1350&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1588282322673-c31965a75c3e?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1351&amp;q=80"
                        alt="" />
                </div>
                <div class="tall">
                    <img src="https://images.unsplash.com/photo-1588117472013-59bb13edafec?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=500&amp;q=60"
                        alt="" />
                </div>
                <div class="wide">
                    <img src="https://images.unsplash.com/photo-1587588354456-ae376af71a25?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80"
                        alt="" />
                </div>
                <div>
                    <img src=" https://images.unsplash.com/photo-1558980663-3685c1d673c4?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1000&amp;q=60"
                        alt="" />
                </div>
                <div class="tall">
                    <img src="https://images.unsplash.com/photo-1588499756884-d72584d84df5?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=2134&amp;q=80"
                        alt="" />
                </div>
                <div class="big">
                    <img src="https://images.unsplash.com/photo-1588492885706-b8917f06df77?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1951&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1588247866001-68fa8c438dd7?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=564&amp;q=80"
                        alt="" />
                </div>
                <div class="wide">
                    <img src="https://images.unsplash.com/photo-1586521995568-39abaa0c2311?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1350&amp;q=80"
                        alt="" />
                </div>
                <div class="big">
                    <img src="https://images.unsplash.com/photo-1572914857229-37bf6ee8101c?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1951&amp;q=80"
                        alt="" />
                </div>
                <div class="tall">
                    <img src="https://images.unsplash.com/photo-1588453862014-cd1a9ad06a12?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=634&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1588414734732-660b07304ddb?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=675&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1588224575346-501f5880ef29?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=700&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1574798834926-b39501d8eda2?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=800&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1547234935-80c7145ec969?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1353&amp;q=80"
                        alt="" />
                </div>
                <div class="wide">
                    <img src="https://images.unsplash.com/photo-1588263823647-ce3546d42bfe?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=675&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1587732608058-5ccfedd3ea63?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1350&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1587897773780-fe72528d5081?ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1489&amp;q=80"
                        alt="" />
                </div>
                <div class="wide">
                    <img src="https://images.unsplash.com/photo-1588083949404-c4f1ed1323b3?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1489&amp;q=80"
                        alt="" />
                </div>
                <div>
                    <img src="https://images.unsplash.com/photo-1587572236558-a3751c6d42c0?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1350&amp;q=80"
                        alt="" />
                </div>
                <div class="wide">
                    <img src="https://images.unsplash.com/photo-1583542225715-473a32c9b0ef?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=crop&amp;w=1350&amp;q=80"
                        alt="" />
                </div>
            </div>
            <!-- End .owl-carousel -->

            {{-- <div class="more-container text-center mt-2">
                <a href="gallery.html" class="btn btn-outline-darker btn-more"><span>View more </span><i
                        class="icon-long-arrow-right"></i></a>
            </div> --}}
            <!-- End .more-container -->
        </div>
        <!-- End .container -->
    </div>
    <!-- gallery end -->

    <div class="blog-posts">
        <div class="container">
            <h2 class="title text-center">From Our Blog</h2>
            <!-- End .title-lg text-center -->

            <div class="owl-carousel owl-simple carousel-with-shadow" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "items": 3,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "600": {
                                    "items":2
                                },
                                "992": {
                                    "items":3
                                }
                            }
                        }'>
                <?php foreach ($blogs as $key => $value) {

                ?>
                    <article class="entry entry-display">
                        <figure class="entry-media">
                            <a href="/blog/{{ $value->slug }}">
                                <img src="{{ url('uploads') }}/{{ $value->image }}" alt="{{ $value->title }}"
                                    style="width: 100%; height: 250px; object-fit: cover" />
                            </a>
                        </figure>

                        <div class="entry-body text-center">
                            <div class="entry-meta">
                                <a href="/blog/{{ $value->slug }}">{{ $value->created_at->format('M d, Y') }}</a>
                            </div>

                            <h3 class="entry-title">
                                <a href="/blog/{{ $value->slug }}">{{ $value->title }}</a>
                            </h3>

                            <div class="entry-content">
                                <a href="/blog/{{ $value->slug }}" class="read-more">Continue Reading</a>
                            </div>
                        </div>
                    </article>
                <?php } ?>
                <!-- End .entry -->
            </div>
            <!-- End .owl-carousel -->

            <div class="more-container text-center mt-2">
                <a href="/blogs" class="btn btn-outline-darker btn-more"><span>View more articles</span><i
                        class="icon-long-arrow-right"></i></a>
            </div>
            <!-- End .more-container -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .blog-posts -->
</main>
<!-- End .main -->
@endsection