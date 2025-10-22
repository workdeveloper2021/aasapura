@section('title','Dashboard - Add Faq')
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
                                <a href="javascript:void(0)">Add Faq</a>
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
                        <h5>Add Faq</h5>
                    </div>
                    <div class="card-body">
                        <form method="post" enctype="multipart/form-data" action="{{ route('faq.store') }}">
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
                                        <label class="floating-label" for="categoryname">Title</label>
                                        <input type="text" name="title" class="form-control" id="categoryname"
                                            aria-describedby="categorynameHelp">
                                    </div>
                                </div>

                                  <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="description">Description</label>
                                        <textarea class="form-control" name="description" row="10"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="floating-label" for="description">Select Type</label>
                                        <select name="type" class="form-control" id="">
                                        <option value="shipping_information">Shipping Information</option>
                                        <option value="order_returns">Oreder & Returns</option>
                                        <option value="payments">Payments</option>
                                        </select>
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
    </div>
</section>
@endsection
