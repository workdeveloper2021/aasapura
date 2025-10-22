@php
    use Carbon\Carbon;
@endphp

<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">{{$findbooking->name}}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Address 1</th>
                                    <th scope="col">{{$findbooking->address_1}}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Address 2</th>
                                    <th scope="col">{{$findbooking->address_2}}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Pincode</th>
                                    <th scope="col">{{$findbooking->pincode}}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Phone</th>
                                    <th scope="col">{{$findbooking->phone}}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Check In</th>
                                    <th scope="col">{{Carbon::parse($findbooking->check_in)->format('d-m-Y')}}</th>
                                </tr>
                                <tr>
                                    <th scope="col">Check Out</th>
                                    <th scope="col">{{Carbon::parse($findbooking->check_out)->format('d-m-Y')}}</th>
                                </tr>
                                {{-- <tr>
                                    <th scope="col">Check In Pic</th>
                                    <th scope="col">
                                        <?php if(isset($findbooking->check_in_image)){ ?>
                                        <img loading="lazy"  src="{{url('')}}/products/{{$findbooking->check_in_image}}"
                                            style="width: 80px; height: 80px" />
                                            <?php } ?>
                                    </th>
                                </tr> --}}
                                <tr>
                                    <th scope="col">Deposite</th>
                                    <th scope="col">
                                        <p>Rs.{{$findbooking->paid_amount}}</p>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col">Status</th>
                                    <th scope="col">
                                        <span class="badge px-5"
                                            style="color: #fff; background-color: #2845a7">Booked</span>
                                    </th>
                                </tr>
                                <tr>
                                    <th scope="col">Check Out Pic</th>
                                    <th scope="col">
                                       <?php if(isset($findbooking->checkout_image)){ ?>
                                        <img src="{{url('')}}/uploads/{{$findbooking->checkout_image}}" loading="lazy" 
                                            style="width: 80px; height: 80px" />
                                            <?php } ?>
                                    </th>
                                </tr>
                            </thead>
                        </table>