@section('title','Auditor - Dashboard')
@extends('auditor.common')
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

    .table thead th {
    color: #554;
    border-bottom-width: 1px;
    width: 50%;
}


.products_images img {
        margin-right: 10px;
        width: 70px;
        border: 1px solid #eee;
        padding: 6px;
        height: 70px;
        object-fit: contain;
    }
    .bouded_12 {
        width: 15px;
        height: 15px;
        display: inline-block;
        border-radius: 100%;
    }
</style>


<div class="main-panel">
    <div class="content">
        <div class="container-fluid">
            <h4 class="page-title">Cycle - {{ $row->title }}</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>View Provider/Vendor</th>
                                            <td><a href="/admin/view-vendor-providers/{{ $row->user_id }}">{{ $row->username
                                                    }}</a>
                                                <span class="small text-secondary"> ( Click on username to view full
                                                    details )</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Title</th>
                                            <td>{{ $row->title }}</td>
                                        </tr>

                                        <tr>
                                            <th>Model Name</th>
                                            <td>{{ $row->model_name }}</td>
                                        </tr>

                                        <tr>
                                            <th>Color</th>
                                            <td class="d-flex align-items-center">{{ $row->color }} <span class="bouded_12"
                                                    style="background-color:{{ $row->color }};margin-left:10px;"></span>
                                            </td>
                                        </tr>
                                        @if ($row->other_color)


                                        <tr>
                                            <th>Other color</th>
                                            <td class="d-flex align-items-center">{{ $row->other_color }} <span
                                                    class="bouded_12"
                                                    style="background-color:{{ $row->other_color }};margin-left:10px;"></span>
                                            </td>
                                        </tr>
                                        @endif

                                        <tr>
                                            <th>Size</th>
                                            <td>{{ $row->size }} Inch</td>
                                        </tr>

                                        <tr>
                                            <th>Deposit</th>
                                            <td class="text-success">Rs.{{ $row->price }}</td>
                                        </tr>

                                        <tr>
                                            <th>Rent</th>
                                            <td class="text-success">Rs.{{ $row->rent }} Per/day</td>
                                        </tr>

                                        <tr>
                                            <th>Frame Size</th>
                                            <td>{{ $row->frame_size }}</td>
                                        </tr>

                                        <tr>
                                            <th>Frame No.</th>
                                            <td>{{ $row->frame_no }}</td>
                                        </tr>

                                        <tr>
                                            <th>Frame Material</th>
                                            <td>{{ $row->frame_material }}</td>
                                        </tr>

                                        <tr>
                                            <th>Speed</th>
                                            <td>{{ $row->speed }}</td>
                                        </tr>

                                        <tr>
                                            <th>Fork</th>
                                            <td>{{ $row->fork }}</td>
                                        </tr>

                                        <tr>
                                            <th>Shifters</th>
                                            <td>{{ $row->shifters }}</td>
                                        </tr>

                                        <tr>
                                            <th>Front Gear</th>
                                            <td>{{ $row->front_gear }}</td>
                                        </tr>

                                        <tr>
                                            <th>Rear Gear</th>
                                            <td>{{ $row->rear_gear }}</td>
                                        </tr>

                                        <tr>
                                            <th>Front Derailleur</th>
                                            <td>{{ $row->front_derailleur }}</td>
                                        </tr>

                                        <tr>
                                            <th>Rear Derailleur</th>
                                            <td>{{ $row->rear_derailleur }}</td>
                                        </tr>

                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $row->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Brands</th>
                                            <td>{{ $row->brand_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Category</th>
                                            <td>{{ $row->category_name }}</td>
                                        </tr>

                                        <tr>
                                            <th>Images</th>
                                            <td class="products_images">
                                                <a href="{{ url('') }}/products/{{ $row->image1 }}">
                                                    <img src="{{ url('') }}/products/{{ $row->image1 }}" loading="lazy"
                                                        alt="">
                                                </a>
                                                <a href="{{ url('') }}/products/{{ $row->image2 }}">
                                                    <img src="{{ url('') }}/products/{{ $row->image2 }}" loading="lazy"
                                                        alt="">
                                                </a>
                                                <a href="{{ url('') }}/products/{{ $row->image3 }}">
                                                    <img src="{{ url('') }}/products/{{ $row->image3 }}" loading="lazy"
                                                        alt="">
                                                </a>
                                                <a href="{{ url('') }}/products/{{ $row->image4 }}">
                                                    <img src="{{ url('') }}/products/{{ $row->image4 }}" loading="lazy"
                                                        alt="">
                                                </a>

                                                <?php if(isset($row->image5)){ ?>
                                                <a href="{{ url('') }}/products/{{ $row->image5 }}">
                                                    <img src="{{ url('') }}/products/{{ $row->image5 }}" loading="lazy"
                                                        alt="">
                                                </a>
                                                <?php } ?>


                                                <?php if(isset($row->image6)){ ?>
                                                <a href="{{ url('') }}/products/{{ $row->image6 }}">
                                                    <img src="{{ url('') }}/products/{{ $row->image6 }}" loading="lazy"
                                                        alt="">
                                                </a>
                                                <?php } ?>



                                                <?php if(isset($row->image7)){ ?>
                                                <a href="{{ url('') }}/products/{{ $row->image7 }}">
                                                    <img src="{{ url('') }}/products/{{ $row->image7 }}" loading="lazy"
                                                        alt="">
                                                </a>

                                                <?php } ?>


                                                <?php if(isset($row->image8)){ ?>
                                                <a href="{{ url('') }}/products/{{ $row->image8 }}">
                                                    <img src="{{ url('') }}/products/{{ $row->image8 }}" loading="lazy"
                                                        alt="">
                                                </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>State</th>
                                            <td>{{ $row->statename }}</td>
                                        </tr>
                                        </tr>
                                        <tr>
                                            <th>District</th>
                                            <td>{{ $row->district_name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Pincode</th>
                                            <td>{{ $row->pincode }}</td>
                                        </tr>
                                        <tr>
                                            <th>Verify Status</th>
                                            <td>
                                                <?php if($row->verify_status == "panding"){ ?>
                                                <p class="bg-warning badge text-white mb-0">Panding</p>
                                                <?php }elseif($row->verify_status == "verified"){ ?>
                                                <p class="bg-success badge text-white mb-0">Verified</p>
                                                <?php }else{ ?>
                                                <p class="bg-danger badge text-white mb-0">Rejected</p>
                                                <?php } ?>
                                            </td>
                                        </tr>

                                    </thead>
                                    <tbody>

                                    </tbody>


                                </table>


                            </div>

                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>


@endsection
