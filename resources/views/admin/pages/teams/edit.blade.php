@section('title','Dashboard - Edit Team')
@extends('admin.layout.layout')
@section('content')

@section('header')


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

<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            {{-- <h5 class="m-b-10">Add Testimonial</h5> --}}
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="javascript:void(0)">Team</a>
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
                        <h5>Edit Team Member</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('teams.update',$row->id) }}">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-12">

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Name</label>
                                        <input type="text" name="name" class="form-control" value="<?= $row->name ?>" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('name')
                                            <div class="error_text">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>


                                 <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Destination</label>
                                        <input type="text" name="destination" class="form-control" value="<?= $row->destination ?>" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('destination')
                                            <div class="error_text">{{ $message }}</div>
                                            @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Image</label>

                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" name="image"
                                                    class="custom-file-input" id="inputGroupFile01">
                                                <label class="custom-file-label" for="inputGroupFile01">Choose
                                                    file</label>
                                                    @error('image')
                                                    <div class="error_text">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                    <div class="col-12">
                                        <img src="{{ url('') }}/uploads/{{ $row->image }}" alt="" loading="lazy" class="image-preview mb-3"
                                        id="myuploadimage" <?php if($row->image){}else{ ?>style="display: none;"
                                    <?php } ?>>

                                </div>

                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="description">About Team</label>
                                        <textarea class="form-control" name="about_team" row="10"><?= $row->about_team ?></textarea>
                                        @error('about_team')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <h5 class="my-2 mb-3">Team Social Media</h5>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Facebook</label>
                                        <input type="text" name="facebook" value="<?= $row->facebook ?>" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('facebook')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Instagram</label>
                                        <input type="text" name="instagram" value="<?= $row->instagram ?>" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('instagram')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Twitter</label>
                                        <input type="text" name="twitter" value="<?= $row->twitter ?>" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                            @error('twitter')
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

@endsection
@endsection
