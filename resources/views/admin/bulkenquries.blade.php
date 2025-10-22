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
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Check-In</th>
                                    <th>Check-Out</th>
                                    <th>Quantity</th>
                                    <th>Vendor</th>
                                    <th>Submitted At</th>
                                </tr>
                                </thead>
                                <tbody>
                                     @foreach($enquiries as $index => $enquiry)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $enquiry->name }}</td>
                                        <td>{{ $enquiry->email }}</td>
                                        <td>{{ $enquiry->phone }}</td>
                                        <td>{{ $enquiry->address_1 }}</td>
                                        <td>{{ $enquiry->check_in_date }}</td>
                                        <td>{{ $enquiry->check_out_date }}</td>
                                        <td>{{ $enquiry->quantity }}</td>
                                        <td>{{ $enquiry->vendor->name ?? 'N/A' }}</td>
                                        <td>{{ $enquiry->created_at->format('d M Y h:i A') }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>




                        </div>
                        {{ $enquiries->links('bootstrap-5-custom') }}

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
