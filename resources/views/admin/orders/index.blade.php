@extends('admin.layout.layout')
@section('title','Orders')

@section('content')



<style>
    .categoryimage {
        width: 100px;
        height: 60px;
        border-radius: 7px;
        object-fit: contain;
    }

    .success_button {
        width: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 30px;
    }
    
    /* width */
.table-responsive::-webkit-scrollbar {
  width: 2px !important;
}

/* Track */
.table-responsive::-webkit-scrollbar-track {
  background: #f1f1f1;
    width: 2px !important;
    height:2px !important;
}

/* Handle */
.table-responsive::-webkit-scrollbar-thumb {
  background: #1abc9c;
    width: 2px !important;
    height:2px !important;
}

/* Handle on hover */
.table-responsive::-webkit-scrollbar-thumb:hover {
  background: #555;
    width: 2px !important;
    height:2px !important;
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
                            <h5 class="m-b-10">Orders</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Orders</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

{{-- <div class="col-md-6 text-right mb-3">
    <div class="d-flex justify-content-start">
        <select id="exportFormat" class="form-control" style="width: 120px; margin-right: 10px;">
            <option value="">Export</option>
            <option value="excel">Excel</option>
            <option value="csv">CSV</option>
            <option value="pdf">PDF</option>
        </select>
        <button id="exportBtn" class="btn btn-primary" data-export-url="{{ url('admin/export-orders') }}">Download</button>
    </div>
</div> --}}


{{-- 
@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('exportBtn').addEventListener('click', function() {
            const format = document.getElementById('exportFormat').value;
            if (format) {
                const baseUrl = this.getAttribute('data-export-url');
                window.location.href = baseUrl + '/' + format;
            } else {
                alert('Please select an export format');
            }
        });
    });
</script>
@endsection --}}



        <!-- [ breadcrumb ] end -->
        <!-- [ Main Content ] start -->
        <div class="row">
            <!-- [ basic-table ] start -->
            <div class="col-md-12">
                <div class="card">

                    
                    <div class="card-body table-border-style">
                        <div class="row mb-3">
                            <div class="col-md-3 mb-2">
                                <label for="from_date" class="form-label">From Date</label>
                                <input type="date" id="from_date" class="form-control">
                            </div>
                            <div class="col-md-3 mb-2">
                                <label for="to_date" class="form-label">To Date</label>
                                <input type="date" id="to_date" class="form-control">
                            </div>
                            <div class="col-md-3 mb-2 d-flex align-items-end">
                                <button id="filter" class="btn btn-primary mr-2">Filter</button>
                                <button id="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table" id="orders-table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Product</th>
                                        <th>User</th>
                                        <th>Vendor/Provider</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Order Time</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>


                            {{-- <table class="table" id="example-table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Product</th>
                                        <th>User</th>
                                        <th>Vendor/Provider</th>
                                        <th>Check In</th>
                                        <th>Check Out</th>
                                        <th>Order Time</th>
                                        <th>View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
    use Carbon\Carbon;
    // Replace with your actual date
@endphp
                                   <?php foreach ($results as $key => $value) { ?>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->product_name }}</td>
                                        <td><a href="/admin/view-vendor-providers/{{$value->user_id}}">{{ $value->user_name }}</a></td>
                                        <td><a href="/admin/view-vendor-providers/{{$value->seller_id}}"><?= view_seller($value->seller_id) ?></a></td>
                                        <td>
                                            <?php
                                            echo Carbon::parse($value->check_in)->format('d-m-Y');
                                            ?>
                                        </td>
                                         <td><?php
                                            echo Carbon::parse($value->check_out)->format('d-m-Y');
                                            ?></td>

                                        <td>
                                         <?= Carbon::parse($value->created_at)->format('d-m-Y h:i A'); ?>
                                        </td>

                                        <td>
                                            <a href="/admin/order-view/{{ $value->id }}"
                                                class="btn btn-success btn-sm success_button"><svg width="20"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z">
                                                    </path>
                                                </svg></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>


                            </table> --}}


                            <!--{{-- {{ $categories->links() }} --}}-->
                        </div>

                        {{-- {{ $results->links('bootstrap-5-custom') }} --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>



@section('header')

<link rel="stylesheet" type="text/css" href="{{ url('') }}/data_table/css/dataTables.dataTables.css?v1">
<link rel="stylesheet" type="text/css" href="{{ url('') }}/data_table/css/buttons.dataTables.css?v1">
<link rel="stylesheet" href="{{ url('') }}/data_table/css/responsive.dataTables.css?v1">

@endsection

@section('js')

<script src="{{ url('') }}/data_table/js/dataTables.js"></script>
<script src="{{ url('') }}/data_table/js/dataTables.buttons.js"></script>
<script src="{{ url('') }}/data_table/js/buttons.dataTables.js"></script>
<script src="{{ url('') }}/data_table/js/jszip.min.js"></script>
<script src="{{ url('') }}/data_table/js/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="{{ url('') }}/data_table/js/dataTables.responsive.js"></script>
<script src="{{ url('') }}/data_table/js/responsive.dataTables.js"></script> 

<script>
    $(function () {
        var table = $('#orders-table').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            ajax: {
                url: '{{ route('admin.orders.data') }}',
                data: function (d) {
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                }
            },
            dom: 'Bfrtip',
            buttons: [
                { extend: 'csvHtml5', title: 'Orders' },
                { extend: 'excelHtml5', title: 'Orders' },
                'print'
            ],
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'product_name', name: 'product_name' },
                { data: 'user_link', name: 'user_name' },
                { data: 'seller_link', name: 'seller_id' },
                { data: 'check_in', name: 'check_in' },
                { data: 'check_out', name: 'check_out' },
                { data: 'order_time', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    
        $('#filter').click(function () {
            table.draw();
        });
    
        $('#reset').click(function () {
            $('#from_date').val('');
            $('#to_date').val('');
            table.draw();
        });
    });
    </script>

@endsection


@endsection



