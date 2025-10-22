<form id="bookform" action="/book-items/{{ $product->id }}" method="post">
                                @csrf
                                <div class="shadow-lg p-3 rounded" style="border: 1px dotted #000">
                                    <div class="mb-3 p-4" style="border-bottom: 1px dotted #000">
                                        <h5 class="font-weight-bold text-primary">
                                            ₹{{ $product->rent }} /- <sub>per day</sub>
                                        </h5>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Check In</label>
                                        <input type="text" name="check_in" id="datepicker"  class="form-control checkin_date"  value="{{ request('checkin') ? \Carbon\Carbon::parse(request('checkin'))->format('d/m/Y') : '' }}"/>
                                        @error('check_in')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Check Out</label>
                                        <input type="text" name="check_out" value="{{ request('checkout') ? \Carbon\Carbon::parse(request('checkout'))->format('d/m/Y') : '' }}"  id="datepicker2" class="form-control checkout_date"/>
                                        @error('check_out')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div id="discount-offer" class="mt-2 text-success fw-bold"></div>
                                    <div id="offer-message"></div>

                                    <button class="btn btn-primary w-100" id="bookingAmountvvv">Book Rs.{{ $product->price }}</button>
                                </div>
                            </form>