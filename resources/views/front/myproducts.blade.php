@extends('front.common.layout')
@section('content')
@section('title','Aashapura')

<style>
    .danger_status {
        color: #ff1313;
        font-weight: 600;
    }
</style>


<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">My Products</h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    My Products
                </li>
            </ol>
        </div>
        <!-- End .container -->
    </nav>
    <!-- End .breadcrumb-nav -->
    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover table-striped table-responsive">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Available Qty</th>
                                    <th>Remaining Qty</th>
                                    <th>Price</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Size</th>
                                    <th>Image</th>
                                    <th>Verify Status</th>
                                    <?php if (Auth::user()->role == "provider") { ?>
                                        <th>Service Days</th>
                                    <?php } elseif (Auth::user()->role == "vendor") { ?>
                                        <th>Repair Information</th>
                                    <?php } ?>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $key => $value) {

   $totalQuantity = (int) $value->quantity;

    $bookedCount = DB::table('booking')
        ->where('product_id', $value->id)
          ->where('owner_status', '!=', 'accept')
        ->where('booking_status_user', '!=', 'cancelled')
        ->count();

    $value->remaining_quantity = max($totalQuantity - $bookedCount, 0);

                                ?>
                                    <tr>
                                        <td>{{ $value->title }}</td>
                                        <td> <span class="btn-sm p-3 h6 bg-success text-white">{{ $value->quantity }}</span></td>
                                      
                                        <td>
    <span class="btn-sm p-3 h6 bg-success text-white">
        {{ $value->remaining_quantity }}
    </span>
</td>
                                        <td>Rs.{{ $value->price }}</td>
                                        <td>{{ $value->brand_name }}</td>
                                        <td>{{ $value->category_name }}</td>
                                        <td>{{ $value->size }}Inch</td>
                                        <td>
                                            <img src="{{ url('') }}/products/{{ $value->image1 }}" loading="lazy" alt=""
                                                width="70">
                                        </td>
                                        <td>
                                            <?php if ($value->verify_status == "panding") { ?>
                                                <p class="btn btn-warning mybttn btn-sm">Panding</p>
                                            <?php } elseif ($value->verify_status == "verified") { ?>
                                                <p class="btn btn-success mybttn btn-sm text-white">Verified</p>
                                            <?php } else { ?>
                                                <p class="btn btn-danger mybttn btn-sm text-white">Rejected</p>
                                            <?php } ?>

                                        </td>


                                        <?php if (Auth::user()->role == "provider") { ?>

                                            <td>
                                                <?php if ($value->service_days_count >= 100) { ?>
                                                    <div class="danger_status">
                                                        <?= $value->service_days_count ?> days
                                                        <svg style="width: 15px;position: relative;top: -1px;margin-left: 4px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                                            <path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 15H13V17H11V15ZM11 7H13V13H11V7Z"></path>
                                                        </svg>
                                                    </div>
                                                    <?php
                                                    // Show "Request Repair" button if repair_status is 'none' OR if it was completed but service_days_count is >= 100 again
                                                    if (
                                                        $value->repair_status == 'none' ||
                                                        ($value->repair_status == 'completed' && $value->service_days_count >= 100)
                                                    ) {
                                                    ?>
                                                        {{-- <a href="/request-repair/{{ $value->id }}" onclick="return confirm('Are you sure you want to request repair for this cycle?')" class="btn btn-warning btn-sm mt-2">Request Repair</a> --}}
                                                        <button  data-toggle="modal" onclick="setaction({{ $value->id }})" data-target="#myModal" class="btn btn-warning btn-sm mt-2">Request Repair</button>
                                                    <?php } elseif ($value->repair_status == 'requested') { ?>
                                                    
                                                     <form action="{{ route('update.auditor-repair') }}" method="POST" class="d-inline">
                    
                    @csrf
                    
                    <input type="hidden" name="product_id" value="{{ $value->id }}">
                    <select name="auditor_id" class="form-control form-control-sm" style="width: auto; display: inline-block;">
                        <option value="">Change Auditor</option>
                        @foreach($auditors as $val)
                        <option value="{{$val->id}}" {{ $value->auditor==$val->id ? "selected" : "" }} >{{$val->name}}</option>
                        @endforeach
                    </select>
                    
                    
                    <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                </form>
                                                    
                                                        <span class="badge bg-info text-white mt-2">Repair Requested</span>
                                                    <?php }
                                                    // Only show "Recently Repaired" if days since repair < 30 AND service_days_count is still < 100
                                                    elseif (
                                                        $value->repair_status == 'completed' && $value->last_repair_date &&
                                                        \Carbon\Carbon::parse($value->last_repair_date)->diffInDays(now()) < 30 &&
                                                        $value->service_days_count < 100
                                                    ) {
                                                    ?>
                                                        <span class="badge bg-success text-white mt-2">Recently Repaired</span>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <div><?= $value->service_days_count ?> days</div>
                                                    <?php
                                                    // Only show "Recently Repaired" if days since repair < 30
                                                    if (
                                                        $value->repair_status == 'completed' && $value->last_repair_date &&
                                                        \Carbon\Carbon::parse($value->last_repair_date)->diffInDays(now()) < 30
                                                    ) {
                                                    ?>
                                                        <span class="badge bg-success text-white mt-2">Recently Repaired</span>
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>

                                            <?php } elseif(Auth::user()->role == "vendor"){ ?>
     <!-- Repair information display for vendors -->
<td>

<style>
    /* Add this to your existing styles */
    .ml-2 {
        margin-left: 8px;
    }
    
    .mt-2 {
        margin-top: 8px;
    }
    
    .d-inline {
        display: inline;
    }
    
    .form-control-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        line-height: 1.5;
        border-radius: 0.2rem;
    }
</style>


    <div class="repair-info">
        <p><strong>Status:</strong> 
            <?php if($value->repair_status == 'none'){ ?>
                <span class="badge bg-secondary text-white">No Repairs</span>
            <?php } elseif($value->repair_status == 'requested'){ ?>
                <span class="badge bg-warning text-dark">On Repair</span>
            <?php } elseif($value->repair_status == 'completed'){ ?>
                <span class="badge bg-success text-white">Repair Completed</span>
            <?php } ?>
            
            <!-- Add status change dropdown -->
            <div class="mt-2">
                <form action="{{ route('update.repair.status') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $value->id }}">
                    <select name="repair_status" class="form-control form-control-sm" style="width: auto; display: inline-block;">
                        <option value="">Change Status</option>
                        <option value="none" {{ $value->repair_status == 'none' ? 'disabled' : '' }}>No Repairs</option>
                        <option value="requested" {{ $value->repair_status == 'requested' ? 'disabled' : '' }}>On Reapir</option>
                        <option value="completed" {{ $value->repair_status == 'completed' ? 'disabled' : '' }}>Mark as Completed</option>
                    </select>
                    
                    
                    <select name="auditor_id" class="form-control form-control-sm" style="width: auto; display: inline-block;">
                        <option value="">Change Auditor</option>
                        @foreach($auditors as $val)
                        <option value="{{$val->id}}">{{$val->name}}</option>
                        @endforeach
                    </select>
                    
                    
                    <button type="submit" class="btn btn-sm btn-primary ml-2">Update</button>
                </form>
            </div>
        </p>
        
        <?php if($value->last_repair_date){ ?>
        <p><strong>Last Repair:</strong> 
            <span><?= date('d M Y', strtotime($value->last_repair_date)) ?></span>
            <span class="text-muted">(<?= \Carbon\Carbon::parse($value->last_repair_date)->diffForHumans() ?>)</span>
        </p>
        <?php } else { ?>
        <p><strong>Last Repair:</strong> <span class="text-muted">Never repaired</span></p>
        <?php } ?>
        
        <!-- Display total service days for vendor's reference -->
        <p><strong>Service Days:</strong> <span><?= $value->service_days_count ?> days</span></p>
    </div>
</td>

 



                                        <?php } ?>
                                        <td>
                                            <?php if ($value->verify_status == "verified") { ?>
                                                <a href="/product/{{ $value->slug }}" class="btn btn-sm btn-success"
                                                    style="min-width:max-content">
                                                    <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor">
                                                        <path
                                                            d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z">
                                                        </path>
                                                    </svg></a>
                                                    <a href="/product-edit/{{ $value->slug }}" class="btn btn-sm btn-info"
                                                    style="min-width:max-content">
                                                    <svg width="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12.8995 6.85453L17.1421 11.0972L7.24264 20.9967H3V16.754L12.8995 6.85453ZM14.3137 5.44032L16.435 3.319C16.8256 2.92848 17.4587 2.92848 17.8492 3.319L20.6777 6.14743C21.0682 6.53795 21.0682 7.17112 20.6777 7.56164L18.5563 9.68296L14.3137 5.44032Z"></path></svg></a>
                                            <?php } else { ?>
                                                <span>View not Available</span>
                                            <?php  } ?>
                                        </td>
                                    </tr>
                                <?php  } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .dashboard -->
    </div>
</main>

@section('footer')
<script>
    function moveToNext(current, nextFieldID) {
        if (current.value.length >= current.maxLength) {
            document.getElementById(nextFieldID).focus();
        }
    }
    document.addEventListener("DOMContentLoaded", function() {
        const yearSelect = document.getElementById('expiry-year');
        const currentYear = new Date().getFullYear();
        const endYear = currentYear + 10; // You can adjust the number of years

        for (let year = currentYear; year <= endYear; year++) {
            const option = document.createElement('option');
            option.value = year;
            option.textContent = year;
            yearSelect.appendChild(option);
        }
    });
</script>


<div class="modal" id="myModal">
    <div class="modal-dialog">
        <form action="" id="form_service">
      <div class="modal-content">
  
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
  
        <!-- Modal body -->
        <div class="modal-body p-3 text-center">
          <h4>Select Auditor For Service</h4>
        <select name="auditor" id="" class="form-control">
            @php
                $auditors = App\Models\User::where('role','auditor')->where('is_active','Y')->latest()->get();
            @endphp
            @foreach ($auditors as $key => $value )
            <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
        </div>
  
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" >Make Request</button>
        </div>
  
      </div>
    </form>
    </div>
  </div>

  <script>
    function setaction(productid) {
        var url = '/request-repair/' + productid;
        document.getElementById('form_service').action = url;
    }
</script>

@endsection


@endsection