@section('title','Dashboard - Edit Package')
@extends('admin.layout.layout')
@section('content')

<style>
    .error_text {
        color: red;
        font-size: 13px;
        font-weight: 700;
        margin-top: 5px;
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
                                <a href="javascript:void(0)">Edit Package</a>
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
                        <h5>Edit Package</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">

                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Package Name</label>
                                        <input type="text" name="name" value="{{ $package->name }}" class="form-control"
                                            id="categoryname" aria-describedby="categorynameHelp">
                                        @error('name')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror

                                    </div>

                                </div>


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Post Quantity</label>
                                        <input type="number" name="post_quantity" value="{{ $package->post_quantity }}"
                                            class="form-control" id="categoryname" aria-describedby="categorynameHelp">
                                        @error('post_quantity')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label">Price</label>
                                        <input type="number" name="price" value="{{ $package->price }}"
                                            class="form-control">
                                        @error('price')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label">Purchase Price</label>
                                        <input type="number" name="purchase_price"
                                            value="{{ $package->purchase_price }}" class="form-control">
                                        @error('price')
                                        <div class="error_text">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 px-0">
                                <div class="form-group">
                                    <button class="btn btn-primary">Submit</button>
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


@endsection
