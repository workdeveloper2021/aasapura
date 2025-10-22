@section('title','Dashboard - Add Testimonial')
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
                            {{-- <h5 class="m-b-10">Add Help</h5> --}}
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">Add Help</a>
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
                        <h5>Add Help</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('help.store') }}">
                            @csrf
                            <div class="row align-items-end">
                                <div class="col-12">
                                    @if ($errors->any())
                                    <div class="p-0">
                                        <ul class="p-0 list-unstyled">
                                            @foreach ($errors->all() as $error)
                                            <li style="color: rebeccapurple;
    color: red;
    font-size: 13px;
    font-weight: 700;">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Short Title</label>
                                        <input type="text" name="short_title" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Title</label>
                                        <input type="text" name="title" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Image</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="image"
                                                    class="custom-file-input" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                    file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="description">Description</label>
                                        <textarea class="form-control" name="description" row="10"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <img src="" alt="" class="image-preview mb-3" id="myuploadimage"
                                        style="display: none;">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->

    </div>
</section>

@section('js')
<script>
    $('#inputGroupFile01').on('change', function() {
        $input = $(this);
        if ($input.val().length > 0) {
            fileReader = new FileReader();
            fileReader.onload = function(data) {
                $('.image-preview').attr('src', data.target.result);
            }
            fileReader.readAsDataURL($input.prop('files')[0]);
            $('.image-preview').css('display', 'block');
        }
    });
</script>

<style>
    #myuploadimage {
        padding: 10px;
        display: block;
        width: 150px;
        background: #e9ecef;
        height: 150px;
        object-fit: cover;
        border-radius: 100%;
    }
</style>
@endsection
@endsection
