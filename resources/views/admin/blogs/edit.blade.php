@section('title','Dashboard - Blogs Edit')
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
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">Blogs</a>
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
                        <h5>Edit Blog</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('blogs.update',$row->id) }}">
                            @csrf
                            @method('put')
                            <div class="row ">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Blog Title</label>
                                        <input type="text" name="title"  class="form-control" value="{{ $row->title }}" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('title')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Short Description</label>
                                       <textarea name="short_description" id="" class="form-control" cols="30" rows="3">{{ $row->short_description }}</textarea>
                                            @error('short_description')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
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
                                        @error('image')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror

                                        <img src="{{ url('') }}/uploads/{{ $row->image }}" alt="" loading="lazy" class="image-preview mb-3 mt-3"
                                        id="myuploadimage" <?php if($row->image){}else{ ?>style="display: none;"
                                    <?php } ?>>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Editor / Writer Name</label>
                                        <input type="text" name="writer_name" value="{{ $row->writer_name }}"  class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('writer_name')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Select Category</label>
                                        <select name="category" class="form-control" id="">
                                            <?php
                                            foreach ($category as $key => $value) {
                                            ?>
                                            <option <?php if($row->category == $value->id){echo "selected"; } ?> value="{{ $value->id }}">{{ $value->name }}</option>
                                            <?php } ?>
                                        </select>
                                            @error('category')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>



                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="description">Description</label>
                                        <textarea class="form-control summernote" name="description" row="10">{{ $row->description }}</textarea>
                                        @error('description')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>







                                <div class="col-12 my-3">
                                    <h5 style="background-color: #eee;padding: 15px;">Seo Details</h5>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Meta Title</label>
                                        <input type="text" name="meta_title" value="{{ $row->meta_title }}" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('meta_title')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Meta Tag</label>
                                        <input type="text" name="meta_tag" value="{{ $row->meta_tag }}" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('meta_tag')
                                            <div class="error_text">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Meta Description</label>
                                        <textarea name="meta_description"  class="form-control" id="meta_description" rows="5">{{ $row->meta_description }}</textarea>
                                        @error('meta_description')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <button class="btn btn-primary">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('header')


<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

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
<script>
    $('#inputGroupFile02').on('change', function() {
        $input = $(this);
        if ($input.val().length > 0) {
            fileReader = new FileReader();
            fileReader.onload = function(data) {
                $('.image-preview2').attr('src', data.target.result);
            }
            fileReader.readAsDataURL($input.prop('files')[0]);
            $('.image-preview2').css('display', 'block');
        }
    });
</script>

<script src="{{ url('summernote') }}/summernote-bs4.min.js"></script>

<script>
    $('.summernote').summernote({
      placeholder: '',
      tabsize: 1,
      height: 200
    });
  </script>
@endsection
@endsection
