@extends('front.common.layout')
@section('content')
@section('title','Aashapura')
<main class="main">
    <div class="page-header text-center"
        style="background-image: url('{{ url('website') }}/assets/images/breadcum.jpg')">
        <div class="container">
            <h1 class="page-title">Add Post</h1>
        </div>
    </div>

    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    New Post
                </li>
            </ol>
        </div>
    </nav>
    
    <style>
        .rowwowreally .row{
            width: 100% !important;
            margin: auto !important;
        }
    </style>

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-0 offset-sm-2" style="border: 1px dotted #000; padding: 0px">
                <form action="{{ route('create_post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- category -->

                    <div style="border: 1px solid #f2f2f2">
                        <h5 class="p-4">Selected category</h5>
                    </div>
                    <div style="padding: 40px 50px">
                        <h6>Include some details</h6>
                        

                        <div class="row">


                            @php
    use App\Models\Purchasedplans;
    $plan = Purchasedplans::where('user_id', Auth::id())->latest()->first();
@endphp
<div class="col-12">
@if(!$plan)
    <div class="alert alert-warning mb-3" role="alert">
        <strong>⚠️ No Active Package:</strong> You don't have an active package. Please purchase one to create a post.
    </div>
@elseif($plan->end_date < now())
    <div class="alert alert-danger mb-3" role="alert">
        <strong>❌ Package Expired:</strong> Your current package has expired. Please renew or buy a new package to continue.
    </div>
@elseif($plan->post_quantity <= $plan->used_posts)
    <div class="alert alert-info mb-3" role="alert">
        <strong>ℹ️ Limit Reached:</strong> You’ve used all your allowed posts. Upgrade your plan to post more items.
    </div>
