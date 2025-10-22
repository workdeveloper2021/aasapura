
<?php

    $metatitle = $data->meta_title ? $data->meta_title : 'About Us - Aashapura';
    $metatags = $data->meta_tag ? $data->meta_tag : 'not found';
    $desc = $data->meta_description ? $data->meta_description : 'not found';
?>

@section('title', $metatitle)
@section('metatags', $metatags)
@section('desc', $desc)


@extends('front.common.layout')
@section('content')

<style>
    /* About Us Section */
.about-section {
    background: #f9fafb;
    padding: 30px 20px;
    margin-bottom: 50px;
}

.about-container {
  max-width: 900px;
  margin: 0 auto;
  background: #fff;
  border-radius: 20px;
  padding: 40px;
  box-shadow: 0 8px 20px rgba(0,0,0,0.08);
  line-height: 1.8;
}

.about-title {
  font-size: 2.4rem;
  text-align: center;
  color: #333;
  margin-bottom: 25px;
  font-weight: 700;
  position: relative;
}

.about-title::after {
  content: "";
  display: block;
  width: 60px;
  height: 4px;
  background: #00b894;      /* highlight color */
  margin: 12px auto 0;
  border-radius: 2px;
}

.about-intro {
  font-size: 1.1rem;
  color: #555;
  margin-bottom: 20px;
}

.about-container p {
  color: #444;
  margin-bottom: 18px;
  font-size: 1.5rem;
}

/* Responsive */
@media (max-width: 768px) {
  .about-container {
    padding: 25px;
  }
  .about-title {
    font-size: 2rem;
  }
}

</style>

<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">About Us</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    About Us
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <?php


    $decode = json_decode($data->info_first,true);

    ?>


<section class="about-section">
  <div class="about-container">
    <h2 class="about-title">About Us</h2>

    <p class="about-intro">
      The idea of “Your Rent Hub” had been germinating in the mind for a long time,
      and finally, it was ready to be released to the world.
      <strong>ECOHABITAT TECH SOLUTIONS Private Limited</strong> waters the idea
      and want it to grow into a giant tree.
    </p>

    <p>
      “Your Rent Hub” is a platform where individuals can transform their liability
      into an asset. Whether a new individual in the city, new to cycling, want to
      explore various types of bicycles or one who doesn’t want to buy and hold a
      liability, “Your Rent Hub” is the place where your needs will be fulfilled.
    </p>

    <p>
      This approach gives users an option to try first and then decide on purchasing
      new, solves last mile connectivity problems and helps the environment by
      keeping the clutter clean. Unused bicycles, which are gathering dust in the
      basement, “Your Rent Hub” ensures that those bicycles can be brought to life
      and maintained. Promoting riding bicycle is always the thought behind it.
    </p>

    <p>
      While bicycles are just the beginning, “Your Rent Hub” plans to expand
      horizons on different categories like kids toys, tricycles, prams,
      gym equipment like treadmill, stationary bike, rowing machine,
      leg extension machine, furniture, television, washing machine and
      any other household items that are not in use.
    </p>
  </div>
