@extends('front.common.layout')
@section('content')
@section('title','Aashapura')

<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Vendor Registeration</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Register
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <form method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="">Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                                    @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="">Email</label>
                                    <input type="text" name="email" value="{{ old('email') }}" class="form-control">
                                    @error('email')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <label for="">Phone</label>
                                    <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                    @error('phone')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="">Address 1</label>
                                    <textarea name="address_1" id="" rows="2" style="min-height: auto"
                                        class="form-control">{{ old('address_1') }}</textarea>
                                    @error('address_1')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <label for="">Address 2</label>
                                    <textarea name="address_2" id="" rows="2" style="min-height: auto"
                                        class="form-control">{{ old('address_2') }}</textarea>
                                    @error('address_2')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <p class="font-weight-bold">Business Details</p>
                                </div>

                                <div class="col-md-12">
                                    <label>GST Number</label>
                                    <input type="text" name="gst_number" value="{{ old('gst_number') }}"
                                        class="form-control">
                                    @error('gst_number')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label>Owner/Manager First Name</label>
                                    <input type="text" name="owner_first_name" value="{{ old('owner_first_name') }}"
                                        class="form-control">
                                    @error('owner_first_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label>Owner/Manager Last Name</label>
                                    <input type="text" name="owner_last_name" value="{{ old('owner_last_name') }}"
                                        class="form-control">
                                    @error('owner_last_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label>Pin Code</label>
                                    <input type="text" name="pincode" value="{{ old('pincode') }}" class="form-control">
                                    @error('pincode')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-12">
                                    <label>Photo of business location</label>
                                    <input type="file" name="business_location_image" class="form-control">
                                    @error('business_location_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label>Photo of owner/manager</label>
                                    <input type="file" name="owner_image" class="form-control">
                                    @error('owner_image')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="col-md-6">
                                    <label for="">Password</label>
                                    <input type="text" name="password" class="form-control">
                                    @error('password')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="">Password Confirmation</label>
                                    <input type="text" name="password_confirmation" class="form-control">
                                    @error('password_confirmation')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .dashboard -->
    </div>
</main>


@endsection
