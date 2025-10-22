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
                                <?php if($findbooking->owner_status == "accept"){ ?>
                                <tr>
                                    <th scope="col">Your Accept time images</th>
                                    <th scope="col">
                                      <?php
                                      
                                      $images =  json_decode($findbooking->owner_accept_images);
                                        
                                      
                                      ?>
                                      
                                      <div class="images_inr row px-2">
                                          <?php foreach($images as $val){ ?>
                                          <div class="col-6 mb-3">
                                              <a href="{{url('')}}/orderaccept/{{$val}}">
                                                  <img src="{{url('')}}/orderaccept/{{$val}}" class="w-100">
                                              </a>
                                          </div>
                                          <?php } ?>
                                      </div>
                                      
                                    </th>
                                </tr>
                                <?php } ?>
                            </thead>
                        </table>