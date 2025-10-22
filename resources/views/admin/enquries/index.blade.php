@section('title','Dashboard - Categories')
@extends('admin.layout.layout')
@section('content')

<style>
    .categoryimage {
        width: 100px;
        height: 60px;
        border-radius: 7px;
    }

    #view_idoc .container-fluid .d-flex.justify-content-between p {
        font-size: 15px;
        font-weight: 500;
    }

    #view_idoc .container-fluid .d-flex.justify-content-between p:first-child {
        min-width: 80px;
        font-weight: 700;
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
    }

    .modal-body .d-flex.justify-content-between,
    .mbr_goove {
        justify-content: start !important;
        gap: 10px;
        margin-bottom: 15px;
    }

    .modal-body .d-flex.justify-content-between:last-child {
        margin-bottom: 0px !important;
    }
</style>

<div id="gridSystemModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridModalLabel"
    aria-hidden="true" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gridModalLabel">View Enquiry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body bg-light" id="view_idoc">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn  btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            {{-- <h5 class="m-b-10">Enquires List</h5> --}}
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Enquires</a></li>
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
                        <h5>Enquires List</h5>
                    </div>
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table" id="example-table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($enquires as $key => $value) { ?>
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
                                            <div style="display: flex;align-items: center;gap: 6px;">

                                                <a class="activity_row text-success"
                                                    onclick="show_enquiry('{{ $value->id }}')" data-toggle="modal"
                                                    data-target="#gridSystemModal"
                                                    class="btn btn-success btn-sm px-3 py-2" style="  ">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path
                                                            d="M12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3ZM12.0003 19C16.2359 19 19.8603 16.052 20.7777 12C19.8603 7.94803 16.2359 5 12.0003 5C7.7646 5 4.14022 7.94803 3.22278 12C4.14022 16.052 7.7646 19 12.0003 19ZM12.0003 16.5C9.51498 16.5 7.50026 14.4853 7.50026 12C7.50026 9.51472 9.51498 7.5 12.0003 7.5C14.4855 7.5 16.5003 9.51472 16.5003 12C16.5003 14.4853 14.4855 16.5 12.0003 16.5ZM12.0003 14.5C13.381 14.5 14.5003 13.3807 14.5003 12C14.5003 10.6193 13.381 9.5 12.0003 9.5C10.6196 9.5 9.50026 10.6193 9.50026 12C9.50026 13.3807 10.6196 14.5 12.0003 14.5Z">
                                                        </path>
                                                    </svg></a>

                                                <a class="activity_row text-danger"
                                                    href="{{ route('deleterow', ['table' => 'enquiries', 'id' => $value->id, 'image' => $image]) }}"
                                                    onclick="return confirm('Are you sure !')"
                                                    class="btn btn-danger btn-sm px-3 py-2">
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
                        {{ $enquires->links('bootstrap-5-custom') }}

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

        }
    },

    pageLength: 10,
    responsive: true,
    "ordering": false,

});
</script> --}}

<script>
    function show_enquiry(id){
        var dataToSend = {
                data_key: id // Replace 'data_key' and '#inputField' with your actual data and input field ID
            };

            $.ajax({
                url: "{{ route('getenquiry') }}",
                method: 'POST',
                data: dataToSend,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Handle success
                   $('#view_idoc').html(response);
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error('AJAX Error: ', status, error);
                }
            });

    }
</script>


@endsection


@endsection
