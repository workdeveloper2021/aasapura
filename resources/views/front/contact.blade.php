@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Contact Us')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('') }}/website/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Contact Us</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Contact US
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <!-- End .breadcrumb-nav -->

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    <h2 class="title mb-1">Contact Information</h2>

                    <p class="mb-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Provident maiores animi neque ipsum sunt eius quos illo
                        inventore quas. Eius!
                    </p>
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3>The Office</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-map-marker"></i>
                                       <?= site_address() ?>
                                    </li>
                                    <li>
                                        <i class="icon-phone"></i>
                                        <a href="tel:<?= site_phone() ?>">+91 <?= site_phone() ?></a>
                                    </li>
                                    <li>
                                        <i class="icon-envelope"></i>
                                        <a href="mailto:<?= site_email() ?>"><?= site_email() ?></a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3>The Office</h3>

                                <ul class="contact-list">
                                    <li>
                                        <i class="icon-clock-o"></i>
                                        <span class="text-dark">Monday-Saturday</span>
                                        <br />11am-7pm ET
                                    </li>
                                    <li>
                                        <i class="icon-calendar"></i>
                                        <span class="text-dark">Sunday</span> <br />11am-6pm
                                        ET
                                    </li>
                                </ul>
                                <!-- End .contact-list -->
                            </div>
                            <!-- End .contact-info -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <h2 class="title mb-1">Got Any Questions?</h2>
                    <!-- End .title mb-2 -->
                    <p class="mb-2">
                        Use the form below to get in touch with the sales team
                    </p>

                    <form method="post" class="contact-form mb-3">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" name="name" class="form-control" id="cname" placeholder="Name *" />
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror

                            </div>
                            <!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" name="email" class="form-control" id="cemail"
                                    placeholder="Email *" />
                                @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End .col-sm-6 -->
                        </div>
                        <!-- End .row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="number" name="phone" class="form-control" id="cphone"
                                    placeholder="Phone" />
                                @error('phone')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End .col-sm-6 -->

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" name="subject" class="form-control" id="csubject"
                                    placeholder="Subject" />
                                @error('subject')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- End .col-sm-6 -->
                        </div>
                        <!-- End .row -->

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" name="message" id="cmessage"
                            placeholder="Message *"></textarea>
                        @error('message')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <button type="submit" id="submittingbutton" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>SUBMIT</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form>
                    <!-- End .contact-form -->
                </div>
            </div>
        </div>
    </div>
</main>
<!-- End .main -->


@endsection