</section>


    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <?php if(isset($decode['our_vision']) && !empty($decode['our_vision'])){ ?>
                <div class="col-lg-6 mb-3 mb-lg-0">
                    <h2 class="title">Our Vision</h2>
                    <!-- End .title -->
                    <p>
                       <?= $decode['our_vision'] ?>
                    </p>
                </div>
                <?php } ?>
                <!-- End .col-lg-6 -->

                <div class="col-lg-6">
                    <h2 class="title">Our Mission</h2>
                    <!-- End .title -->
                    <p>
                        <?= $decode['our_mission'] ?>
                    </p>
                </div>
                <!-- End .col-lg-6 -->
            </div>
            <!-- End .row -->

            <div class="mb-5"></div>
            <!-- End .mb-4 -->
        </div>
        <!-- End .container -->

        <div class="bg-light-2 pt-6 pb-5 mb-6 mb-lg-8">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 mb-3 mb-lg-0">
                        <h2 class="title">Who We Are</h2>
                        <!-- End .title -->

                        <p class="mb-2">
                            <?= $decode['who_we_are'] ?>
                        </p>

                        {{-- <a href="blog.html" class="btn btn-sm btn-minwidth btn-outline-primary-2">
                            <span>VIEW OUR NEWS</span>
                            <i class="icon-long-arrow-right"></i>
                        </a> --}}
                    </div>
                    <!-- End .col-lg-5 -->

                    <div class="col-lg-6 offset-lg-1">
                        <div class="about-images">
                            <img src="{{ url('') }}/uploads/{{ $data->image }}" alt="" class="about-img-front"
                                style="width: 80%" />
                            <img src="{{ url('') }}/uploads/{{ $data->image_back }}" alt=""
                                class="about-img-back" />
                        </div>
                        <!-- End .about-images -->
                    </div>
                    <!-- End .col-lg-6 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .bg-light-2 pt-6 pb-6 -->

        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="brands-text">
                        <h2 class="title">
                            The world's premium Cycle brands in one destination.
                        </h2>
                        <!-- End .title -->
                        <p>
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                            Est beatae dicta ratione cupiditate. Molestiae nam cumque
                            placeat quia quo voluptatum blanditiis, necessitatibus
                            similique, harum consequuntur officiis ipsa, porro veritatis
                            quisquam?
                        </p>
                    </div>
                    <!-- End .brands-text -->
                </div>
                <!-- End .col-lg-5 -->
                <div class="col-lg-7">
                    <div class="brands-display">
                        <div class="row justify-content-center">
                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/1.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/2.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/3.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/4.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/5.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/6.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/7.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/8.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->

                            <div class="col-6 col-sm-4">
                                <a href="#" class="brand">
                                    <img src="{{ url('website') }}/assets/images/brands/9.png" alt="Brand Name" />
                                </a>
                            </div>
                            <!-- End .col-sm-4 -->
                        </div>
                        <!-- End .row -->
                    </div>
                    <!-- End .brands-display -->
                </div>
                <!-- End .col-lg-7 -->
            </div>
            <!-- End .row -->

            <hr class="mt-4 mb-6" />

            <h2 class="title text-center mb-4">Meet Our Team</h2>
            <!-- End .title text-center mb-2 -->

            <div class="row">
<?php foreach ($team as $key => $value) {
 ?>
                <div class="col-md-4">
                    <div class="member member-anim text-center">
                        <figure class="member-media">
                            <img src="{{ url('website') }}/assets/images/about/businessman-1aq.png"
                                alt="member photo" />

                            <figcaption class="member-overlay">
                                <div class="member-overlay-content">
                                    <h3 class="member-title">
                                        {{ $value->name }}<span>{{ $value->destination }}</span>
                                    </h3>

                                    <p>{{ $value->about_team }}</p>
                                    <div class="social-icons social-icons-simple">
                                        <a href="{{  $value->facebook  }}" class="social-icon" title="Facebook" target="_blank"><i
                                                class="icon-facebook-f"></i></a>
                                        <a href="{{  $value->twitter }}" class="social-icon" title="Twitter" target="_blank"><i
                                                class="icon-twitter"></i></a>
                                        <a href="{{  $value->instagram }}" class="social-icon" title="Instagram" target="_blank"><i
                                                class="icon-instagram"></i></a>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>

                        <div class="member-content">
                            <h3 class="member-title">Name<span>Founder & CEO</span></h3>
                        </div>
                    </div>
                </div>
<?php } ?>
            </div>
        </div>
        <!-- End .container -->

        <div class="mb-2"></div>
        <!-- End .mb-2 -->

        <div class="about-testimonials bg-light-2 pt-6 pb-6">
            <div class="container">
                <h2 class="title text-center mb-3">What Customer Say About Us</h2>
                <!-- End .title text-center -->

                <div class="owl-carousel owl-simple owl-testimonials-photo" data-toggle="owl" data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "1200": {
                                    "nav": true
                                }
                            }
                        }'>

                        <?php foreach($testimonials as $key => $Val) { ?>
                    <blockquote class="testimonial text-center">
                        <img src="{{ url('uploads') }}/{{ $Val->image }}" alt="user" loading="lazy"/>
                        <p>
                            <?= $Val->description ?>
                        </p>
                        <cite>
                            <?= $Val->name ?>
                            <span><?= $Val->destination ?></span>
                        </cite>
                    </blockquote>
                    <?php } ?>
                    <!-- End .testimonial -->


                    <!-- End .testimonial -->
                </div>
                <!-- End .testimonials-slider owl-carousel -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .bg-light-2 pt-5 pb-6 -->
    </div>
    <!-- End .page-content -->
</main>
<!-- End .main -->
@endsection
