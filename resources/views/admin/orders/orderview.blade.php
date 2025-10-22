@extends('admin.layout.layout')
@section('title','Dashboard - Order Details')
@section('content')

         @php
    use Carbon\Carbon;
    // Replace with your actual date
@endphp
         
         
         
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

    .br_image {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        border: 1px solid #eee;
        object-fit: contain;
    }

    .products_images img {
        margin-right: 10px;
        width: 70px;
        border: 1px solid #eee;
        padding: 6px;
        height: 70px;
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
                            <!--<h5 class="m-b-10 text-capitalize">{{ $row->role }} - {{ $row->name }}</h5>-->
                        </div>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i
                                        class="feather icon-home"></i></a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0)" class="text-capitalize"> View</a></li>
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
                            
                            <?php 
                            
                            $product_detail = DB::table('products')->where('id',$row->product_id)->first();
                            $user = DB::table('users')->where('id',$row->user_id)->first();
                            $vendor = DB::table('users')->where('id',$row->seller_id)->first();
                            
                            ?>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <td>
                                            <?php if(isset($product_detail)){ echo $product_detail->title; }else{echo "product not found";} ?>
                                            <a href="/admin/product-view/{{$row->product_id}}" class="btn btn-success btn-sm ml-2">
                                                <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z"></path></svg>
                                            </a>
                                        </td>
                                    </tr>


                                    <tr>
                                        <th>User Name</th>
                                        <td>
                                            
                                             <?php if(isset($user)){ echo $user->name; }else{echo "User not found";} ?>
                                             <a href="/admin/view-vendor-providers/{{$row->user_id}}" class="btn btn-success btn-sm ml-2">
                                                 <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z"></path></svg>
                                             </a>
                                            
                                            </td>
                                    </tr>
                                    
                                      <tr>
                                        <th>Vendor/Provider</th>
                                        <td>
                                             <?php if(isset($vendor)){ echo $vendor->name;  ?>
                                             <a href="/admin/view-vendor-providers/{{$row->seller_id}}" class="btn btn-success btn-sm ml-2">
                                                 <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z"></path></svg>
                                             </a>
                                            <?php }else{echo ".$vendor->role."."not found";} ?>
                                            </td>
                                    </tr>
                                    
                                    <tr>
                                        <th>Phone</th>
                                        <td>{{ $row->phone }}</td>
                                    </tr>

                                    <tr>
                                        <th>Address 1</th>
                                        <td>
                                            <?= $row->address_1 ? $row->address_1 : "" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Address 2</th>
                                        <td>
                                            <?= $row->address_2 ? $row->address_2 : "" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Pincode</th>
                                        <td>
                                            <?= $row->pincode ? $row->pincode : "" ?>
                                        </td>
                                    </tr>
                                      <tr>
                                        <th>Check In</th>
                                        <td>
                                             <?php
                                            echo Carbon::parse($row->check_in)->format('d-m-Y');
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    
                                        <tr>
                                        <th>Check Out</th>
                                        <td>
                                             <?php
                                            echo Carbon::parse($row->check_out)->format('d-m-Y');
                                            ?>
                                        </td>
                                    </tr>
                                    
                                    
                                      <tr>
                                        <th>Paid Amount</th>
                                        <td>
                                            <span class="text-success">Rs.<?= $row->paid_amount ? $row->paid_amount : "" ?></span>
                                        </td>
                                    </tr>
                                    
                                     <tr>
                                        <th>Order Time</th>
                                        <td> 
                                        <?= Carbon::parse($row->created_at)->format('d-m-Y h:i A'); ?>
                                        </td>
                                    </tr>

                                  
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</section>



@endsection
