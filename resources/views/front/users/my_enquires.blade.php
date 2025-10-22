
<?php
    $metatitle =  'My Enquires - Aashapura';
    $metatags =   'not found';
    $desc =   'not found';
?>

@section('title', $metatitle)
@section('metatags', $metatags)
@section('desc', $desc)

@extends('front.common.layout')
@section('content')
@section('title','Aashapura')

<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title text-white">Bulk Enquiry Dashboard</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    Enquiry
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                @if(session('success'))
                <div class="alert alert-success mt-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($enquiries->count())
                <div class="mt-5">
                    <h4 class="text-center mb-4">All Bulk Enquiries</h4>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
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
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $enquiries->links('bootstrap-5-custom') }}
                </div>
            @else
                <div class="mt-5 text-center">
                    <p>No enquiries submitted yet.</p>
                </div>
            @endif
            
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .dashboard -->
    </div>
</main>

@endsection



