@extends('front.common.layout')
@section('content')
@section('title','Aashapura')
@section('header')
<link rel="stylesheet" href="{{ url('website') }}/assets/css/plugins/magnific-popup/magnific-popup.css" />
<!--</head>-->

<style>
    .dd_danger{
        background-color: #dc3545;
    width: max-content;
    margin: auto;
    color: #fff;
    padding: 4px 17px;
    font-size: 12px;
    font-weight: 600;
        min-width: 120px;
}

    .mybutton{
     background-color: #ff8d00;
    color: white;
    padding: 5px 10px;
    border: none;
    border-radius: 5px;
    font-size: 12px;
    transition: background-color 0.3s ease
    }

    .mybutton:hover {
  background-color: #45a049;
}


    .rounded-box-pr {
        width: 20px;
        height: 20px;
        border-radius: 100%;
    }

    .star-rating {
        direction: rtl;
        font-size: 2rem;
        unicode-bidi: bidi-override;
    }

    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        color: #ccc;
        cursor: pointer;
        font-size: 30px;
    }

    .star-rating input[type="radio"]:checked~label {
        color: #f5b301;
    }

    .star-rating label:hover,
    .star-rating label:hover~label {
        color: #f5b301;
    }


</style>


<style>
    
.upload {
  &__box {
    padding: 40px;
  }
  &__inputfile {
    width: .1px;
    height: .1px;
    opacity: 0;
    overflow: hidden;
    position: absolute;
    z-index: -1;
  }
  
  &__btn {
    display: inline-block;
    font-weight: 600;
    color: #fff;
    text-align: center;
    min-width: 116px;
    padding: 5px;
    transition: all .3s ease;
    cursor: pointer;
    border: 2px solid;
    background-color: #4045ba;
    border-color: #4045ba;
    border-radius: 10px;
    line-height: 26px;
    font-size: 14px;
    
    &:hover {
      background-color: unset;
      color: #4045ba;
      transition: all .3s ease;
    }
    
    &-box {
      margin-bottom: 10px;
    }
  }
  
  &__img {
    &-wrap {
      display: flex;
      flex-wrap: wrap;
      margin: 0 -10px;
    }
    
    &-box {
      width: 200px;
      padding: 0 10px;
      margin-bottom: 12px;
    }
    
    &-close {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background-color: rgba(0, 0, 0, 0.5);
        position: absolute;
        top: 10px;
        right: 10px;
        text-align: center;
        line-height: 24px;
        z-index: 1;
        cursor: pointer;

        &:after {
          content: '\2716';
          font-size: 14px;
          color: white;
        }
      }
  }
}

.img-bg {
  background-repeat: no-repeat;
  background-position: center;
  background-size: cover;
  position: relative;
  padding-bottom: 100%;
}

.upload__img-wrap{
        display: flex;
    align-items: center;
    gap: 10px;
}

.upload__img-close{
        width: 20px;
    height: 20px;
    position: absolute;
    background-color: #fff;
    right: 0;
        display: flex;
    align-items: center;
    border: 1px solid #eee;
    
}

.upload__img-box {
    width: 30%;
}

