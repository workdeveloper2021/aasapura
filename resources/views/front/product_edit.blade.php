@extends('front.common.layout')
@section('content')
@section('title','Aashapura')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Update Post</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Update Post
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->


    <style>
        .rowwowreally .row{
            width: 100% !important;
            margin: auto !important;
        }
    </style>


    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-0 offset-sm-2" style="border: 1px dotted #000; padding: 0px">
                <form  method="post" enctype="multipart/form-data">
                    @csrf

                      <div style="border: 1px solid #f2f2f2">
                        <h5 class="p-4">Generate Special Offers – Add Discount Percentages Based on Stay Duration</h5>
                    </div>

                        <div style="padding: 25px 10px;padding-bottom:0px">
                            
                    <div class="card-body">
                     <div class="row ">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_7">Check-in and check-out within 0-7 days</label>
                                        <input type="number" name="offer_7" value="{{ old('offer_7', $product->offer_7) }}" class="form-control" id="offer_7"
                                            aria-describedby="offer_7Help">
                                            @error('offer_7')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_15">Check-in and check-out within 7-15 days</label>
                                        <input type="number" name="offer_15" value="{{ old('offer_15', $product->offer_15) }}" class="form-control" id="offer_15"
                                            aria-describedby="offer_15Help">
                                            @error('offer_15')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_30">Check-in and check-out within 15-30 days & above</label>
                                        <input type="number" name="offer_30" value="{{ old('offer_30', $product->offer_30) }}" class="form-control" id="offer_30"
                                            aria-describedby="offer_30Help">
                                            @error('offer_30')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>    
                        </div>

                    <div style=" padding: 22px 25px;padding-top: 0px;">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End .error-content text-center -->
</main>
<!-- End .main -->

@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">


@endsection
@section('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

<script src="{{ url('website') }}/assets/js/img-upload.js"></script>
<script>
    function getdisrtict(e){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $.ajax({
               type:'POST',
               url:'/getdisrtict',
               data:{'id':e.value},
               success:function(data) {
                //   $("#msg").html(data.msg);
                $('#district_item').html(data);
               }
            });
    }
</script>


<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Start typing here...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                // ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['hr']]
            ],
            styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']
        });
    });

document.getElementById("speed_item").addEventListener("change", function () {
    let value = this.value;

    if (value === "1") { // Single Speed selected
        // Hide or disable fields
        document.querySelectorAll(".speed_r_item").forEach(function (el) {
            el.style.display = "none";
        });

      

    } else if (value === "2") { // Multi Speed selected
        // Show fields
        document.querySelectorAll(".speed_r_item").forEach(function (el) {
            el.style.display = "block";
        });


    } else {
        // Default or empty selection
        document.querySelectorAll(".speed_r_item").forEach(function (el) {
            el.style.display = "none";
        });
       
    }
});



</script>


@endsection

@endsection