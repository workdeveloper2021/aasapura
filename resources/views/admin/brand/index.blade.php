@section('title','Dashboard - Brands')
@extends('admin.layout.layout')
@section('content')

<style>
    .categoryimage {
        width: 100px;
        height: 60px;
        border-radius: 7px;
        object-fit: contain;
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
                            <h5 class="m-b-10">Brand List</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Brands</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{-- <h5>Data List</h5>
                        <span class="d-block m-t-5 small text-secondary">Now can see all categories in the list</span>
                        --}}
                        <a href="/admin/brands/create" class="btn  btn-primary mt-3">Add Brands</a>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data as $key => $value) { ?>
                                    <tr>

                                        <?php
                                        if (isset($value->image)) {
                                            $image = $value->image;
                                        } else {
                                            $image = 'no_image';
                                        } ?>


                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            <img alt="Category Image" src="{{ url('') }}/uploads/{{ $value->image }}"
                                                class="categoryimage">
                                        </td>
                                        <td>
                                            <?php if ($value->status == "Y") { ?>
                                            <a href="{{ route('change.status', ['table' => 'brands', 'id' => $value->id]) }}"
                                                class="btn btn-success btn-sm">Active</a>
                                            <?php }else{ ?>
                                            <a href="{{ route('change.status', ['table' => 'brands', 'id' => $value->id]) }}"
                                                class="btn btn-danger btn-sm">Inactive</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a href="{{ route('deleterow', ['table' => 'brands', 'id' => $value->id, 'image' => $image]) }}"
                                                onclick="return confirm('Are you sure !')"
                                                class="btn btn-danger btn-sm px-3 py-2">
                                                <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
                                                    </path>
                                                </svg></a>

                                            <a href="{{ route('brands.edit', $value->id) }}"
                                                class="btn btn-success btn-sm px-3 py-2">
                                                <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M15.7279 9.57627L14.3137 8.16206L5 17.4758V18.89H6.41421L15.7279 9.57627ZM17.1421 8.16206L18.5563 6.74785L17.1421 5.33363L15.7279 6.74785L17.1421 8.16206ZM7.24264 20.89H3V16.6473L16.435 3.21231C16.8256 2.82179 17.4587 2.82179 17.8492 3.21231L20.6777 6.04074C21.0682 6.43126 21.0682 7.06443 20.6777 7.45495L7.24264 20.89Z">
                                                    </path>
                                                </svg></a>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                            </table>

                            {{-- {{ $categories->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>



@endsection
