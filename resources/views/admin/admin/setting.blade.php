@section('title','Dashboard - General Setting')
@extends('admin.layout.layout')
@section('content')
<style>
    #myuploadimage {
        padding: 10px;
        display: block;
        width: 180px;
        background: #e9ecef;
        object-fit: contain;
        height: 50px;
        border-radius: 5px;
    }

    .error-validation {
        color: rebeccapurple;
        color: red;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 16px;
    }
</style>


<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            {{-- <h5 class="m-b-10">Add Category</h5> --}}
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">General Setting</a>
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
                <form method="post" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <?php

                            $general = json_decode($setting->info_first);

                            ?>
                        <div class="card-header">
                            <h5>General Setting</h5>
                        </div>
                        <div class="card-body">

                            <div class="row">



                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="phone">Phone</label>
                                        <input type="text" name="phone" class="form-control"
                                            value="<?= $general->phone ?>" id="phone" aria-describedby="phoneHelp">

                                    </div>

                                    @error('phone')
                                    <div class="error-validation">{{$message}}</div>
                                    @enderror

                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="email">Email</label>
                                        <input type="text" value="<?= $general->email ?>" name="email"
                                            class="form-control" id="email" aria-describedby="emailHelp">
                                    </div>
                                    @error('email')
                                    <div class="error-validation">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="office_location">Address</label>
                                        <input type="text" value="<?= $general->address ?>" name="address"
                                            class="form-control" id="office_location"
                                            aria-describedby="office_locationHelp">
                                    </div>
                                    @error('address')
                                    <div class="error-validation">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Favicon</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="favicon"
                                                    class="custom-file-input" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                    file</label>
                                            </div>
                                        </div>

                                    </div>
                                    @error('favicon')
                                    <div class="error-validation">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Logo</label>

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="image"
                                                    class="custom-file-input" id="inputGroupFile02">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                    file</label>
                                            </div>
                                        </div>

                                    </div>
                                    @error('image')
                                    <div class="error-validation">{{$message}}</div>
                                    @enderror
                                </div>

                              <div class="col-sm-6">
                                    <img src="{{ url('') }}/uploads/{{ $setting->favicon }}" alt=""
                                        class="image-preview-2 mb-3" id="myuploadimage" <?php
                                        if(isset($setting->favicon)){}else{ ?>style="display:
                                    none;"
                                    <?php } ?>>
                                </div>
                                
                                <div class="col-sm-6">
                                    <img src="{{ url('') }}/uploads/{{ $setting->image }}" alt=""
                                        class="image-preview mb-3" id="myuploadimage" <?php
                                        if(isset($setting->image)){}else{ ?>style="display: none;"
                                    <?php } ?>>
                                </div>
                              



                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5>Seo Setting</h5>
                        </div>
                        <div class="card-body">
                            <?php

                            $general_2 = json_decode($setting->info_second);

                            ?>

                            <div class="row align-items-end">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="site_title">Site Title</label>
                                        <input type="text" name="site_title" value="<?= $general_2->site_title ?>"
                                            class="form-control" id="site_title" aria-describedby="site_titleHelp">
                                    </div>
                                    @error('site_title')
                                    <div class="error-validation">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="meta_keyword">Meta Keyword</label>
                                        <input type="text" value="<?= $general_2->meta_keyword ?>" name="meta_keyword"
                                            class="form-control" id="meta_keyword" aria-describedby="emailHelp">
                                    </div>
                                    @error('meta_keyword')
                                    <div class="error-validation">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" id="" class="form-control" cols="30"
                                            rows="5"><?= $general_2->meta_description ?></textarea>
                                    </div>
                                    @error('meta_description')
                                    <div class="error-validation">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </div>


                </form>
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

    $('#inputGroupFile02').on('change', function() {
        $input = $(this);
        if ($input.val().length > 0) {
            fileReader = new FileReader();
            fileReader.onload = function(data) {
                $('.image-preview-2').attr('src', data.target.result);
            }
            fileReader.readAsDataURL($input.prop('files')[0]);
            $('.image-preview-2').css('display', 'block');
        }
    });


</script>


@endsection
@endsection