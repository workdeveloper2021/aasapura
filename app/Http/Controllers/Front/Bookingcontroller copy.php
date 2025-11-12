<?php
namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Product;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;

use Razorpay\Api\Api;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;


class Bookingcontroller extends Controller
{
    
    public function cancelbookingid($bookingid){
        $userid = Auth::user()->id;
        $booking = Booking::where('id',$bookingid)->where('user_id',$userid)->first();
        
        
        $paymentId  = $booking->order_id; 
        $amount = $booking->paid_amount;
        $percent_amount = $amount/100*5;
        $finalamount = $amount - $percent_amount;
        
        $mainamount = $finalamount*100;
        
        // echo $finalamount;

        // dd($booking);
        
        
        // if(checkifrefunded($paymentId)->count == 0){
            
           
            
          
            // if(array_key_exists('error', createrefund($paymentId,$mainamount))){
            //   return redirect('/my-bookings')->with('error','Something went wrong.');
            // }else{
                
            
                // if(createrefund($paymentId,$mainamount)['status'] == "processed"){
                       if(isset($booking)){
            Booking::where('id',$bookingid)->where('user_id',$userid)->update([
                'booking_status_user' => 'cancelled',
                'booking_status' => 'decline_ride',
                'refund_status' => 'Y',
                'refund_details' => json_encode(createrefund($paymentId,$mainamount)),
               ]);
                 return redirect('/my-bookings')->with('success','Cancelled Success and your refund amount will come to your account soon.');
                
        }else{
            return redirect('/my-bookings')->with('error','Booking not found');
        }
                // }
                
                // else{
                //     return redirect('/my-bookings')->with('error','Something went wrong');
                // }
            // }
            
        // }else{
        //     return redirect()->back()->with('error','Your refund has already been processed');
        // }

      
    }

public function cancelbooking($bookingid){
      $userid = Auth::user()->id;
        $booking = Booking::where('id',$bookingid)->where('seller_id',$userid)->first();
        // echo $userid;
        // print_r($booking);
        // die;
        
        if(isset($booking)){
            Booking::where('id',$bookingid)->where('seller_id',$userid)->update([
                'booking_status_user' => 'cancelled',
                'owner_status' => 'reject',
                'booking_status' => 'decline_ride'
                ]);
                 return redirect('/my-orders')->with('success','Cancelled Success.');
                
        }else{
            return redirect('/my-orders')->with('error','Order not found');
        }
}



public function acceptcheckout($bookid){
        $userid = Auth::user()->id;
        $booking = Booking::where('id',$bookid)->where('seller_id',$userid)->first();
        // echo $userid;
        // print_r($booking);
        // die;
        

        $product = Product::findorfail($booking->product_id);

       


                 $checkIn = Carbon::createFromFormat('Y-m-d', $booking->check_in);
                $checkOut = Carbon::createFromFormat('Y-m-d', $booking->check_out);
                $daysUsed = $checkIn->diffInDays($checkOut);
                
                $product->service_days_count += $daysUsed;

        if(isset($booking)){
            
        $Vuser= User::findorfail($booking->user_id);


          $transaction = WalletTransaction::where('booking_id', $booking->id)
                                        ->where('user_id', $Vuser->id)
                                        ->where('type', 'checkout_remain_refund')
                                        ->where('status', 'pending')
                                        ->first();

       

        if ($transaction) {
            $Vuser->wallet += $transaction->amount;
            $Vuser->save();
            $transaction->status = 'completed';
            $transaction->save();
        }
            Booking::where('id',$bookid)->where('seller_id',$userid)->update([
                'checkout_status' => 'accept',
                'booking_status' => 'complete'
                ]);
                $product->save();
                 return redirect('/my-orders')->with('success','Checkout Accepted.');
                
        }else{
            return redirect('/my-orders')->with('error','Order not found');
        }
}

public function cancelcheckout($bookid){
    $userid = Auth::user()->id;
        $booking = Booking::where('id',$bookid)->where('seller_id',$userid)->first();
        // echo $userid;
        // print_r($booking);
        // die;
        
        if(isset($booking)){
            Booking::where('id',$bookid)->where('seller_id',$userid)->update([
                'checkout_status' => 'reject',
                'booking_status' => 'decline_ride'
                ]);
                 return redirect('/my-orders')->with('success','Checkout Rejected.');
                
        }else{
            return redirect('/my-orders')->with('error','Order not found');
        }
}


public function acceptbooking(Request $request){
    
    // print_r($request->all());
    // die;
    
    
      $request->validate([
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
     $userid = Auth::user()->id;
        $booking = Booking::where('id',$request->bookingid)->where('seller_id',$userid)->first();
        
        if(isset($booking)){
            
            $uploadedImages = $request->file('images');

        foreach ($uploadedImages as $image) {
             $path = time() . '_' . $image->getClientOriginalName();
             $image->move('orderaccept', $path);
             $imagePaths[] = $path; 
        }
        
            Booking::where('id',$request->bookingid)->where('seller_id',$userid)->update([
                'booking_status_user' => 'running',
                'owner_status' => 'accept',
                'booking_status' => 'running',
                'owner_accept_images' => json_encode($imagePaths)
                ]);

        // Add service days counting code here (adapted to use $request->bookingid instead of $bookingId)
        $bookingObj = Booking::find($request->bookingid);
        if ($bookingObj) {
            $product = Product::find($bookingObj->product_id);
            if ($product) {
                // Calculate the number of days for this booking
                // $checkIn = Carbon::createFromFormat('Y-m-d', $bookingObj->check_in);
                // $checkOut = Carbon::createFromFormat('Y-m-d', $bookingObj->check_out);
                // $daysUsed = $checkIn->diffInDays($checkOut);
                
                // // Add to the service days count
                // $product->service_days_count += $daysUsed;
                $product->save();
            }
        }


                 return redirect('/my-orders')->with('success','Booking Confirmed, Thank You..');
                
        }else{
            return redirect('/my-orders')->with('error','Order not found');
        }
    
}

    public function book_items(Request $request,$product_id){
        if ($request->method() == "POST") {
            
            $credentials = $request->validate([
                'check_in' => 'required',
                'check_out' => 'required',
            ]);

        $checkInDate = $request->input('check_in');  // e.g. '07/10/2024'
        $checkOutDate = $request->input('check_out'); // e.g. '01/10/2024'
        // Parse the dates
        $checkIn = \DateTime::createFromFormat('d/m/Y', $checkInDate);
        $checkOut = \DateTime::createFromFormat('d/m/Y', $checkOutDate);
        // Compare the dates
        if ($checkOut <= $checkIn) {
            return redirect()->back()->with('error','The checkout date must be after the check-in date.');
        }
        
            if(bookornotbook($product_id) == "Booked"){
                return redirect()->back()->with('error','Can not proceed.');
            }
     
            
            if(Auth::user()->details_verify == "N"){
                return redirect('/my-setting')->with('error','Please update your account details');
            }

            $productfind = Product::where('id',$product_id)->first();
            if (isset($productfind)){
                session()->forget('booking_submit_items');
                // print_r($request->session()->get('booking_submit_items'));
                // die;
                $book_data = [
                    'user_id' => Auth::user()->id,
                    'product_id' => $product_id,
                    'check_in' => $request->check_in,
                    'check_out' => $request->check_out,
                ];
                session()->put('booking_submit_items', $book_data);
                return redirect('/book-cycle');
            }else{
                return redirect()->back()->with('error','Invalid Entry');
            }
        }
    }

    // public function bookcycle(Request $request){
    //         if(Auth::user()->details_verify == "N"){
    //             return redirect('/my-setting')->with('error','Please update your account details');
    //         }
    //     // session()->forget('booking_submit_items');

    //     $data = session()->get('booking_submit_items');
    //     if (isset($data) && !empty($data)){
           
    //         // Array ( [user_id] => 29655 [product_id] => 10 [check_in] => 2024-09-10 [check_out] => 2024-09-14 ) 29655

    //         $product = Product::where('id',$data['product_id'])->first();
           
    //         $booking = [
    //             'user_id' => $data['user_id'],
    //             'product_id' => $data['product_id'],
    //             'check_in' => $data['check_in'],
    //             'check_out' => $data['check_out'],
    //         ];
            
    //          $discountPercantage = session('discount', 0) ?? 0;




    //         $checkIn = Carbon::createFromFormat('d/m/Y', $booking['check_in']);
    // $checkOut = Carbon::createFromFormat('d/m/Y', $booking['check_out']);
    // $days = $checkIn->diffInDays($checkOut);

    // $rentPerDay = $product->rent;
    // $totalRent = $days * $rentPerDay;

    // // Discounted rent (checkout pe pay karna hai)
    // $afterDiscount = $totalRent * (1 - ($discountPercantage / 100));

    // // Abhi ke liye payable = Deposit + Extra charge (agar rent >= deposit)
    // $deposit = $product->price;
    // $extraCharge = ($afterDiscount >= $deposit) ? 2000 : 0;
    // $nowPayable = $deposit + $extraCharge;
          

    //         if ($request->method() == "POST") {
    //             $credentials = $request->validate([
    //                 // 'name' => ['required'],
    //                 // 'address_1' => ['required'],
    //                 // 'address_2' => ['required'],
    //                 // 'pincode' => ['required','numeric'],
    //                 // 'phone' => ['required','numeric'],
    //                 // 'check_in_image' => 'required|mimes:jpeg,png,jpg,svg,webp',
    //             ]);

    //             $createorder = create_razorpay_order($nowPayable*100,rand());
    //             if ($createorder->status == "created") {
    //           $booking = [
    //             'order_id' =>$createorder->id,
    //             'user_id' => $data['user_id'],
    //             'product_id' => $data['product_id'],
    //             'seller_id' => $product->user_id,
    //             'check_in' => $data['check_in'],
    //             'check_out' => $data['check_out'],
    //             // 'check_in_image' =>  imagegetnameandupload($request->check_in_image),
    //             'phone' =>  Auth::user()->phone,
    //             'name' =>  Auth::user()->name,
    //             'address_1' =>  Auth::user()->address_1,
    //             'address_2' =>  Auth::user()->address_2,
    //             'pincode' =>  Auth::user()->pincode,
    //             'discount' =>  session('discount', 0) ?? 0,
    //             'securityamount' =>  $nowPayable ?? 0,
    //             'verify' =>  'N',
    //             'payment_verify' =>  'N',
    //           ];
    //                 session()->put('booking_data', $booking);
    //                 return redirect('/pay-items-amount');
    //             }
    //         }

    //         if (isset($product)) {
               
    //             return view('front.booking.bookcycle',compact('product','booking','discountPercantage'));
    //         }else{
    //             return redirect('/')->with('error','Item not found please select cycle for rent');
    //         }
    //     }else{
    //         return redirect('/')->with('error','Select Cylcle for rent');
    //     }



    // }
    
    
//     public function bookcycle(Request $request)
// {
//     if (Auth::user()->details_verify === 'N') {
//         return redirect('/my-setting')->with('error', 'Please update your account details');
//     }

//     $data = session('booking_submit_items');
//     if (empty($data)) {
//         return redirect('/')->with('error', 'Select Cycle for rent');
//     }

//     $product = Product::findOrFail($data['product_id']);

//     // ---------------- Date & Days ----------------
//     $checkIn  = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_in']);
//     $checkOut = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_out']);
//     $days     = $checkIn->diffInDays($checkOut);

//     // ---------------- Rent & Discount Logic (same as check_offer) ----------------
//     $perDayRent   = $product->rent;
//     $totalRent    = $days * $perDayRent;
//     $discount     = 0;

//     if ($days >= 0 && $days <= 7) {
//         $discount = $product->offer_7 ?? 0;
//     } elseif ($days >= 8 && $days <= 15) {
//         $discount = $product->offer_15 ?? 0;
//     } elseif ($days >= 16) {
//         $discount = $product->offer_30 ?? 0;
//     }

//     $discountedRent  = $totalRent * (1 - ($discount / 100));
//     $discountAmount  = $totalRent - $discountedRent;
//     $deposit         = $product->price;

//     // ---------------- Money-Flow ----------------
//     $extraCharge       = 0;
//     $payNow            = 0;
//     $refundAtCheckout  = 0;

//     if ($discountedRent <= $deposit) {
//         // Case-1
//         $payNow           = $deposit;
//         $refundAtCheckout = $deposit - $discountedRent;
//     } else {
//         // Case-2
//         $extraCharge      = 2000;
//         $payNow           = $discountedRent + $extraCharge;
//         $refundAtCheckout = $extraCharge;
//     }

//     // ---------------- Save to Session ----------------
//     session([
//         'discount'            => $discount,
//         'discount_amount'     => $discountAmount,
//         'discounted_rent'     => $discountedRent,
//         'total_rent'          => $totalRent,
//         'deposit'             => $deposit,
//         'extra_charge'        => $extraCharge,
//         'pay_now'             => $payNow,
//         'refund_at_checkout'  => $refundAtCheckout,
//         'rent_days'           => $days,
//     ]);

//     if ($request->isMethod('post')) {
//         $createorder = create_razorpay_order($payNow * 100, rand());
//         if ($createorder->status === 'created') {
//             $booking = [
//                 'order_id'       => $createorder->id,
//                 'user_id'        => $data['user_id'],
//                 'product_id'     => $data['product_id'],
//                 'seller_id'      => $product->user_id,
//                 'check_in'       => $data['check_in'],
//                 'check_out'      => $data['check_out'],
//                 'phone'          => Auth::user()->phone,
//                 'name'           => Auth::user()->name,
//                 'address_1'      => Auth::user()->address_1,
//                 'address_2'      => Auth::user()->address_2,
//                 'pincode'        => Auth::user()->pincode,
//                 'discount'       => $discount,
//                 'securityamount' => $payNow,
//                 'verify'         => 'N',
//                 'payment_verify' => 'N',
//             ];
//             session()->put('booking_data', $booking);
//             return redirect('/pay-items-amount');
//         }
//     }

//     return view('front.booking.bookcycle', [
//         'product'   => $product,
//         'booking'   => $data,
//         'days'      => $days,
//         'discount'  => $discount,
//         'totalRent' => $totalRent,
//         'discountAmount'    => $discountAmount,
//         'discountedRent'    => $discountedRent,
//         'deposit'   => $deposit,
//         'extraCharge'       => $extraCharge,
//         'payNow'    => $payNow,
//         'refundAtCheckout'  => $refundAtCheckout,
//     ]);
// }




public function bookcycle(Request $request)
{
    if (Auth::user()->details_verify === 'N') {
        return redirect('/my-setting')->with('error', 'Please update your account details');
    }

    $data = session('booking_submit_items');
    if (empty($data)) {
        return redirect('/')->with('error', 'Select Cycle for rent');
    }

    $product = Product::findOrFail($data['product_id']);

    // ---------------- Date & Days ----------------
    $checkIn  = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_in']);
    $checkOut = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_out']);
    $days     = $checkIn->diffInDays($checkOut);

    // ---------------- Rent & Discount Logic ----------------
    $perDayRent   = $product->rent;
    $totalRent    = $days * $perDayRent;
    $discount     = 0;

    if ($days >= 0 && $days <= 7) {
        $discount = $product->offer_7 ?? 0;
    } elseif ($days >= 8 && $days <= 15) {
        $discount = $product->offer_15 ?? 0;
    } elseif ($days >= 16) {
        $discount = $product->offer_30 ?? 0;
    }

    $discountedRent  = $totalRent * (1 - ($discount / 100));
    $discountAmount  = $totalRent - $discountedRent;
    $deposit         = $product->price;

    // ---------------- Money-Flow Logic (same as check_offer) ----------------
    $extraCharge       = 0;
    $payNow            = 0;
    $refundAtCheckout  = 0;

    $difference = $deposit - $discountedRent;

    if ($difference >= 0 && $difference <= 2000) {
        // Special Case: rent close to deposit (gap ≤ 2000)
        $extraCharge       = 2000;
        $payNow            = $deposit + $extraCharge;
        $refundAtCheckout  = $difference + $extraCharge; // (deposit - rent + 2000)
    } elseif ($discountedRent < $deposit) {
        // Rent kam hai deposit se
        $payNow            = $deposit;
        $refundAtCheckout  = $deposit - $discountedRent;
    } else {
        // Rent jyada hai deposit se
        $extraCharge       = 2000;
        $payNow            = $discountedRent + $extraCharge;
        $refundAtCheckout  = $extraCharge;
    }

    // ---------------- Save to Session ----------------
    session([
        'discount'            => $discount,
        'discount_amount'     => $discountAmount,
        'discounted_rent'     => $discountedRent,
        'total_rent'          => $totalRent,
        'deposit'             => $deposit,
        'extra_charge'        => $extraCharge,
        'pay_now'             => $payNow,
        'refund_at_checkout'  => $refundAtCheckout,
        'rent_days'           => $days,
    ]);

    if ($request->isMethod('post')) {
        $createorder = create_razorpay_order($payNow * 100, rand());
        // $createorder2 = create_hdfc_order($payNow, rand());
        

    //   echo "<pre>";
    //   print_r($createorder);
    //   die;


        if ($createorder->status === 'created') {

        // if (isset($createorder2['status']) && $createorder2['status'] === 'NEW') {

            $booking = [
               'order_id'       => $createorder->id,
                // 'order_id'       => $createorder2['id'],
                // 'getwayOrderId'       => $createorder2['order_id'],
                'user_id'        => $data['user_id'],
                'product_id'     => $data['product_id'],
                'seller_id'      => $product->user_id,
                'check_in'       => $data['check_in'],
                'check_out'      => $data['check_out'],
                'phone'          => Auth::user()->phone,
                'name'           => Auth::user()->name,
                'address_1'      => Auth::user()->address_1,
                'address_2'      => Auth::user()->address_2,
                'pincode'        => Auth::user()->pincode,
                'discount'       => $discount,
                'securityamount' => $payNow,
                'verify'         => 'N',
                'payment_verify' => 'N',
                // 'sdk_payload' => json_encode($createorder2['sdk_payload'])
            ];
            session()->put('booking_data', $booking);
            // return redirect($createorder2['payment_links']['web']);
             return redirect('/pay-items-amount');
        }
    }


    return view('front.booking.bookcycle', [
        'product'          => $product,
        'booking'          => $data,
        'days'             => $days,
        'discount'         => $discount,
        'totalRent'        => $totalRent,
        'discountAmount'   => $discountAmount,
        'discountedRent'   => $discountedRent,
        'deposit'          => $deposit,
        'extraCharge'      => $extraCharge,
        'payNow'           => $payNow,
        'refundAtCheckout' => $refundAtCheckout,
    ]);
}


    public function payitemsamount(){

        $data = session()->get('booking_data');
        if (isset($data) && !empty($data)){
            print_r($data);
            die;
            return view('front.booking.payitemsamount',compact('data'));
        }else{
            return redirect('/');
        }

    }

    // public function verifypayment(Request $request){

    //     $data = session()->get('booking_data');
    //     if (isset($data) && !empty($data)){

    //         $razorpay_payment_id = $request->razorpay_payment_id;
    //         $razorpay_order_id = $request->razorpay_order_id;
    //         $razorpay_signature = $request->razorpay_signature;

    //         // echo $razorpay_order_id;

    //     $api = new Api('rzp_test_QnDKE8IS9ia1FB', 'eWBOWYbhq3dhFfZi7czd2GS0');

    //         $verify = $api->payment->fetch($request->razorpay_payment_id);

    //       if ($verify->status == "captured" && $verify->captured == 1) {
    //         $booking  = new Booking;
    //         $booking->name = $data['name'];
    //         $booking->order_id = $request->razorpay_payment_id;
    //         $booking->product_id = $data['product_id'];
    //         $booking->seller_id = $data['seller_id'];
    //         $booking->user_id = $data['user_id'];
    //         $booking->discount = $data['discount'];
    //         $booking->securityamount = $data['securityamount'] ?? 0;

    //       $date = Carbon::createFromFormat('d/m/Y', $data['check_in']);
    //         $checkin = $date->format('Y-m-d');
           
    //       $out = Carbon::createFromFormat('d/m/Y', $data['check_out']);
    //         $checkout = $out->format('Y-m-d');
            
         
            
    //         $booking->check_in = $checkin;
    //         $booking->check_out = $checkout;
    //         // $booking->check_out = $data['check_out'];
    //         // $booking->check_in_image = $data['check_in_image'];
    //         $booking->phone = $data['phone'];
    //         $booking->address_1 = $data['address_1'];
    //         $booking->address_2 = $data['address_2'];
    //         $booking->pincode = $data['pincode'];
    //         $booking->verify = 'Y';
    //         $booking->payment_verify = 'Y';
    //         $booking->paid_amount = $verify->amount/100;
    //         $booking->save();
    //         session()->forget('booking_submit_items');
    //         session()->forget('booking_data');
    //         session()->forget('discount');
    //         return redirect('/')->with('success','Order Created Successfully');
    //       }else{
    //         return redirect('/book-cycle')->with('error','Payment Failed');
    //       }

    //     }else{
    //         return redirect('/');
    //     }

    // }
    
    
    
    public function verifypayment(Request $request)
{
    $data = session()->get('booking_data');
    if (empty($data)) {
        return redirect('/');
    }

    // echo "<pre>";
    // print_r($request->all());
    //  $signature_algorithm = $request->signature_algorithm;
    //  $status_id = $request->status_id;
    //  $signature = $request->signature;
    //  $order_id = $request->order_id;

    //  $verifyOrder = verifyHdfcOrder($order_id, $signature_algorithm, $status_id, $signature);

    //  print_r($verifyOrder);
    // echo die;

    $razorpay_payment_id = $request->razorpay_payment_id;
    $razorpay_order_id   = $request->razorpay_order_id;
    $razorpay_signature  = $request->razorpay_signature;

    // Razorpay API (same as before)
    $api = new \Razorpay\Api\Api('rzp_test_QnDKE8IS9ia1FB', 'eWBOWYbhq3dhFfZi7czd2GS0');

    // fetch payment details from Razorpay
    $verify = $api->payment->fetch($razorpay_payment_id);

    if ($verify->status === "captured" && (int) $verify->captured === 1) {
        $booking = new Booking;

        // basic details (kept same)
        $booking->name       = $data['name'] ?? null;

        // IMPORTANT: save original razorpay order id (the one created earlier)
        // session 'booking_data' had 'order_id' => createorder->id
        $booking->order_id = $data['order_id'] ?? $razorpay_order_id ?? null;

        // optional: save payment/order/signature IDs only if columns exist (avoids DB errors)
        if (\Schema::hasColumn('bookings', 'razorpay_payment_id')) {
            $booking->razorpay_payment_id = $razorpay_payment_id;
        } elseif (\Schema::hasColumn('bookings', 'payment_id')) {
            // common alternative column name
            $booking->payment_id = $razorpay_payment_id;
        }

        if (\Schema::hasColumn('bookings', 'razorpay_order_id')) {
            $booking->razorpay_order_id = $razorpay_order_id;
        }

        if (\Schema::hasColumn('bookings', 'razorpay_signature')) {
            $booking->razorpay_signature = $razorpay_signature;
        }

        // product / user info
        $booking->product_id = $data['product_id'];
        $booking->seller_id  = $data['seller_id'];
        $booking->user_id    = $data['user_id'];
        $booking->discount   = $data['discount'] ?? 0;

        // SECURITY AMOUNT: store exactly what we expected user to pay now (from session)
        $booking->securityamount = isset($data['securityamount']) 
            ? round((float) $data['securityamount'], 2) 
            : 0.00;

        // Dates: keep same formatting as before
        $date    = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_in']);
        $checkin = $date->format('Y-m-d');

        $out     = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_out']);
        $checkout= $out->format('Y-m-d');

        $booking->check_in  = $checkin;
        $booking->check_out = $checkout;

        // other user fields (same)
        $booking->phone     = $data['phone'] ?? null;
        $booking->address_1 = $data['address_1'] ?? null;
        $booking->address_2 = $data['address_2'] ?? null;
        $booking->pincode   = $data['pincode'] ?? null;

        $booking->verify         = 'Y';
        $booking->quantity       =  1;
        $booking->payment_verify = 'Y';

        // PAID AMOUNT: real captured amount from Razorpay (paise -> rupees), rounded
        $booking->paid_amount = round(((float) $verify->amount) / 100, 2);

        // Save booking
        $booking->save();

        // Clear sessions same as before
        session()->forget('booking_submit_items');
        session()->forget('booking_data');
        session()->forget('discount');

        return redirect('/')->with('success','Order Created Successfully');
    } else {
        return redirect('/book-cycle')->with('error','Payment Failed');
    }
}

    
    public function mybookings(){
        $user_id = Auth::user()->id;
        
        $booking = Booking::with(['product.reviews'])->where('user_id',$user_id)->orderBy('id','desc')->get();
 

        return view('front/bookings',compact('booking'));
    }
    
    public function updatecheckoutdetails(Request $request){
        
         $credentials = $request->validate([
                    'booking' => ['required','numeric'],
                    'checkout_date' => ['required'],
                    'check_out_image' => 'required|max:1024',
                ]);
                
                $user_id = Auth::user()->id;
                
              $findbooking =  Booking::where('user_id',$user_id)->where('id',$request->booking)->first();
              
              if(isset($findbooking)){
                  $bookingedit = Booking::find($request->booking);
                  
                   if($bookingedit->checkout_status == "accept" || $bookingedit->checkout_status == "reject"){
                      return redirect()->back()->with('error','Already Updated');  
                   }else{
                  $bookingedit->check_out = $request->checkout_date;
                  
                  $bookingedit->checkout_status = 'applied';
                  if($request->check_out_image){
                  $bookingedit->checkout_image = updateimagedy($request->check_out_image,$bookingedit,'checkout_image');
                  }
                $bookingedit->save();
                return redirect()->back()->with('success','Successfully Updated');
                   }
              }else{
               return redirect()->back()->with('error','Item Not Found !');   
              }  
    }
    
    public function bookingview(Request $request){
        
          $user_id = Auth::user()->id;
         $findbooking =  Booking::where('user_id',$user_id)->where('id',$request->booking)->first();
         if(isset($findbooking)){
                 return view('front/booking/viewbooking',compact('findbooking'));
                  
              }else{
               return response()->json(['status' => 'error', 'message' => 'Item Not Found !']);
              }  
    }


    public function calculateCheckoutPayment(Request $request)
    {
        $request->validate([
            'booking' => ['required', 'numeric'],
            'checkout_date' => ['required'],
            'check_out_image' => 'required|max:1024',
            'check_in_date' => 'required',
            'product_id' => 'required|numeric',
        ]);
        
        $userId = Auth::user()->id;
        $booking = Booking::where('id', $request->booking)->where('user_id', $userId)->first();
        
        if (!isset($booking)) {
            return redirect()->back()->with('error', 'Booking not found');
        }
        
        if ($booking->checkout_status == "accept" || $booking->checkout_status == "reject") {
            return redirect()->back()->with('error', 'Already updated');
        }
        
        // Calculate days
        $checkInDate = Carbon::parse($request->check_in_date);
        $checkOutDate = Carbon::parse($request->checkout_date);
        $days = $checkInDate->diffInDays($checkOutDate);
        

        // Get product to calculate rent
        $product = Product::findOrFail($request->product_id);
        $totalRent = $days * $product->rent; // Calculate total rent
        
        // Process the file first
        $imagePath = null;
        if ($request->hasFile('check_out_image')) {
            $file = $request->file('check_out_image');
            $path = time() . '_' . $file->getClientOriginalName();
            $file->move('checkout_images', $path);
            $imagePath = $path;
        }
        
        // Store checkout data in session (without the file object)
        $checkoutData = [
            'booking_id' => $request->booking,
            'checkout_date' => $request->checkout_date,
            'image_path' => $imagePath, // Store only the path, not the file object
            'total_rent' => $totalRent,
            'days' => $days,
            'product_id' => $request->product_id
        ];
        
        $booking = Booking::find($request->booking);
    $discountPercantage = $booking->discount ?? 0;
    

         $product = Product::find($request->product_id);
          $depositAmount = $product->price;
    $rentPerDay = $product->rent; 

        $totalRent = $checkoutData['total_rent'];
    $totalAmount = $totalRent;

      $afterDiscount = $totalAmount * (1 - ($discountPercantage / 100)) ?? 0;
    // $finalamount = $afterDiscount - $product->price;
    $finalamount = $afterDiscount;
        
        session()->put('checkout_data', $checkoutData);
        
          $totalAmount = $finalamount;
        $remail = $totalAmount - $booking->paid_amount;
       
        $remainAmount = $remail == 0 ? 1 : $remail ; 
     
        // Create Razorpay order
        $createorder = create_razorpay_order($remainAmount*100, rand());

session()->put([
    'checkout_order_id' => $createorder->id ?? 0,
    'remainamountTouSER' => $remainAmount ?? 0,
]);
        
        // Redirect to payment page
        return redirect('/checkout-payment');
    }
    

public function checkoutPayment()
{
    $checkoutData = session()->get('checkout_data');
    $orderId = session()->get('checkout_order_id');
    
    if (!isset($checkoutData) || !isset($orderId)) {
        return redirect('/my-bookings')->with('error', 'Invalid request');
    }


    $product_id  = $checkoutData['product_id'];
    $product = Product::find($product_id);

    $booking = Booking::find($checkoutData['booking_id']);
    $discountPercantage = $booking->discount ?? 0;
   
    $depositAmount = $product->price;
    $rentPerDay = $product->rent; 

    $totalRent = $checkoutData['total_rent'];
    $totalAmount = $totalRent;


      
    $afterDiscount = $totalAmount * (1 - ($discountPercantage / 100)) ?? 0;
    
    $finalamount = $afterDiscount;
    
     $afterDiscount - $product->price;


    return view('front.booking.checkout_payment', compact('checkoutData', 'orderId','finalamount','booking','product'));
}

public function continuetocheckoutwithoutGt(Request $request) {
      $checkoutData = session()->get('checkout_data');
    $orderId = session()->get('checkout_order_id');
    


    if (!isset($checkoutData) || !isset($orderId)) {
        return redirect('/my-bookings')->with('error', 'Invalid request');
    }


     $product_id  = $checkoutData['product_id'];
    $product = Product::find($product_id);

    $booking = Booking::find($checkoutData['booking_id']);
    $discountPercantage = $booking->discount ?? 0;
   
    $depositAmount = $product->price;
    $rentPerDay = $product->rent; 

    $totalRent = $checkoutData['total_rent'];
    $totalAmount = $totalRent;

    $afterDiscount = $totalAmount * (1 - ($discountPercantage / 100)) ?? 0;
    $finalamount = $afterDiscount;

     $totalAmount = $finalamount;
     
     
    $remainAmount = $totalAmount - $booking->paid_amount;
    
    
    
    $returnamountfinal = $remainAmount;

     $booking = Booking::find($checkoutData['booking_id']);


  if ($returnamountfinal > 0) {
    // User still needs to pay — maybe show an error or skip wallet update
} else {
    $remainAmount = abs($returnamountfinal ?? 0); // Use request's value directly
    $user = User::findOrFail($booking->user_id);

    // // Add amount to wallet
    // $user->wallet += $remainAmount;
    // $user->save();

     WalletTransaction::updateOrCreate(
    [
        'booking_id' => $booking->id,
        'user_id' => $user->id,
        'type' => 'checkout_remain_refund', // condition for match
    ],
    [
        'amount' => $remainAmount,
        'mode' => 'credit',
        'status' => 'pending',
        'reason' => 'Refund of remaining amount at checkout for booking #' . $booking->id,
    ]
);
}
        $booking->check_out = $checkoutData['checkout_date'];
        $booking->checkout_status = 'applied';
        $booking->checkout_image = $checkoutData['image_path'];
        $booking->checkout_payment_id = rand();
        $booking->checkout_amount = $request->remainamt ?? 0;
        $booking->save();
        
        // Clear session data
        session()->forget('checkout_data');
        session()->forget('checkout_order_id');
        
        return redirect('/my-bookings')->with('success', 'Refund added to user wallet successfully.');
        
}


public function verifyCheckoutPayment(Request $request)
{
    $checkoutData = session()->get('checkout_data');
    $orderId = session()->get('checkout_order_id');
    
    if (!isset($checkoutData) || !isset($orderId)) {
        return redirect('/my-bookings')->with('error', 'Invalid request');
    }
    
    $razorpay_payment_id = $request->razorpay_payment_id;
    
    // Verify payment
    $api = new Api('rzp_test_QnDKE8IS9ia1FB', 'eWBOWYbhq3dhFfZi7czd2GS0');
    $verify = $api->payment->fetch($razorpay_payment_id);
    
    if ($verify->status == "captured" && $verify->captured == 1) {
        // Update booking with checkout details
        $booking = Booking::find($checkoutData['booking_id']);
        $booking->check_out = $checkoutData['checkout_date'];
        $booking->checkout_status = 'applied';
        $booking->checkout_image = $checkoutData['image_path'];
        $booking->checkout_payment_id = $razorpay_payment_id;
        $booking->checkout_amount = $verify->amount/100;
        $booking->save();
        
        // Clear session data
        session()->forget('checkout_data');
        session()->forget('checkout_order_id');
        
        return redirect('/my-bookings')->with('success', 'Checkout successful. Payment completed.');
    } else {
        return redirect('/my-bookings')->with('error', 'Payment failed');
    }
}



}