@endif
</div>


                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Ad title *
                                    </label>
                                    <input type="text" class="form-control" name="title" {{ old('title') }}
                                        id="exampleInputPassword1" required style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " />
                                    @error('title')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>


                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Model Name
                                        *
                                    </label>
                                    <input type="text" class="form-control" required name="model_name" {{ old('model_name') }}
                                        id="exampleInputPassword1" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " />
                                    @error('model_name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Color
                                        *</label>
                                    <select name="color" class="form-select form-control" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " aria-label="Default select example">
                                        <option selected>Open this select Colors</option>
                                        @foreach (App\Models\ProductElement::where('element_type', 'color')->get() as $element)
                                            <option value="{{ $element->element_name }}">{{ $element->element_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('color')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Other
                                        Color *
                                    </label>
                                    <input type="text" class="form-control" name="other_color" {{ old('other_color') }}
                                        id="exampleInputPassword1" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " />
                                    @error('other_color')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>






                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Brand
                                        *</label>
                                    <select name="brands" class="form-select form-control" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " aria-label="Default select example">
                                        <option selected>Open this select Brands</option>
                                        <?php foreach ($brands as $key => $value) {
                                        ?>
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        <?php } ?>
                                    </select>
                                    @error('brands')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Category
                                        *</label>
                                    <select name="category" class="form-select form-control" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " aria-label="Default select example">
                                        <option selected>select Category</option>

                                        <?php foreach($categories as $key => $v){ ?>
                                        <option value="{{ $v->id }}">{{ $v->name }}</option>
                                        <?php } ?>
                                    </select>
                                    @error('category')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Size
                                        *</label>
                                    <select name="size" class="form-select form-control" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " aria-label="Default select example">
                                        <option selected>select Size</option>
                                         @foreach (App\Models\ProductElement::where('element_type', 'size')->get() as $element)
                                            <option value="{{ $element->element_name }}">{{ $element->element_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('size')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            
                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Frame Size
                                        *</label>
                                    <select name="frame_size" class="form-select form-control" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " aria-label="Default select example">
                                        <option selected>select Size</option>
                                         @foreach (App\Models\ProductElement::where('element_type', 'frame_size')->get() as $element)
                                            <option value="{{ $element->element_name }}">{{ $element->element_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('frame_size')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Frame No.
                                        *
                                    </label>
                                    <input type="text" class="form-control" name="frame_no" {{ old('frame_no') }}
                                        id="exampleInputPassword1" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " />
                                    @error('frame_no')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror

                                </div>
                            </div>

                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Frame
                                        Material *</label>
                                    <select name="frame_material" class="form-select form-control" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " aria-label="Default select example">
                          <option selected>select Frame Material</option>
                                        @foreach (App\Models\ProductElement::where('element_type', 'frame_size')->get() as $element)
                                            <option value="{{ $element->element_name }}">{{ $element->element_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('frame_material')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Fork
                                        *</label>
                                    <select name="fork" class="form-select form-control" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " aria-label="Default select example">
                                        <option selected="">select Fork</option>
                                        @foreach (App\Models\ProductElement::where('element_type', 'fork')->get() as $element)
                                            <option value="{{ $element->element_name }}">{{ $element->element_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('fork')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                             <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Brake
                                        *</label>
                                    <select name="brake" class="form-select form-control"
                                        aria-label="Default select example" style="
                                      height: 50px;
                                      background: none;
                                      border: 1px dotted #000;
                                    ">
                                        <option selected="">select Brake</option>
                                         @foreach (App\Models\ProductElement::where('element_type', 'brake')->get() as $element)
                                            <option value="{{ $element->element_name }}">{{ $element->element_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brake')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Speed
                                        *</label>
                                        <select required name="speed" class="form-select form-control" id="speed_item"
                                        aria-label="Default select example" style="height: 50px; background: none; border: 1px dotted #000;">
                                        <option value="" selected>select Speed</option>
                                        <option value="1">Single Speed</option>
                                        <option value="2">Multi Speed</option>
                                    </select>
                                    @error('speed')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                           

                            <div class="col-12 col-sm-6 speed_r_item" style="display: none">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Shifters *
                                    </label>
                                    <input type="text" name="shifters" class="form-control" id="exampleInputPassword1"
                                         style="
                                      height: 50px;
                                      background: none;
                                      border: 1px dotted #000;
                                    ">
                                    @error('shifters')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 speed_r_item " style="display: none">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Front Gear
                                        *</label>
                                    <select name="front_gear" class="form-select form-control"
                                        aria-label="Default select example" style="
                                      height: 50px;
                                      background: none;
                                      border: 1px dotted #000;
                                    ">
                                        <option selected="">Select Gear</option>
                                          @foreach (App\Models\ProductElement::where('element_type', 'front_gear')->get() as $element)
                                            <option value="{{ $element->element_name }}">{{ $element->element_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('front_gear')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-sm-6 speed_r_item " style="display: none">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Rear Gear
                                        *</label>
                                    <select name="rear_gear" class="form-select form-control"
                                        aria-label="Default select example" style="
                                      height: 50px;
                                      background: none;
                                      border: 1px dotted #000;
                                    ">
                                        <option selected="">select Gear</option>
                                         @foreach (App\Models\ProductElement::where('element_type', 'rear_gear')->get() as $element)
                                            <option value="{{ $element->element_name }}">{{ $element->element_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('rear_gear')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 speed_r_item " style="display: none">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Front
                                        Derailleur *
                                    </label>
                                    <input type="text" name="front_derailleur" class="form-control"
                                        id="exampleInputPassword1"  style="
                                      height: 50px;
                                      background: none;
                                      border: 1px dotted #000;
                                    ">
                                    @error('front_derailleur')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-12 col-sm-6 speed_r_item " style="display: none">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Rear
                                        Derailleur *
                                    </label>
                                    <input type="text" name="rear_derailleur" class="form-control"
                                        id="exampleInputPassword1"  style="
                                      height: 50px;
                                      background: none;
                                      border: 1px dotted #000;
                                    ">
                                    @error('rear_derailleur')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label"
                                        style="color: #000">Description *
                                    </label>
                                    <textarea name="description" id="" class="form-control" cols="30" rows="10" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      "></textarea>
                                    @error('description')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                    <div id="emailHelp" class="form-text">
                                        Include condition, features and reason for selling
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-sm-12">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Large
                                        Description *
                                    </label>
                                    <textarea name="large_desc" class="form-control" id="summernote" cols="30"
                                        rows="10"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- price -->

                    <div style="border: 1px solid #f2f2f2">
                        <h5 class="p-4">Set a price</h5>
                    </div>
                    <div style="padding: 40px 50px">
                        <div class="mb-3">
                            <label for="" class="form-label" style="color: #000">Deposit check in
                                time *
                            </label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1" style="
                      height: 50px;
                      background: none;
                      border: 1px dotted #000;
                      border-right: none;
                      padding: 20px;
                    ">₹</span>
                                <input type="text" name="price" id="depositAmountField" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" style="
                      height: 50px;
                      background: none;
                      border: 1px dotted #000;
                    " />

                            </div>
                            @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="mb-3">
                            <label for="" class="form-label" style="color: #000">Rent ( Per Day ) *
                            </label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1" style="
                      height: 50px;
                      background: none;
                      border: 1px dotted #000;
                      border-right: none;
                      padding: 20px;
                    ">₹</span>
                                <input type="text" name="rent" id="rentAmountField" class="form-control" placeholder="" aria-label=""
                                    aria-describedby="basic-addon1" style="
                      height: 50px;
                      background: none;
                      border: 1px dotted #000;
                    " />

                            </div>
                            @error('rent')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div id="alertShowError" class="alert alert-danger"></div>

                        </div>
                    </div>



                 @if (Auth::user()->role == "vendor")
<div style="border: 1px solid #f2f2f2">
    <h5 class="p-4">Quantity</h5>
</div>
<div style="padding: 40px 50px">
    <div class="mb-3">
        <label for="" class="form-label" style="color: #000">Enter Quantity</label>
        <input type="number" class="form-control" name="quantity" id="quantityInput" 
               required style="height: 50px;background: none;border: 1px dotted #000;" />

        <small id="quantityHelp" class="form-text text-muted">
            You can add up to <b>{{ $remainingPosts }}</b> items based on your package.
        </small>

        <div id="qtyError" style="color:red; display:none; margin-top:5px;"></div>
    </div>
</div>
@endif




                    <!-- img upload -->

                    <div style="border: 1px solid #f2f2f2">
                        <div class="p-4">
                            <h5 class="mb-1">Upload up to 8 photos</h5>
                            <p class="text-danger">Upload at least 4 photos *</p>
                        </div>
                    </div>
                    <div style="padding: 40px 50px">
                        <div class="mb-3">
                            <div class="img-upload-wrapper rowwowreally">
                                <div class="row">
                                    <div class="col-12 col-sm-3">
                                        <div class="img-upload-box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
                                                    <input type="file" name="image1" class="image-upload"
                                                        accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        @error('image1')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 col-sm-3">
                                        <div class="img-upload-box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
                                                    <input type="file" name="image2" class="image-upload"
                                                        accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        @error('image2')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="img-upload-box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
                                                    <input type="file" name="image3" class="image-upload"
                                                        accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        @error('image3')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="img-upload-box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
                                                    <input type="file" name="image4" class="image-upload"
                                                        accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        @error('image4')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="img-upload-box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
                                                    <input type="file" name="image5" class="image-upload"
                                                        accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        @error('image5')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="img-upload-box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
                                                    <input type="file" name="image6" class="image-upload"
                                                        accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        @error('image6')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="img-upload-box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
                                                    <input type="file" name="image7" class="image-upload"
                                                        accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        @error('image7')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12 col-sm-3">
                                        <div class="img-upload-box">
                                            <div class="js--image-preview"></div>
                                            <div class="upload-options">
                                                <label>
                                                    <input type="file" name="image8" class="image-upload"
                                                        accept="image/*" />
                                                </label>
                                            </div>
                                        </div>
                                        @error('image8')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- location -->

                    <div style="border: 1px solid #f2f2f2">
                        <h5 class="p-4">Confirm your location</h5>
                    </div>
                    <div style="padding: 40px 50px">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">State
                                        *</label>
                                    <select name="state" class="form-select form-control" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " aria-label="Default select example" onchange="getdisrtict(this)">
                                        <option selected>select State</option>
                                        <?php foreach ($state as $key => $stateval) {

                                         ?>
                                        <option value="{{ $stateval->id }}">{{ $stateval->name }}</option>
                                        <?php } ?>
                                    </select>
                                    @error('state')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">City
                                        *</label>
                                    <select name="district" id="district_item" class="form-select form-control"
                                        aria-label="Default select example" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      ">
                                        <option selected>select district</option>
                                    </select>
                                    @error('district')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                             <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label" style="color: #000">Area
                                        *</label>
                                    <select class="form-select form-control" name="area" aria-label="Default select example" style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      ">
                                        <option selected>select Area</option>
                                        <?php foreach(get_areas() as $key => $value){ ?>
                                        <option value="<?= $value->id ?>"><?= $value->name ?></option>
                                        <?php } ?>
                                    </select>
                                     @error('area')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div> 
                            <div class="col-12 col-sm-6">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label" style="color: #000">Pin Code *
                                    </label>
                                    <input type="number" name="pincode" class="form-control" id="exampleInputPassword1"
                                        style="
                        height: 50px;
                        background: none;
                        border: 1px dotted #000;
                      " />
                                    @error('pincode')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>

                      <div style="border: 1px solid #f2f2f2">
                        <h5 class="p-4">Generate Special Offers – Add Discount Percentages Based on Stay Duration</h5>
                    </div>

                        <div style="padding: 25px 10px">
                            
                    <div class="card-body">
                     <div class="row ">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_7">Check-in and check-out within 0-7 days</label>
                                        <input type="number" name="offer_7" value="{{ old('offer_7') }}" class="form-control" id="offer_7"
                                            aria-describedby="offer_7Help">
                                            @error('offer_7')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        
                                    </div>
                                </div>


                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_15">Check-in and check-out within 7-15 days</label>
                                        <input type="number" name="offer_15" value="{{ old('offer_15') }}" class="form-control" id="offer_15"
                                            aria-describedby="offer_15Help">
                                            @error('offer_15')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="floating-label" for="offer_30">Check-in and check-out within 15-30 days & above</label>
                                        <input type="number" name="offer_30" value="{{ old('offer_30') }}" class="form-control" id="offer_30"
                                            aria-describedby="offer_30Help">
                                            @error('offer_30')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                    </div>    
                        </div>


                    <!-- details -->

                    <div style="border: 1px solid #f2f2f2">
                        <h5 class="p-4">Review your details</h5>
                    </div>
                    <div style="padding: 40px 50px">
                        <div class="d-flex align-center" style="gap: 50px">
                            <div>
                                <?php if(isset(Auth::user()->image)){ ?>
                                <img src="{{ url('') }}/uploads/{{ Auth::user()->image }}"
                                    alt="{{ Auth::user()->name }}" style="border-radius: 50%" width="80px"
                                    loading="lazy" />
                                <?php }else{ ?>
                                <img src="{{ url('') }}/defaultimages/userprofile.png" alt="user" loading="lazy"
                                    style="border-radius: 50%" width="80px" />
                                <?php } ?>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label" style="color: #000">Name *
                                </label>
                                <input type="text" class="form-control" id="exampleInputPassword1" disabled
                                    value=" <?= Auth::user()->name ? Auth::user()->name : "" ?>" style="
                      height: 50px;
                      background: none;
                      border: 1px dotted #000;
                    " />
                            </div>
                        </div>
                        <div class="mb-3 d-flex align-center" style="gap: 50px">
                            <div>
                                <h6>Your phone number</h6>
                            </div>
                            <div>
                                <h6>+91
                                    <?= Auth::user()->phone ? Auth::user()->phone : "XXXXXXXX00" ?>
                                </h6>
                            </div>
                        </div>
                    </div>

                    <!-- submit -->

                    <div style="border: 1px solid #f2f2f2; padding: 40px 50px">
                        <button type="submit" id="formSubmitButton" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End .error-content text-center -->
</main>
<!-- End .main -->

@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">


@endsection
@section('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>

<script src="{{ url('website') }}/assets/js/img-upload.js"></script>
<script>
    function getdisrtict(e){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
        $.ajax({
               type:'POST',
               url:'/getdisrtict',
               data:{'id':e.value},
               success:function(data) {
                //   $("#msg").html(data.msg);
                $('#district_item').html(data);
               }
            });
    }
</script>


<script>
    $(document).ready(function() {
        $('#summernote').summernote({
            placeholder: 'Start typing here...',
            tabsize: 2,
            height: 200,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                // ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['hr']]
            ],
            styleTags: ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']
        });
    });

document.getElementById("speed_item").addEventListener("change", function () {
    let value = this.value;

    if (value === "1") { // Single Speed selected
        // Hide or disable fields
        document.querySelectorAll(".speed_r_item").forEach(function (el) {
            el.style.display = "none";
        });

      

    } else if (value === "2") { // Multi Speed selected
        // Show fields
        document.querySelectorAll(".speed_r_item").forEach(function (el) {
            el.style.display = "block";
        });


    } else {
        // Default or empty selection
        document.querySelectorAll(".speed_r_item").forEach(function (el) {
            el.style.display = "none";
        });
       
    }
});



</script>
<script>
  const depositInput = document.getElementById("depositAmountField");
  const rentInput = document.getElementById("rentAmountField");
  const errorDiv = document.getElementById("alertShowError");
  const submitButton = document.getElementById("formSubmitButton");

  function validateAmounts() {
    const deposit = parseFloat(depositInput.value);
    const rent = parseFloat(rentInput.value);

    // If either field is empty or invalid, don't show error, allow typing and disable submit
    if (isNaN(deposit) || isNaN(rent)) {
      errorDiv.style.display = "none";
      submitButton.disabled = true;
      return;
    }

    if (deposit <= rent) {
      errorDiv.innerText = "Deposit amount must be greater than rent amount.";
      errorDiv.style.display = "block";
      submitButton.disabled = true;
    } else {
      errorDiv.style.display = "none";
      submitButton.disabled = false;
    }
  }

  depositInput.addEventListener("input", validateAmounts);
  rentInput.addEventListener("input", validateAmounts);

  // Initial state on page load
  window.addEventListener("load", validateAmounts);
</script>


@if (Auth::user()->role == "vendor")
<script>
document.addEventListener("DOMContentLoaded", function () {
    const qtyInput = document.getElementById("quantityInput");
    const errorDiv = document.getElementById("qtyError");
    const maxQty = {{ $remainingPosts ?? 0 }};

    qtyInput.addEventListener("input", function () {
        const entered = parseInt(this.value) || 0;
        if (entered > maxQty) {
            errorDiv.style.display = "block";
            errorDiv.textContent = `❌ You can only add up to ${maxQty} quantity as per your package limit.`;
            this.value = maxQty; // auto-correct to max
        } else {
            errorDiv.style.display = "none";
        }
    });
});
</script>
@endif


@endsection

@endsection