@section('title','Dashboard - Users')
@extends('admin.layout.layout')
@section('content')

<style>
    .categoryimage {
        width: 100px;
        height: 60px;
        border-radius: 7px;
    }
</style>

<style>
    .activity_row {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 11px !important;
        border-radius: 100%;
        /* background-color: #e74c3c; */
        /* color: #fff !important; */
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
                            <h5 class="m-b-10">Users List</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Users</a></li>
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
                        {{-- <a href="/admin/add-category" class="btn  btn-primary mt-3">Add Category</a> --}}
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table" id="example-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Active Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $key => $value) { ?>
                                    <tr>
                                        <?php
                                        if (isset($value->image)) {
                                            $image = $value->image;
                                        } else {
                                            $image = 'no_image';
                                        } ?>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            {{ $value->email }}
                                        </td>
                                        <td>
                                            {{ $value->phone }}
                                        </td>
                                        <td>
                                            <?php if($value->is_active == "Y"){ ?>
                                            <a href="/admin/changeactivestatus/vendor/{{ $value->id }}"
                                                onclick="return confirm('Are you sure ! Deactivate this account')"
                                                class="badge bg-success btn-sm text-white">Active</a>
                                            <?php }else{ ?>
                                            <a href="/admin/changeactivestatus/vendor/{{ $value->id }}"
                                                onclick="return confirm('Are you sure ! Activate this account')"
                                                class="badge bg-danger btn-sm text-white">Inactive</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <div style="display: flex;align-items: center;gap: 6px;">
                                                <a href="/admin/view-vendor-providers/{{ $value->id }}"
                                                    class="btn btn-warning btn-sm">
                                                    <svg width="20" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z">
                                                        </path>
                                                    </svg>
                                                </a>
                                                <?php if ($value->is_block == "Y") { ?>
                                                <a href="{{ route('change.block', ['table' => 'users', 'id' => $value->id]) }}"
                                                    class="btn btn-danger btn-sm text-white"><svg width="20"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path
                                                            d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM16.8911 8.52313L8.52313 16.8911C8.25459 16.6997 7.99828 16.4836 7.75736 16.2426C7.51644 16.0017 7.30029 15.7454 7.10891 15.4769L15.4769 7.10891C15.7454 7.30029 16.0017 7.51644 16.2426 7.75736C16.4836 7.99828 16.6997 8.25459 16.8911 8.52313Z">
                                                        </path>
                                                    </svg></a>
                                                <?php }else{ ?>
                                                <a href="{{ route('change.block', ['table' => 'users', 'id' => $value->id]) }}"
                                                    class="btn btn-success btn-sm text-white"><svg width="20"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path
                                                            d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM16.8911 8.52313L8.52313 16.8911C8.25459 16.6997 7.99828 16.4836 7.75736 16.2426C7.51644 16.0017 7.30029 15.7454 7.10891 15.4769L15.4769 7.10891C15.7454 7.30029 16.0017 7.51644 16.2426 7.75736C16.4836 7.99828 16.6997 8.25459 16.8911 8.52313Z">
                                                        </path>
                                                    </svg></a>
                                                <?php } ?>
                                                <a class="btn btn-danger btn-sm text-white"
                                                    href="{{ route('deleterow', ['table' => 'users', 'id' => $value->id, 'image' => $image]) }}"
                                                    onclick="return confirm('Are you sure !')">
                                                    <svg width="20" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 24 24" fill="currentColor">
                                                        <path
                                                            d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
                                                        </path>
                                                    </svg></a>
                                            </div>

                                            {{-- <a href="/admin/categories-edit/{{ $value->id }}"
                                                class="btn btn-success btn-sm px-3 py-2">
                                                <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M15.7279 9.57627L14.3137 8.16206L5 17.4758V18.89H6.41421L15.7279 9.57627ZM17.1421 8.16206L18.5563 6.74785L17.1421 5.33363L15.7279 6.74785L17.1421 8.16206ZM7.24264 20.89H3V16.6473L16.435 3.21231C16.8256 2.82179 17.4587 2.82179 17.8492 3.21231L20.6777 6.04074C21.0682 6.43126 21.0682 7.06443 20.6777 7.45495L7.24264 20.89Z">
                                                    </path>
                                                </svg></a> --}}
                                        </td>
                                    </tr>
                                    <?php } ?>

                                </tbody>
                            </table>

                        </div>
                        {{ $users->links('bootstrap-5-custom') }}

                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>


@section('header')

{{--
<link rel="stylesheet" type="text/css" href="{{ url('') }}/data_table/css/dataTables.dataTables.css?v1">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/data_table/css/buttons.dataTables.css?v1">
<link rel="stylesheet" href="{{ url('') }}/data_table/css/responsive.dataTables.css?v1"> --}}
@endsection

@section('js')

{{-- <script src="{{ url('') }}/data_table/js/dataTables.js"></script>
<script src="{{ url('') }}/data_table/js/dataTables.buttons.js"></script>
<script src="{{ url('') }}/data_table/js/buttons.dataTables.js"></script>
<script src="{{ url('') }}/data_table/js/jszip.min.js"></script>
<script src="{{ url('') }}/data_table/js/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="{{ url('') }}/data_table/js/dataTables.responsive.js"></script>
<script src="{{ url('') }}/data_table/js/responsive.dataTables.js"></script> --}}

{{-- <script>
    new DataTable('#example-table', {
    layout: {
        topStart: {
            // buttons: ['copy', 'csv', 'excel','print'],
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'Customer List'
                },
                {
                    extend: 'csvHtml5',
                    title: 'Customer List'
                },
                {
                    extend: 'print',
                    title: 'Customer List'
                }
            ]
        }
    },

    pageLength: 10,
    responsive: true,
    "ordering": false,

});
</script> --}}


@endsection


@endsection
