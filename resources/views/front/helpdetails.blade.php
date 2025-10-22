@extends('front.common.layout')
@section('content')
@section('title','Aashapura - Help')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('') }}/website/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">
                Celebrate Independence Day with Aashapura
            </h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Celebrate Independence Day with Aashapura
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->

    <div class="container">
        <div class="row mb-4">
            <div class="col-lg-8 col-12 offset-0 offset-lg-2" style="border: 1px dotted #000; padding: 30px">
                <h2 class="title"><?=$helpieds->name ?></h2>
                <!-- End .title -->
                <p style="text-align: justify">
                   <?=$helpieds->description?>
                </p>
                <!-- End .title -->
                <p style="text-align: justify">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Exercitationem incidunt molestias obcaecati nisi magni facere
                    maxime. Dicta quod culpa deleniti obcaecati iusto laborum ipsam,
                    excepturi inventore ex? Dolorum cum porro dolor necessitatibus
                    corrupti aliquid, impedit quae officia nam itaque ea libero,
                    excepturi, tempora eius repudiandae quas tempore ipsa error
                    laborum rerum quod delectus. Dolore ratione deleniti iure
                    repudiandae iusto in necessitatibus tempora harum, facere ipsam
                    quidem architecto deserunt error voluptates expedita. Tempore
                    iusto neque nisi veniam id nobis in laborum vel qui animi iure
                    cumque enim commodi quibusdam beatae, placeat distinctio
                    perspiciatis doloremque at quos. Voluptatum consequatur quo
                    optio quod.
                </p>
                <!-- End .title -->
                <p style="text-align: justify">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Exercitationem incidunt molestias obcaecati nisi magni facere
                    maxime. Dicta quod culpa deleniti obcaecati iusto laborum ipsam,
                    excepturi inventore ex? Dolorum cum porro dolor necessitatibus
                    corrupti aliquid, impedit quae officia nam itaque ea libero,
                    excepturi, tempora eius repudiandae quas tempore ipsa error
                    laborum rerum quod delectus. Dolore ratione deleniti iure
                    repudiandae iusto in necessitatibus tempora harum, facere ipsam
                    quidem architecto deserunt error voluptates expedita. Tempore
                    iusto neque nisi veniam id nobis in laborum vel qui animi iure
                    cumque enim commodi quibusdam beatae, placeat distinctio
                    perspiciatis doloremque at quos. Voluptatum consequatur quo
                    optio quod.
                </p>
            </div>
        </div>
    </div>
</main>
@endsection
