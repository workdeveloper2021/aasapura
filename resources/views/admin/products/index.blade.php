@extends('admin.layout.layout')
@section('title','Dashboard - Product List')

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
</style>

<section class="pcoded-main-container">
    <div class="pcoded-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header">
            <div class="page-block">
                <div class="row align-items-center">
                    <div class="col-md-12">
                        <div class="page-header-title">
                            <h5 class="m-b-10">Products</h5>
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Products</a></li>
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
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Brands</th>
                                        <th>Category</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                        <th>Verify Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($results as $key => $value) { ?>
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $value->title }}</td>
                                        <td>Rs.{{ $value->price }}</td>
                                        <td>{{ $value->brand_name }}</td>
                                        <td>{{ $value->category_name }}</td>
                                        <td>
                                            <img src="{{ url('') }}/products/{{ $value->image1 }}" alt="" loading="lazy"
                                                class="categoryimage">
                                        </td>

                                        <td>
                                            <?php if($value->verify_status == "panding"){ ?>
                                            <p class="bg-warning badge text-white">Panding</p>
                                            <?php }elseif($value->verify_status == "verified"){ ?>
                                            <p class="bg-success badge text-white">Verified</p>
                                            <?php }else{ ?>
                                            <p class="bg-danger badge text-white">Rejected</p>
                                            <?php } ?>
                                        </td>

                                        <td>
                                            <a href="/admin/product-view/{{ $value->id }}"
                                                class="btn btn-success btn-sm success_button"><svg width="20"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z">
                                                    </path>
                                                </svg></a>

                                            <a onclick="return confirm('Are you sure !,Delete this')"
                                                href="/admin/delete/products/{{ $value->id }}"
                                                class="btn btn-danger btn-sm success_button"><svg width="20"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor">
                                                    <path
                                                        d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
                                                    </path>
                                                </svg></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>


                            </table>


                            {{-- {{ $categories->links() }} --}}
                        </div>

                        {{-- {{ $data->links('bootstrap-5-custom') }} --}}
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>



@endsection