.upload_d_box{
        width: max-content;
    background-color: #eee;
    padding: 11px 19px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.ddflexsvg{
        height: 30px;
    width: 30px;
    background-color: #eee;
    padding: 5px;
    color: #17a2b8;
    border-radius: 5px;

}

</style>
@endsection



<!--  View modal -->
<div class="modal fade" id="viewEditModal" tabindex="-1" aria-labelledby="viewEditModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Order Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row p-4">
                    <div class="col-12">
                      <div id="booking_detils"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!--  View modal -->
<div class="modal fade" id="accept_model" tabindex="-1" aria-labelledby="accept_model" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Captcure</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/accept-booking" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="number" name="bookingid" id="bookingidenty" hidden>
                <div class="row p-4">
                    <div class="col-12">
                      <div id="uploadaccept_images">
                            <div class="upload__box">
  <div class="upload__btn-box">
    <label class="upload__btn">
      <div class="upload_d_box">
          <svg style="width: 30px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1 14.5C1 12.1716 2.22429 10.1291 4.06426 8.9812C4.56469 5.044 7.92686 2 12 2C16.0731 2 19.4353 5.044 19.9357 8.9812C21.7757 10.1291 23 12.1716 23 14.5C23 17.9216 20.3562 20.7257 17 20.9811L7 21C3.64378 20.7257 1 17.9216 1 14.5ZM16.8483 18.9868C19.1817 18.8093 21 16.8561 21 14.5C21 12.927 20.1884 11.4962 18.8771 10.6781L18.0714 10.1754L17.9517 9.23338C17.5735 6.25803 15.0288 4 12 4C8.97116 4 6.42647 6.25803 6.0483 9.23338L5.92856 10.1754L5.12288 10.6781C3.81156 11.4962 3 12.927 3 14.5C3 16.8561 4.81833 18.8093 7.1517 18.9868L7.325 19H16.675L16.8483 18.9868ZM13 13V17H11V13H8L12 8L16 13H13Z"></path></svg>
      <span style"font-size: 14px;color: #000;font-weight: 400;">Upload images</span></div>
      <input hidden type="file"  capture="environment" name="images[]" data-max_length="20" class="upload__inputfile">
    </label>
  </div>
  <div class="upload__img-wrap"></div>
</div>

<button type="submit" hidden class="btn btn-success mt-2" id="submit">Submit</button>

                      </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!--  Provider Checkout Modal -->
<div class="modal fade" id="providerCheckoutModal" tabindex="-1" aria-labelledby="providerCheckoutModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Process Checkout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/provider-process-checkout" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row p-4">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="mb-3">
                                        <label for="checkout_date" class="form-label" style="color: #000">Check Out Date *</label>
                                        <input type="date" name="checkout_date" class="form-control" id="checkout_date" required
                                            style="height: 50px; background: none; border: 1px dotted #000;" />
                                        <input type="hidden" name="check_in_date" id="provider_check_in_date">
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="mb-3">
                                        <label for="checkout_image" class="form-label" style="color: #000">Check Out Product Pic *</label>
                                        <input type="hidden" name="booking_id" id="provider_booking_id">
                                        <input type="hidden" name="product_id" id="provider_product_id">
                                        <input type="file" class="form-control" name="checkout_image" id="checkout_image" required
                                            style="height: 50px; background: none; border: 1px dotted #000;" />
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm">
                                Process Checkout
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



@section('footer')
<script>
   function openProviderCheckout(id, checkin, productId) {
        document.getElementById('provider_booking_id').value = id;
        document.getElementById('provider_check_in_date').value = checkin;
        document.getElementById('provider_product_id').value = productId;
    }



  function ImgUpload() {
    var imgWrap = "";
    var imgArray = [];
  
    $('.upload__inputfile').each(function () {
      $(this).on('change', function (e) {
        document.getElementById('submit').removeAttribute("hidden");
  
        imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
        var maxLength = $(this).attr('data-max_length');
  
        // Clear previous images and reset the array
        imgWrap.empty();
        imgArray = [];
  
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
  
        filesArr.forEach(function (f) {
          if (!f.type.match('image.*')) {
            return;
          }
  
          if (imgArray.length >= maxLength) {
            return false;
          } else {
            imgArray.push(f);
  
            var reader = new FileReader();
            reader.onload = function (e) {
              var html = `
                <div class='upload__img-box'>
                  <div style='background-image: url(${e.target.result})' 
                    data-number='${$(".upload__img-close").length}' 
                    data-file='${f.name}' class='img-bg'>
                    <div class='upload__img-close'>
                      <svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='currentColor'>
                        <path d='M11.9997 10.5865L16.9495 5.63672L18.3637 7.05093L13.4139 12.0007L18.3637 16.9504L16.9495 18.3646L11.9997 13.4149L7.04996 18.3646L5.63574 16.9504L10.5855 12.0007L5.63574 7.05093L7.04996 5.63672L11.9997 10.5865Z'></path>
                      </svg>
                    </div>
                  </div>
                </div>`;
              imgWrap.append(html);
            };
            reader.readAsDataURL(f);
          }
        });
      });
    });
  
    // Image delete functionality
    $('body').on('click', ".upload__img-close", function () {
      var file = $(this).parent().data("file");
      for (var i = 0; i < imgArray.length; i++) {
        if (imgArray[i].name === file) {
          imgArray.splice(i, 1);
          break;
        }
      }
      $(this).closest('.upload__img-box').remove();
    });
  }
  
  // Initialize the function
  $(document).ready(function () {
    ImgUpload();
  });
  </script>
  

<script>
    function uploadimges(bookingid){
        document.getElementById('bookingidenty').setAttribute("value",bookingid);
    }
</script>

<script>
    function openeditmodel(id){
        document.getElementById('bookingidenty').setAttribute("value", id);
    }
    
     function vieworderdetails(id){
          $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    $.ajax({
        url: "/vieworderdetails", // Route to handle the request
        method: "POST",
        data: {
            booking: id,
        },
        success: function (response) {
            if(response.status == "error"){
                var data = "Item Not Found !";
                $("#booking_detils").html(data);
            }else{
                $("#booking_detils").html(response);
            }
            
        },
        error: function (xhr, status, error) {
            console.log(xhr);
            console.log(status);
            console.log(error);
        },
    });        
    }
    
</script>

@endsection 


<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Orders </h1>
        </div>
        <!-- End .container -->
    </div>
    <!-- End .page-header -->
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    My Orders
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
                        @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Check In</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Deposit</th>
                                              <th scope="col">Checkout Status</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($my_orders as $key=> $value){ ?>
                                        <tr>
                                            <td><?= $key+1 ?></td>
                                            <td> <a href="/product/<?= $value->producturl ?>"><?= $value->producttitle ?></a></td>
                                            <td><?= $value->name ?></td>
                                            <td><?= $value->check_in ?></td>
                                            <td><?= $value->phone ?></td>
                                            <td><?= 'Rs.'.$value->paid_amount ?></td>
                                              <td>
                                                <?php if($value->checkout_status == "pending"){ ?>
                                                <p class="dd_danger bg-warning">Pending</p>
                                                <?php }elseif($value->checkout_status == "applied"){ ?>
                                               <div class="d-flex">
                                                    <p class="dd_danger bg-info">Applied</p>
                                              <div class="dropdown">
                                                    <a href="#" class="" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg class="ddflexsvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 3C10.9 3 10 3.9 10 5C10 6.1 10.9 7 12 7C13.1 7 14 6.1 14 5C14 3.9 13.1 3 12 3ZM12 17C10.9 17 10 17.9 10 19C10 20.1 10.9 21 12 21C13.1 21 14 20.1 14 19C14 17.9 13.1 17 12 17ZM12 10C10.9 10 10 10.9 10 12C10 13.1 10.9 14 12 14C13.1 14 14 13.1 14 12C14 10.9 13.1 10 12 10Z"></path></svg></a>
                                                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="/accept-checkout/{{$value->id}}">Accept Checkout</a>
    <a class="dropdown-item" href="/cancel-checkout/{{$value->id}}">Decline Checkout</a>
  </div>
                                                    </div>
                                                    <?php $rand = rand(); ?>
                                                     <div class="dropdown">
                                                    <a href="#" class="" id="dropdownMenuButton12<?= $rand ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                    ><svg class="ddflexsvg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z"></path></svg></a>
                                                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton12<?= $rand ?>">
                                                        <a href="{{url('')}}/uploads/{{$value->checkout_image}}">
                                                            <img src="{{url('')}}/uploads/{{$value->checkout_image}}">
                                                            </a>
                                                    </div>
                                                    </div>
                                                    
                                               </div>
                                                <?php }elseif($value->checkout_status == "accept") {?>
                                                <p class="dd_danger bg-success">Success</p>
                                                <?php }else{ ?>
                                                <p class="dd_danger bg-danger">Rejected</p>
                                                <?php } ?>

                                                <button class="mybutton mt-1" data-toggle="modal" data-target="#feedbackmodel{{ $key }}">Rate to User</button>
                                                
                                                @include('partials.feedbackModaltouser' , ['product' => $value->product ?? [] , 'key' => $key ,'orderdata' => $value, "user_id" => $value->user_id])


                                            </td>
                                            <td style="padding:0px;">
                                                <?php if($value->booking_status_user == "running"){ 
                                                if($value->owner_status == "accept"){
                                                ?> 
                                                <div class="btn btn-success btn-sm">Booked</div>
                                                <?php }else{ ?>
                                                <div class="btn btn-success btn-sm">Running</div>
                                                <?php } ?>
                                                
                                                <?php }else{ ?>
                                                <div class="btn btn-danger btn-sm">Cancelled</div>
                                                <?php } ?>
                                            </td>
                                            <td>
    <?php if($value->booking_status_user == "running" && $value->owner_status == "panding"){ ?> 
        <div class="">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#accept_model" onclick="uploadimges('<?= $value->id ?>')"  class="btn btn-success">Accept</a>
        </div>
        
        <div class="">
            <a href="javascript:void(0)" srpath="/cancel-booking/{{$value->id}}" onclick="confirmationurlgo(this)" title="Cancel Booking" text="" confimationtext="Yes cancel it"  class="btn btn-danger">Cancel</a>
        </div>
    <?php } else if($value->booking_status_user == "running" && $value->checkout_status == "pending") { ?>
        <!-- Add this checkout button for providers -->
        <button type="button" class="btn-warning btn-sm" data-toggle="modal" data-target="#providerCheckoutModal" 
            onclick="openProviderCheckout('<?= $value->id ?>', '<?= $value->check_in ?>', '<?= $value->product_id ?>')">
            Process Checkout
        </button>
    <?php } ?>
    
    <button type="button" class="btn-info btn" data-toggle="modal" data-target="#viewEditModal" onclick="vieworderdetails('<?= $value->id ?>')">
        View
    </button>
</td>

                                        </tr>
                                        <?php } ?>
                                       
                                    </tbody>
                                </table>
                    </div>
                     {{$my_orders->links('bootstrap-5-custom') }}
                </div>
                    <!-- End .col-lg-9 -->
                </div>
                <!-- End .row -->
            </div>
            <!-- End .container -->
        </div>
        <!-- End .dashboard -->
    </div>
</main>



@endsection
