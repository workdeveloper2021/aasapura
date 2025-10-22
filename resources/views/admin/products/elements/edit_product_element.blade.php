@section('title','Dashboard - Add State')
@extends('admin.layout.layout')
@section('content')


@php
      $type = request()->get('type');
      $title = ucfirst(str_replace('_', ' ', $type));
@endphp


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
                                <a href="javascript:void(0)">Edit {{ $title ?? "" }}</a>
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
                        <div class="d-flex justify-content-start align-items-center">
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary mr-3">
                                        <i class="feather icon-arrow-left"></i> Back
                                    </a>
                                    <h5>Edit {{ $title ?? "" }}</h5>
                                </div>
                        
                    </div>
                    <div class="card-body">
                        <form method="post"  method="post"
                            enctype="multipart/form-data">
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
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">Element Name : {{ $title ?? "" }}</label>
                                        <input type="text" name="element_name" class="form-control" value="{{ $element->element_name ?? "" }}" id="categoryname" placeholder="{{ $title ?? "" }}"
eholder="{{ $title ?? "" }} Name"
                                            aria-describedby="categorynameHelp">

                                    </div>
                                </div>

                                  <input type="text" name="element_type" class="form-control" id="element_type"
                                            aria-describedby="element_typeHelp" value="{{ $type }}" hidden>

                                    @if($type == 'color')


                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="floating-label" for="categoryname">{{ $title ? $title .' Code' : '' }}</label>
                                        <input type="text" name="element_color" value="{{ $element->options ?? "" }}" class="form-control" id="categoryname" placeholder="{{ $title.' Code' ?? "" }}"
                                            aria-describedby="categorynameHelp">

                                    </div>
                                </div>
                                    @endif


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


@endsection
