<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Product;
use App\Models\CustomerRating

;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Ordercontroller extends Controller
{
    public function myorders(){
        if(Auth::check()){
            $seller_id  = Auth::user()->id;
            $my_orders = Booking::with('product')->where('seller_id',$seller_id)->orderBy('id','desc')
             ->join('products', 'products.id', '=', 'booking.product_id')
             ->select('booking.*', 'products.title as producttitle','products.slug as producturl')->paginate(10);
            return view('front/orders/vieworders',compact('my_orders'));
        }else{
            return redirect('/');
        }
    }
    
    public function vieworderdetails(Request $request){
        if($request->method() == "POST"){
              $user_id = Auth::user()->id;
              $findbooking =  Booking::where('seller_id',$user_id)->where('id',$request->booking)->first();
             if(isset($findbooking)){
                 return view('front/orders/vieworders_details',compact('findbooking'));
                  
              }else{
               return response()->json(['status' => 'error', 'message' => 'Item Not Found !']);
              }  
        }else{
            return redirect('/');
        }
    }


  

public function providerProcessCheckout(Request $request)
{
    $request->validate([
        'booking_id' => 'required|numeric',
        'checkout_date' => 'required|date',
        'checkout_image' => 'required|image|max:2048',
        'check_in_date' => 'nullable',
        'product_id' => 'required|numeric',
    ]);
    
    $userId = Auth::user()->id;
    $booking = Booking::where('id', $request->booking_id)
                    ->where('seller_id', $userId)
                    ->first();
    
    if (!$booking) {
        return redirect()->back()->with('error', 'Booking not found or you do not have permission');
    }
    
    if ($booking->checkout_status !== 'pending') {
        return redirect()->back()->with('error', 'This booking cannot be checked out');
    }
    
    // Process the checkout image
    if ($request->hasFile('checkout_image')) {
        $file = $request->file('checkout_image');
        $path = time() . '_' . $file->getClientOriginalName();
        $file->move('uploads', $path);
    }
    
    // Update booking checkout details
    $booking->check_out = $request->checkout_date;
    $booking->checkout_status = 'applied';
    $booking->checkout_image = $path;
    $booking->save();
    
    // Calculate and update service days
    $product = Product::find($booking->product_id);
    if ($product) {
        $checkIn = Carbon::createFromFormat('Y-m-d', $booking->check_in);
        $checkOut = Carbon::parse($request->checkout_date);
        $daysUsed = $checkIn->diffInDays($checkOut);
        
        // Add to the service days count
        $product->service_days_count += $daysUsed;
        $product->save();
    }
    
    return redirect('/my-orders')->with('success', 'Checkout processed successfully');
}

public function submitrating_to_customer(Request $request){
     $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id' => 'required|exists:booking,id',
            'rating' => 'required|integer|min:1|max:5',
            'feedback' => 'nullable|string',
        ]);

        CustomerRating::create([
            'product_id' => $request->product_id,
            'user_id' => $request->user_id,
            'vendor_id' => Auth::user()->id,
            'order_id' => $request->order_id,
            'rating' => $request->rating,
            'feedback' => $request->feedback,
        ]);

        return back()->with('success', 'Rating submitted successfully!');
}

}