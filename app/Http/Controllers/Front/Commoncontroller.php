<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Brands;
use App\Models\Category;
use App\Models\State;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Banners;
use App\Models\Help;
use App\Models\Enquiries;
use App\Models\Team;
use App\Models\Blogs;
use App\Models\Booking;
use App\Models\District;
use App\Models\Areas;
use App\Models\Packages;
use App\Models\Testimonial;
use App\Models\Purchasedplans;
use App\Models\Productreviews;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Mail\ContactMail;
use App\Models\Sitesetting;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Str;
use App\Mail\Verificationmail;
use Carbon\Carbon;
class Commoncontroller extends Controller
{
//    public function searchAvailableProducts(Request $request)
// {
//     $checkIn = Carbon::parse($request->input('check_in'));
//     $checkOut = Carbon::parse($request->input('check_out'));

//     $bookedProductIds = DB::table('booking')
//         // ->where('owner_status', 'accept')
//         ->where('checkout_status', '!=', 'accept')
//         ->where(function ($query) use ($checkIn, $checkOut) {
//             $query->whereBetween('check_in', [$checkIn, $checkOut])
//                   ->orWhereBetween('check_out', [$checkIn, $checkOut])
//                   ->orWhere(function ($query) use ($checkIn, $checkOut) {
//                       $query->where('check_in', '<=', $checkIn)
//                             ->where('check_out', '>=', $checkOut);
//                   });
//         })
//         ->pluck('product_id');
        
//     $products = Product::where('is_verify', 'Y')
//         ->where(function ($q) {
//             $q->where('repair_status', '!=', 'requested')
//               ->orWhereNull('repair_status');
//         })
//         ->whereNotIn('id', $bookedProductIds)
//         ->whereNotIn('id', $bookedProductIds)
//           ->when($request->filled('location'), function ($q) use ($request) {
//             $q->where('mlocation', 'like', '%' . $request->location . '%');
//         })
//          ->when($request->filled('category'), function ($q) use ($request) {
//         $q->where('category', $request->category);
//     })
//         ->where('quantity', '>=', $request->quantity)
//         ->orderBy('id', 'desc')
//         ->with('stateRelation:id,name', 'districtRelation:id,name')
//         ->take(20)
//         ->get([
//             'id', 'category', 'title', 'slug', 'price',
//             'rent', 'image1', 'created_at', 'state', 'district','mlocation'
//         ]);

//     return view('front.search.available-products', compact('products', 'checkIn', 'checkOut'));
// }


public function searchAvailableProducts(Request $request)
{
    $checkIn = \Carbon\Carbon::parse($request->input('check_in'))->startOfDay();
    $checkOut = \Carbon\Carbon::parse($request->input('check_out'))->endOfDay();

    // Step 1: Get booked quantity per product for overlapping dates
    $bookedQuantities = DB::table('booking')
        ->select('product_id', DB::raw('SUM(quantity) as total_booked'))
        ->where(function ($query) {
            // Exclude cancelled / completed / accepted bookings
            $query->whereNotIn('booking_status', ['cancelled', 'complete'])
                  ->whereNotIn('booking_status_user', ['cancelled'])
                  ->where('checkout_status', '!=', 'accept');
        })
        ->where(function ($query) use ($checkIn, $checkOut) {
            // Overlapping date range condition
            $query->where('check_in', '<=', $checkOut)
                  ->where('check_out', '>=', $checkIn);
        })
        ->groupBy('product_id')
        ->pluck('total_booked', 'product_id'); // returns [product_id => booked_qty]

    // Step 2: Get all verified and available products
    $products = Product::where('is_verify', 'Y')
        ->where(function ($q) {
            $q->where('repair_status', '!=', 'requested')
              ->orWhereNull('repair_status');
        })
        ->when($request->filled('location'), function ($q) use ($request) {
            $q->where('mlocation', 'like', '%' . $request->location . '%');
        })
        ->when($request->filled('category'), function ($q) use ($request) {
            $q->where('category', $request->category);
        })
        ->where('quantity', '>=', $request->quantity)
        ->orderBy('id', 'desc')
        ->with('stateRelation:id,name', 'districtRelation:id,name')
        ->get([
            'id', 'category', 'title', 'slug', 'price', 'rent', 'image1',
            'created_at', 'state', 'district', 'mlocation', 'quantity'
        ])
        // Step 3: Filter out products which are fully booked in that date range
        ->filter(function ($product) use ($bookedQuantities, $request) {
            $bookedQty = $bookedQuantities[$product->id] ?? 0;
            $availableQty = $product->quantity - $bookedQty;
            return $availableQty >= $request->quantity; // only if enough qty available
        })
        ->take(20)
        ->values();

    return view('front.search.available-products', compact('products', 'checkIn', 'checkOut'));
}

    public function index(){
        $sitesetting = Sitesetting::find(1);
        $seo = json_decode($sitesetting->info_second, true);

        $data['meta_title'] = $seo['site_title'];
        $data['meta_tags'] = $seo['meta_keyword'];
        $data['meta_descraption'] = $seo['meta_description'];
        $data['blogs'] = Blogs::where('status','Y')->orderBy('id','desc')->get(['title','slug','created_at','image','short_description']);


 
         // ✅ Step 1: Define today’s date range
    $today = \Carbon\Carbon::today()->startOfDay();
    $tomorrow = \Carbon\Carbon::tomorrow()->endOfDay();

    // ✅ Step 2: Get total booked quantity per product (today’s date)
    $bookedQuantities = DB::table('booking')
        ->select('product_id', DB::raw('SUM(quantity) as total_booked'))
        ->where(function ($query) {
            $query->whereNotIn('booking_status', ['cancelled', 'complete'])
                  ->whereNotIn('booking_status_user', ['cancelled'])
                  ->where('checkout_status', '!=', 'accept');
        })
        ->where(function ($query) use ($today, $tomorrow) {
            $query->where('check_in', '<=', $tomorrow)
                  ->where('check_out', '>=', $today);
        })
        ->groupBy('product_id')
        ->pluck('total_booked', 'product_id'); 

    // ✅ Step 3: Get verified & active products
    $data['recent_product'] = Product::where('is_verify', 'Y')
        ->where(function ($q) {
            $q->where('repair_status', '!=', 'requested')
              ->orWhereNull('repair_status');
        })
        ->join('state', 'products.state', '=', 'state.id')
        ->join('district', 'products.district', '=', 'district.id')
        ->select(
            'products.id',
            'products.category',
            'products.title',
            'products.slug',
            'products.price',
            'products.rent',
            'products.image1',
            'products.quantity',
            'products.created_at',
            'state.name as state_name',
            'district.name as district_name'
        )
        ->orderBy('products.id', 'desc')
        ->get()
        // ✅ Step 4: Filter — only keep products where available quantity > 0
        ->filter(function ($product) use ($bookedQuantities) {
            $bookedQty = $bookedQuantities[$product->id] ?? 0;
            $availableQty = $product->quantity - $bookedQty;
            return $availableQty > 0; // only if some qty left
        })
        ->take(20)
        ->values();



        $data['categories_latest'] = Category::where('parent_category',0)->where('status','Y')->take(4)->get();
        $data['banners'] = Banners::where('status','Y')->orderBy('id','desc')->get(['image']);
        $data['testimonials'] = Testimonial::where('status','Y')->orderBy('id','desc')->get(['name','destination','description','image']);
        return view('front/index',$data);
    }



    public function sendverifyemail($email){
        $userid = Auth::user()->id;
        $user = User::where('id',$userid)->first();
        if($user){
            $token = Str::random(40);
            User::where('id',$userid)->update(['remember_token' => $token]);

            $verificationUrl = url('/verify-email/'.$token.'?i='.Auth::user()->id);

        // Send the verification email
        Mail::to($email)->send(new Verificationmail($user, $verificationUrl));
        return redirect()->back()->with('success','Verification email sent! Please check your inbox. !');

        }else{
            return redirect()->back()->with('error','Something went wrong !');
        }

    }

    public function verifyemail($token){
        if(isset($_GET['i']) && !empty($_GET['i'])){
            $user = User::where('id',$_GET['i'])->where('remember_token',$token)->first();
            if($user){
                 User::where('id',$_GET['i'])->where('remember_token',$token)->update(['remember_token' => null,'email_verify' => 'Y']);
                  return redirect('/my-setting')->with('success','Thank You ! Email has been successfully verified.');

            }else{
                return redirect('/my-setting')->with('error','Invalid User');
            }
        }
    }


    public function cart_items(){
        $cartitems = DB::table('cart')->where('user__id',Auth::user()->id)
        ->join('products', 'cart.product_id', '=', 'products.id')
        ->select('products.id as product_id','products.title','products.slug','products.image1','products.price','cart.quantity','cart.*','cart.id as cartid')
        ->orderBy('cart.id','desc')
        ->get();
        return view('front.cart',compact('cartitems'));
    }

    public function updatecartquantity(Request $request){
        $credentials = $request->validate([
            'quantity' => ['required','numeric'],
            'cartidentity' => ['required','numeric'],
    ]);

        $cart = Cart::where('id',$request->cartidentity)->update(
            ['quantity' => $request->quantity]
        );
        return redirect()->back();
    }


public function submitrating(Request $request){
    if ($request->method() == "POST") {
        $credentials = $request->validate([
            'product_id' => ['required','numeric'],
            'rating' => ['required','numeric'],
            'feedback' => ['required','min:10'],
    ]);
    $review = new Productreviews;
    $review->product_id = $request->product_id;
    $review->user__id = Auth::user()->id;
    $review->rating = $request->rating;
    $review->feedback = $request->feedback;
    $review->save();
    return redirect()->back()->with('success','Your review has been successfully submitted');
    }
}
    public function deletecartitem($id){
        $cart = Cart::find($id);
        if ($cart->user__id == Auth::user()->id) {
            $cart->delete();
            return redirect()->back()->with('success','Deleted Successfully');
        }else{
            return redirect()->back()->with('error','Please select right cart item.');
        }
    }


    public function wishlist(){
        $wishlist = session()->get('wishlist', []);
        return view('front.wishlist',compact('wishlist'));
    }

    public function flushsession(){
        Session::flush();
    }

    public function remove_wishlist($id){
        $product_id =$id;
        $wishlist = session()->get('wishlist', []);
        if (isset($wishlist[$product_id])) {
            unset($wishlist[$product_id]);
            session()->put('wishlist', $wishlist);
        }
        return redirect()->back()->with('success', 'Product removed from wishlist!');
    }

    public function addtocart(Request $request){

        if(Auth::check()){
        $credentials = $request->validate([
            'prduct_id' => ['required','numeric'],
        ]);

        // print_r($request->all());
        $product_id = $request->prduct_id;
        $user_id = Auth::user()->id;
        if (isset($request->prduct_id)) {
            
            $findcart = Cart::where('product_id',$product_id)->where('user__id',$user_id)->first();
            
            if (isset($findcart)) {
                return response()->json([
                    'status'=>'error',
                    'message'=>'Already Added',
                ]);
            }else{
                
            $newcart = new Cart;
            $newcart->product_id = $product_id;
            $newcart->user__id = $user_id;
            $newcart->quantity = 1;
            $newcart->save();
            return response()->json([
                'status'=>'success',
                'message'=>'Added in cart.',
            ]);
        }
        }
}else{
    return response()->json([
        'status'=>'error',
        'message'=>'Please login account',
    ]);
}
    }

    public function addtowishlist(Request $request){
       if (Auth::check()) {

        $product_id = $request->product;
        $product_find =  Product::find($request->product);
        $user_id = Auth::user()->id;


        $wishlist = session()->get('wishlist', []);

        if (!isset($wishlist[$product_id])) {
            // Add product to wishlist
            $wishlist[$product_id] = [
                'prduct_id' => $product_id,
                'user' => $user_id,
                'image' => $product_find->image1,
                'price' => $product_find->price,
                'title' => $product_find->title,
                'slug' => $product_find->slug,
            ];
            session()->put('wishlist', $wishlist);
            return response()->json([
                'status'=>'success',
                'message'=>'Successfully Added',
            ]);

        }else {
            return response()->json([
                'status'=>'error',
                'message'=>'Already added in wishlist',
            ]);
        }

       }else{
      return response()->json([
        'status'=>'error',
        'message'=>'Please login your account',
    ]);
       }
    }


    public function profile(){
        return view('front.profile');
    }

    public function myads(){
        return view('front.myads');
    }

    public function packages(){
        return view('front.packages');
    }

    public function help(){
        $helping = Help::where('status','Y')->get();
        return view('front.help',compact('helping'));
    }

    public function helpdetails($slug){
    $helpieds = Help::where('slug',$slug)->first();
        return view('front.helpdetails',compact('helpieds'));
    }

    public function settings(){
        return view('front.settings');
    }

    public function about(){
        $data = Sitesetting::find(2);
        $testimonials = Testimonial::where('status','Y')->orderBy('id','desc')->get(['name','destination','description','image']);
        $team = Team::where('status','Y')->orderBy('id','desc')->get();
        return view('front.about',compact('data','testimonials','team'));
    }

    public function faq(){
        return view('front.faq');
    }

    public function terms(){
        return view('front.terms');
    }

    public function privacypolicy(){
        return view('front.privacypolicy');
    }
    public function contact(Request $request){
        if ($request->method() == "POST") {
            $data = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'numeric','digits:10'],
                'subject' => ['required'],
                'message' => ['required'],
            ]);

            Mail::to('targetvr43@gmail.com')->send(new ContactMail($data));
            $contact = new Enquiries;
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->save();
            return redirect()->back()->with('success','Your enquires has been successfully submitted.');
        }
        return view('front.contact');
    }

    public function category(){
        return view('front.category');
    }
    public function productdetail($slug){

           // ✅ Step 1: Get product
    $product = Product::where('slug', $slug)
        ->where('is_verify', 'Y')
        ->firstOrFail();

        if (isset($product)){
            $user = User::where('id',$product->user_id)->first();
            $productreviews = Productreviews::where('product_id',$product->id)
            ->join('users', 'product_reviews.user__id', '=', 'users.id')
            ->select('product_reviews.id as review_id','product_reviews.*','users.name','product_reviews.created_at as create_time',)
            ->orderBy('product_reviews.id','desc')->take(4)->get();

            $relatedproducts = Product::where('user_id',$product->user_id)
            ->join('state', 'products.state', '=', 'state.id')
            ->join('district', 'products.district', '=', 'district.id')
            ->select('products.id','products.category', 'products.title','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
            ->orderBy('products.id','desc')
            ->take(20)->get();

$bookings = Booking::where('product_id', $product->id)
        ->whereNotIn('booking_status', ['cancelled', 'complete'])
        ->whereNotIn('booking_status_user', ['cancelled'])
        ->where('checkout_status', '!=', 'accept')
        ->get(['check_in', 'check_out', 'quantity']);

    $bookedDates = [];

    // ✅ Build date-wise quantity
    foreach ($bookings as $booking) {
        $start = Carbon::parse($booking->check_in);
        $end = Carbon::parse($booking->check_out);

        while ($start->lte($end)) {
            $dateKey = $start->format('Y-m-d');
            if (!isset($bookedDates[$dateKey])) {
                $bookedDates[$dateKey] = 0;
            }
            $bookedDates[$dateKey] += $booking->quantity;
            $start->addDay();
        }
    }

    // ✅ Merge booked dates into continuous ranges where total qty >= product qty
$bookedRanges = [];
$currentRange = null;

foreach (collect($bookedDates)->sortKeys() as $date => $qty) {
    if ($qty >= $product->quantity) {
        // agar booked hai, to current range start karo ya extend karo
        if ($currentRange === null) {
            $currentRange = [
                'start' => $date,
                'end' => $date,
            ];
        } else {
            $previous = Carbon::parse($currentRange['end']);
            $current = Carbon::parse($date);
            // check agar continuous date hai
            if ($previous->addDay()->isSameDay($current)) {
                $currentRange['end'] = $date;
            } else {
                // not continuous, to purani range push karo aur nayi start karo
                $bookedRanges[] = $currentRange;
                $currentRange = [
                    'start' => $date,
                    'end' => $date,
                ];
            }
        }
    } else {
        // booked nahi hai — agar koi current range open hai, to close kar do
        if ($currentRange !== null) {
            $bookedRanges[] = $currentRange;
            $currentRange = null;
        }
    }
}

// ✅ last open range close
if ($currentRange !== null) {
    $bookedRanges[] = $currentRange;
}

 
            return view('front.productdetail',compact('product','user','relatedproducts','productreviews','bookedRanges'));
        }else{
            return redirect('/')->with('error','Not found');
        }
    }

    public function myproducts(){
        if (Auth::check() && Auth::user()->role == "user" || Auth::user()->role == "admin") {
            return redirect('/');
        } else {
            $results = DB::table('products')
            ->join('brands', 'products.brands', '=', 'brands.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->where('user_id',Auth::user()->id)
            ->orderBy('products.id','desc')
            ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username')
            ->get();
            $auditors = User::where('role', 'auditor')->select(['id', 'name'])->get();
            return view('front.myproducts',compact('results','auditors'));
        }
    }


    public function updateRepairStatus(Request $request)
{
    if (!Auth::check() || Auth::user()->role !== 'vendor') {
        return redirect()->back()->with('error', 'Unauthorized access');
    }

    $request->validate([
        'product_id' => 'required|numeric',
         'auditor_id' => 'nullable|numeric',
        'repair_status' => 'required|in:none,requested,completed',
    ]);

    $product = Product::where('id', $request->product_id)
                      ->where('user_id', Auth::user()->id)
                      ->first();

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found or you do not have permission');
    }
    

    

    $product->repair_status = $request->repair_status;
    
    if(isset($request->auditor_id)){
    
    $product->auditor = $request->auditor_id;
    }
    
    // If marking as completed, update the last_repair_date
    if ($request->repair_status === 'completed') {
        $product->last_repair_date = now();
        // Reset service days count when repair is completed
        $product->service_days_count = 0;
    }
    
    $product->save();

    return redirect()->back()->with('success', 'Repair status updated successfully');
}


public function changeauditor(Request $request){
     
     if (!Auth::check()) {
        return redirect()->back()->with('error', 'Unauthorized access');
    }

    $request->validate([
        'product_id' => 'required|numeric',
         'auditor_id' => 'required|numeric',
    ]);
    
     $product = Product::where('id', $request->product_id)
                      ->where('user_id', Auth::user()->id)
                      ->first();

    if (!$product) {
        return redirect()->back()->with('error', 'Product not found or you do not have permission');
    }
    
    
    if(isset($request->auditor_id)){
    
    $product->auditor = $request->auditor_id;
    }
    
     $product->save();

    return redirect()->back()->with('success', 'Updated successfully');
    
    
}

    


    public function registervendor(Request $request){
        if ($request->method() == "POST") {
            $credentials = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email','unique:users'],
                'phone' => ['required', 'numeric','unique:users','digits:10'],
                'password' => ['required','min:8'],
                'password_confirmation' => 'required_with:password|same:password',
                'address_1' => ['required'],
                'address_2' => ['required'],
                'pincode' => ['required'],
                'gst_number' => ['required'],
                'owner_first_name' => ['required'],
                'owner_last_name' => ['required'],
                'business_location_image' => 'required|max:1024|mimes:jpeg,png,jpg,svg,webp',
                'owner_image' => 'required|max:1024|mimes:jpeg,png,jpg,svg,webp',
            ]);

            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->address_1 = $request->address_1;
            $user->address_2 = $request->address_2;
            $user->gst_number = $request->gst_number;
            $user->owner_first_name = $request->owner_first_name;
            $user->owner_last_name = $request->owner_last_name;
            $user->business_location_image =   uploadImagedyanamic($request->business_location_image,$user,'business_location_image');
            $user->owner_image =   uploadImagedyanamic($request->owner_image,$user,'owner_image');
            $user->role = "vendor";
            $user->is_active = "N";
            $user->save();
            return redirect('/')->with('success','Vendor account created successfully. Please login your account');
        }
        return view('front/register-vendor');
    }

    public function registeruser(Request $request){

        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email','unique:users'],
            'password' => ['required','min:8'],
            'password_confirmation' => 'required_with:password|same:password'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        if (isset($request->provider_accountconfirm)) {
        if ($request->provider_accountconfirm == "on") {
            $user->role = 'provider';
        }
    }
        $user->password	 = Hash::make($request->password);
        if ($user->save()) {
            return response()->json([
                'status'=>'success',
            ]);
        }else{
            return response()->json([
                'status'=>'error',
            ]);
        }
        // echo "hello";
    }

public function  loginuser(Request $request){
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        if(Auth::check() && Auth::user()->role == "provider"){
            if (Auth::user()->is_active == "Y") {
                return response()->json([
                    'status'=>'success',
                ]);
            }else{
                Auth::logout();
                return response()->json([
                    'status'=>'notactive',
                ]);

            }
        }elseif(Auth::check() && Auth::user()->role =='user'){
            if (Auth::user()->is_active == "Y") {
                return response()->json([
                    'status'=>'success',
                ]);
            }else{
                Auth::logout();
                return response()->json([
                    'status'=>'notactive',
                ]);

            }
        }
        elseif(Auth::check() && Auth::user()->role =='vendor'){
            if (Auth::user()->is_active == "Y") {
                return response()->json([
                    'status'=>'success',
                ]);
            }else{
                Auth::logout();
                return response()->json([
                    'status'=>'notactive',
                ]);

            }

        }    elseif(Auth::check() && Auth::user()->role =='auditor'){
            if (Auth::user()->is_active == "Y") {
                return response()->json([
                    'status'=>'success',
                ]);
            }else{
                Auth::logout();
                return response()->json([
                    'status'=>'notactive',
                ]);

            }

        }
        else{
            return response()->json([
                'status'=>'error',
            ]);
        }
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');

}

public function updateprofile(Request $request){
    if(Auth::check()){
        $credentials = $request->validate([
            'name' => ['required'],
            // 'email' => ['required', 'email','unique:users,email'],
            'phone' => ['required','numeric','digits:10'],
            'address_1' => ['required'],
            'address_2' => ['required'],
            'pincode' => ['required'],
        ]);
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->pincode = $request->pincode;
        // $user->email = $request->email;
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->current_address = $request->current_address;
        $user->details_verify = 'Y';
        if($request->image){
            $user->image = updateImage($request->image,$user);
        }
        if($request->current_address_document){
            $user->current_address_document = updateImage($request->current_address_document,$user);
        }
        $user->save();
        return redirect()->back()->with('success','Updated Successfully');
    }
}

public function savecards(Request $request){
    if (Auth::check()) {
        $user_id = Auth::user()->id;


        $credentials = $request->validate([
            'card_number' => ['required'],
            'bank_name' => ['required'],
            'bank_holder_name' => ['required'],
            'expiry_month' => ['required','numeric'],
            'expiry_year' => ['required','numeric'],
            'cvv' => ['required','numeric','digits:3'],
        ]);

        $cardnumber = implode("-",$request->card_number);

        $carddetails = [
            'cardnumber' => $cardnumber,
            'bank_name' => $request->bank_name,
            'bank_holder_name' => $request->bank_holder_name,
            'expiry_month' => $request->expiry_month,
            'expiry_year' => $request->expiry_year,
            'cvv' => $request->cvv,
        ];


        $user = User::find($user_id);
        $user->card_details = json_encode($carddetails);
        $user->save();
        return redirect()->back()->with('success','Card Details Saved Successfully');
    }
}

public function new_post(){

    // use App\Models\Packages;
    // use App\Models\Purchasedplans;

    // --check plans purchased or not

    $plans = Purchasedplans::where('user_id',Auth::user()->id)->first();
    if (isset($plans)) {

        $package_id = $plans->package_id;


          $package = Packages::find($plans->package_id);
    if (!$package) {
        return redirect('/')->with('error', 'Package not found.');
    }
    
    $maxQuantity = $package->post_quantity;

    $totalUploaded = Product::where('user_id', Auth::id())->count();

    if ($totalUploaded >= $maxQuantity) {
        return redirect('/')->with('error', 'Your plan has been expired or post limit reached.');
    }else{
            $data['brands'] = Brands::where('status','Y')->orderBy('id','desc')->get();
            $data['categories'] = Category::where('status','Y')->where('parent_category','0')->orderBy('id','desc')->get();
            $data['state'] = State::where('status','Y')->get();
              $data['remainingPosts'] = $maxQuantity - $plans->used_posts; // baki kitne bache hain
    $data['maxQuantity'] = $maxQuantity;
            return view('front.newpost',$data);
        }
    }else{
        return redirect('/')->with('error','Please Activate Package.');
    }


// die;
//     if (checkifprovider_post_or_not() == "true") {
//     if (Auth::check()) {

//         $data['brands'] = Brands::where('status','Y')->orderBy('id','desc')->get();
//         $data['categories'] = Category::where('status','Y')->where('parent_category','0')->orderBy('id','desc')->get();
//         $data['state'] = State::where('status','Y')->get();
//         return view('front.newpost',$data);
//     }else{
//         return redirect()->back();
//     }}else{
//         return redirect('/')->with('error','Your account can not supported for multiple create product feature.');
//     }
}

// --new-post

public function create_post(Request $request){
    if ($request->method() == "POST") {

    $userId = Auth::id();
    $activePackage = Purchasedplans::where('user_id', $userId)
        ->whereIn('status', ['active', 'upgraded'])
        ->latest('id')
        ->first();

    if (!$activePackage) {
        return redirect()->back()->with('error', 'You have no active package. Please purchase a package first.');
    }
    
    $remainingPosts = $activePackage->post_quantity - $activePackage->used_posts;

    if ($remainingPosts <= 0) {
        return redirect()->back()->with('error', 'Your post limit is over. Please upgrade your package.');
    }

    // echo "<pre>";
    // print_r($request->all());
    // echo "</pre>";
    // die;

        $credentials = $request->validate([
            'brands' => ['required','numeric'],
            'category' => ['required','numeric'],
            'size' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'price' => ['required','numeric'],
            'state' => ['required','numeric'],
            'area' => ['required','numeric'],
            'large_desc' => ['required'],
            'district' => ['required','numeric'],
            'pincode' => ['required','numeric'],
            // --
            'model_name' => ['required'],
            'color' => ['required'],
            'rent' => ['required','numeric'],
            'frame_size' => ['required'],
            'frame_no' => ['required'],
            'frame_material' => ['required'],
            'speed' => ['required'],
            'fork' => ['required'],
            // 'shifters' => ['required'],
            // 'front_gear' => ['required'],
            // 'rear_gear' => ['required'],
            // 'front_derailleur' => ['required'],
            // 'rear_derailleur' => ['required'],
            'brake' => ['required'],
            'offer_30' => ['required','numeric'],
            'offer_15' => ['required','numeric'],
            'offer_7' => ['required','numeric'],
            // --
            'image1' =>  'required|mimes:jpeg,png,jpg,svg,webp',
            'image2' =>  'required|mimes:jpeg,png,jpg,svg,webp',
            'image3' =>  'required|mimes:jpeg,png,jpg,svg,webp',
            'image4' =>  'required|mimes:jpeg,png,jpg,svg,webp',
            'image5' =>  'mimes:jpeg,png,jpg,svg,webp',
            'image6' =>  'mimes:jpeg,png,jpg,svg,webp',
            'image7' =>  'mimes:jpeg,png,jpg,svg,webp',
            'image8' =>  'mimes:jpeg,png,jpg,svg,webp',
        ],[
            'brands.numeric' => 'The brand fields is required',
            'category.numeric' => 'The category fields is required',
            'size.numeric' => 'The size fields is required',
            'district.numeric' => 'The district fields is required',
            'state.numeric' => 'The state fields is required',
            'area.numeric' => 'The Area fields is required',
            'image1.required' => 'The image feild is required',
            'image2.required' => 'The image feild is required',
            'image3.required' => 'The image feild is required',
            'image4.required' => 'The image feild is required',
        ]);

        $userid = Auth::user()->id;

         $user = Auth::user();

        $enteredQty = $user->role == 'vendor' ? intval($request->quantity ?? 1) : 1;
        if ($user->role == 'vendor' && $enteredQty > $remainingPosts) {
            return redirect()->back()->with('error', "You can only create a post with up to {$remainingPosts} quantity as per your package limit.");
        }

        $district = District::findOrFail($request->district);
        $area     = Areas::findOrFail($request->area);
        $state    = State::findOrFail($request->state);
            
        $locationName = $district->name . ' ' . $area->name . ' ' . $state->name;
 

        $product = new Product;
        $product->brands = $request->brands;
        $product->category = $request->category;
        $product->size = $request->size;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title.'-'.rand(), '-');
        $product->description = $request->description;
        $product->price = $request->price;
        $product->large_desc = $request->large_desc;
        $product->state = $request->state;
        $product->area = $request->area;
        $product->district = $request->district;
        $product->pincode = $request->pincode;
        $product->user_id = $userid;
        $product->model_name = $request->model_name;
        $product->color = $request->color;
        $product->rent = $request->rent;
        $product->frame_size = $request->frame_size;
        $product->frame_no = $request->frame_no;
        $product->frame_material = $request->frame_material;
        $product->speed = $request->speed;
        $product->fork = $request->fork;
        $product->shifters = $request->shifters;
        $product->front_gear = $request->front_gear;
        $product->rear_gear = $request->rear_gear;
        $product->front_derailleur = $request->front_derailleur;
        $product->rear_derailleur = $request->rear_derailleur;
        $product->brake = $request->brake;
        $product->offer_7 = $request->offer_7;
        $product->offer_30 = $request->offer_30;
        $product->offer_15 = $request->offer_15;
        $product->mlocation = $locationName;

        if (Auth::user()->role == "vendor") {
            $product->quantity = $request->quantity;    
            $product->added_vendor = "Y";    
        }else{
            $product->added_vendor = "N";
             $product->quantity = 1;  
        }

        if ($request->image1) {
            $product->image1 =  uploadImagedyanamic($request->image1,$product,'image1');
        }

        if ($request->image2) {
            $product->image2 =  uploadImagedyanamic($request->image2,$product,'image2');
        }


        if ($request->image3) {
            $product->image3 =  uploadImagedyanamic($request->image3,$product,'image3');
        }

        if ($request->image4) {
            $product->image4 =  uploadImagedyanamic($request->image4,$product,'image4');
        }


        if ($request->image5) {
            $product->image5 =  uploadImagedyanamic($request->image5,$product,'image5');
        }


        if ($request->image6) {
            $product->image6 =  uploadImagedyanamic($request->image6,$product,'image6');
        }


        if ($request->image7) {
            $product->image7 =  uploadImagedyanamic($request->image7,$product,'image7');
        }

        if ($request->image8) {
            $product->image8 =  uploadImagedyanamic($request->image8,$product,'image8');
        }
if ($product->save()) {
            $activePackage->used_posts += $enteredQty;
            $activePackage->save();

            return redirect('/')
                ->with('success', "Product Created Successfully. ({$enteredQty} post(s) deducted from your package)");
        } else {
            return redirect()->back()->with('error', 'Something went wrong, please contact admin!');
        }
    } else {
        return redirect()->back()->with('error','Your account can not supported for multiple create product feature.');
    }
}


public function logoutfront(){
    Auth::logout();
    return redirect('/')->with('success','Log Out Success');
}

public function getdisrtict(Request $request){

    $district = District::where('state_id',$request->id)->orderBy('id','desc')->where('status','Y')->get();

    $ar = '<option selected>select City</option>';
    foreach($district as $key => $val){
        $ar .= '<option value="'.$val->id.'">'.$val->name.'</option>';
    }

    return $ar;

}

public function getallreviews(Request $request){
    $product_id = $request->product;
    $productreviews = Productreviews::where('product_id',$product_id)
    ->join('users', 'product_reviews.user__id', '=', 'users.id')
    ->select('product_reviews.id as review_id','product_reviews.*','users.name','product_reviews.created_at as create_time',)
    ->orderBy('product_reviews.id','desc')->get();
    return view('front.partials.reviews',compact('productreviews'));
}


public function blogs(){
    $data['recent'] = Blogs::where('status','Y')->take(5)->get(['image','slug','created_at','title']);
    $data['categories_all'] = Category::where('parent_category',0)->where('status','Y')->get();
    $data['blogs'] = Blogs::where('status','Y')->select(['image','slug','created_at','title','writer_name','short_description'])->paginate(5);
    return view('front.blogs',$data);
}

public function blogview($slug){
    $row = Blogs::where('slug',$slug)->first();
    if ($row) {
        $categories_all = Category::where('parent_category',0)->where('status','Y')->get();
        $category = Category::find($row->category);
        $recent = Blogs::where('status','Y')->take(5)->get(['image','slug','created_at','title']);
        return view('front.blogview',compact('row','category','categories_all','recent'));
    }else{
        return redirect('/');
}
}


// Add this method to handle repair requests
public function requestRepair(Request $request ,$id)
{
    if (Auth::check()) {
        $product = Product::where('id', $id)->where('user_id', Auth::user()->id)->first();
        
        if ($product) {
            $product->repair_status = 'requested';
            $product->auditor = $request->auditor;
            $product->save();
            return redirect()->back()->with('success', 'Repair request submitted successfully');
        } else {
            return redirect()->back()->with('error', 'You are not authorized to request repair for this cycle');
        }
    } else {
        return redirect('/')->with('error', 'Please login first');
    }
}


public function auditor_register(Request $request){
    if ($request->method() == "POST") {
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email','unique:users'],
            'phone' => ['required', 'numeric','unique:users','digits:10'],
            'password' => ['required','min:8'],
            'password_confirmation' => 'required_with:password|same:password',
            'address_1' => ['required'],
            'address_2' => ['required'],
            'pincode' => ['required'],
            'gst_number' => ['required'],
            'owner_first_name' => ['required'],
            'owner_last_name' => ['required'],
            'business_location_image' => 'required|max:2048|mimes:jpeg,png,jpg,svg,webp',
            'owner_image' => 'required|max:2048|mimes:jpeg,png,jpg,svg,webp',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->address_1 = $request->address_1;
        $user->address_2 = $request->address_2;
        $user->gst_number = $request->gst_number;
        $user->owner_first_name = $request->owner_first_name;
        $user->owner_last_name = $request->owner_last_name;
        $user->business_location_image =   uploadImagedyanamic($request->business_location_image,$user,'business_location_image');
        $user->owner_image =   uploadImagedyanamic($request->owner_image,$user,'owner_image');
        $user->role = "auditor";
        $user->is_active = "N";
        $user->save();
        return redirect('/')->with('success','Auditor account created successfully. Please login your account');
    }
    return view('front/auditor_register');
}


// public function check_offer(Request $request){
//     $days = (int) $request->input('days');
//     $productId = $request->input('product_id');

//     $product = Product::findOrFail($productId);
//     $deposit_now = $product->price;
//     $per_day_rent = $product->rent;
//     $total_rent = $days * $per_day_rent;
//     $total_amount = $deposit_now + $total_rent;
//     $total_amount = number_format($total_amount, 2, '.', '');

    
//     // Fetch discount settings from DB (assuming id = 5)
//     $settings = Sitesetting::find(5);
//     $offers = json_decode($settings->info_first, true);

//     $discount = 0;

//     // Apply discount logic based on day ranges
//     if ($days >= 0 && $days <= 7) {
//         $discount = $product->offer_7 ?? 0;
//     } elseif ($days >= 8 && $days <= 15) {
//         $discount = $product->offer_15 ?? 0;
//     } elseif ($days >= 16) {
//         $discount = $product->offer_30 ?? 0;
//     }

//     // Response message
//     if ($discount > 0) {
//         $message = "ðŸŽ‰ You get a {$discount}% discount for booking {$days} days!";
        
//     } else {
//         $message = "âœ… No discount applied.";
//     }
//     session(['discount' => $discount]);
    
//       return response()->json([
//         'message' => $message,
//         'discount' => $discount,
//         'rent' => number_format($per_day_rent, 2),
//         'deposit' => number_format($deposit_now, 2),
//         'total' => number_format($total_rent, 2),
//         'final_amount' => number_format($total_amount * (1 - ($discount / 100)), 2),
//         'days' => $days
//     ]);
// }


// public function check_offer(Request $request){
//     $days = (int) $request->input('days');
//     $productId = $request->input('product_id');

//     $product = Product::findOrFail($productId);
//     $deposit_now = $product->price;
//     $per_day_rent = $product->rent;
//     $total_rent = $days * $per_day_rent;

//     // Discount logic
//     $discount = 0;
//     if ($days >= 0 && $days <= 7) {
//         $discount = $product->offer_7 ?? 0;
//     } elseif ($days >= 8 && $days <= 15) {
//         $discount = $product->offer_15 ?? 0;
//     } elseif ($days >= 16) {
//         $discount = $product->offer_30 ?? 0;
//     }

//     // Apply discount only on rent
//     $discounted_rent = $total_rent * (1 - ($discount / 100));

//     // Kitne rupaye bache discount se
//     $discount_amount = $total_rent - $discounted_rent;

//     // Extra refundable charge logic
//     $extra_charge = 0;
//     if ($discounted_rent >= $deposit_now) {
//         $extra_charge = 2000;
//     }

//     // âœ… Payable Now (deposit + extra refundable charge)
//     $pay_now = $deposit_now + $extra_charge;

//     // âœ… Remaining (full discounted rent at checkout)
//     $remaining_rent = $discounted_rent;


//     session(['discount' => $discount]);

//     // Final total
//     $final_amount = $pay_now + $remaining_rent;

//     $message = $discount > 0 
//         ? "ðŸŽ‰ You saved â‚¹" . number_format($discount_amount, 2) . " with {$discount}% discount on rent!"
//         : "âœ… No discount applied.";

//     return response()->json([
//         'message' => $message,
//         'discount' => $discount,
//         'discount_amount' => number_format($discount_amount, 2), // âœ… new
//         'rent' => number_format($per_day_rent, 2),  
//         'deposit' => number_format($deposit_now, 2),
//         'total_rent' => number_format($total_rent, 2),
//         'discounted_rent' => number_format($discounted_rent, 2),
//         'extra_charge' => number_format($extra_charge, 2),
//         'pay_now' => number_format($pay_now, 2),
//         'remaining_rent' => number_format($remaining_rent, 2),
//         'final_amount' => number_format($final_amount, 2),
//         'days' => $days
//     ]);
// }




// public function check_offer(Request $request)
// {
//     $days      = (int) $request->input('days');
//     $productId = $request->input('product_id');

//     $product         = Product::findOrFail($productId);
//     $deposit_amount  = $product->price;   // base security deposit
//     $per_day_rent    = $product->rent;
//     $total_rent      = $days * $per_day_rent;

//     /* ---------------- Discount Logic ---------------- */
//     $discount = 0;
//     if ($days >= 0 && $days <= 7) {
//         $discount = $product->offer_7 ?? 0;
//     } elseif ($days >= 8 && $days <= 15) {
//         $discount = $product->offer_15 ?? 0;
//     } elseif ($days >= 16) {
//         $discount = $product->offer_30 ?? 0;
//     }

//     $discounted_rent = $total_rent * (1 - ($discount / 100));
//     $discount_amount = $total_rent - $discounted_rent;

//     /* ---------------- Money-Flow Logic ----------------
//       Case-1: discounted_rent <= deposit
//               => Pay deposit now, refund (deposit - rent) on checkout.
//       Case-2: discounted_rent  > deposit
//               => Pay (discounted_rent + 2000) now,
//                  refund 2000 on checkout.
//     --------------------------------------------------- */

//     $extra_charge       = 0;    // only for Case-2
//     $pay_now            = 0;
//     $checkout_pay       = 0;    // if user needs to pay more at checkout
//     $refund_at_checkout = 0;    // amount we will return at checkout

//     // if ($discounted_rent <= $deposit_amount) {
//     //     // Case-1
//     //     $pay_now            = $deposit_amount;
//     //     $checkout_pay       = 0;  // no extra payment needed
//     //     $refund_at_checkout = $deposit_amount - $discounted_rent;
//     // } else {
//     //     // Case-2
//     //     $extra_charge       = 2000;
//     //     $pay_now            = $discounted_rent + $extra_charge;
//     //     $checkout_pay       = 0;      // rent already covered
//     //     $refund_at_checkout = $extra_charge; // full 2000 refunded
//     // }



// if ($discounted_rent <= $deposit_amount) {

//     // Difference nikalte hain
//     $difference = $deposit_amount - $discounted_rent;

//     if ($difference <= 2000) {
//         // Special Case: deposit + 2000 rule
//         $extra_charge       = 2000;
//         $pay_now            = $deposit_amount + $extra_charge;
//         $refund_at_checkout = $extra_charge; // full 2000 refunded
//         $checkout_pay       = 0;
//     } else {
//         // Normal Case-1
//         $pay_now            = $deposit_amount;
//         $checkout_pay       = 0;
//         $refund_at_checkout = $deposit_amount - $discounted_rent;
//     }

// } else {
//     // Case-2 (already existing)
//     $extra_charge       = 2000;
//     $pay_now            = $discounted_rent + $extra_charge;
//     $checkout_pay       = 0;
//     $refund_at_checkout = $extra_charge;
// }


//     session(['discount' => $discount]);

//     // For clarity total "final_amount" is what user gives initially
//     $final_amount = $pay_now;

//     $message = $discount > 0
//         ? "🎉 You saved ₹" . number_format($discount_amount, 2) .
//           " with {$discount}% discount on rent!"
//         : "✅ No discount applied.";

//     return response()->json([
//         'message'            => $message,
//         'discount'           => $discount,
//         'discount_amount'    => number_format($discount_amount, 2),
//         'rent'               => number_format($per_day_rent, 2),
//         'deposit'            => number_format($deposit_amount, 2),
//         'total_rent'         => number_format($total_rent, 2),
//         'discounted_rent'    => number_format($discounted_rent, 2),
//         'extra_charge'       => number_format($extra_charge, 2),
//         'pay_now'            => number_format($pay_now, 2),
//         'checkout_pay'       => number_format($checkout_pay, 2),        // user ko aur kitna dena hai (mostly 0)
//         'remaining_rent' => number_format($refund_at_checkout, 2),   // kitna wapas milega
//         'final_amount'       => number_format($final_amount, 2),
//         'days'               => $days
//     ]);
// }


public function check_offer(Request $request)
{
     $days      = (int) $request->input('days');
    $productId = $request->input('product_id');
    $check_in  = $request->input('checkIn');   // e.g. 09/10/2025
    $check_out = $request->input('checkOut');  // e.g. 18/10/2025

    /* ---------------- Safe Date Conversion ---------------- */
    try {
        $startDate = \Carbon\Carbon::createFromFormat('d/m/Y', $check_in)->format('Y-m-d');
        $endDate   = \Carbon\Carbon::createFromFormat('d/m/Y', $check_out)->format('Y-m-d');
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => '⚠️ Invalid date format. Please send dates like 18/10/2025.',
            'debug' => $e->getMessage()
        ], 422);
    }

    /* ---------------- Product Fetch ---------------- */
    $product = Product::findOrFail($productId);

    /* ---------------- Availability Check ---------------- */
    $totalQty = $product->quantity;

    $bookedQty = Booking::where('product_id', $productId)
        ->where('owner_status', '!=', 'accept')
        ->where('booking_status_user', '!=', 'cancelled')
        ->where(function ($q) use ($startDate, $endDate) {
            $q->where('check_in', '<=', $endDate)
              ->where('check_out', '>=', $startDate);
        })
        ->sum('quantity');

    $availableQty = $totalQty - $bookedQty;

    if ($availableQty <= 0) {
        // Find next available date
        $nextAvailableBooking = Booking::where('product_id', $productId)
            ->where('owner_status', '!=', 'accept')
               ->where('booking_status_user', '!=', 'cancelled')
            ->orderBy('check_out', 'desc')
            ->first();

        $nextAvailableDate = $nextAvailableBooking
            ? \Carbon\Carbon::parse($nextAvailableBooking->check_out)->addDay()->format('d/m/Y')
            : 'N/A';

        return response()->json([
            'status'  => 'unavailable',
            'message' => "❌ This cycle is not available for your selected dates. It will be available again from {$nextAvailableDate}.",
            'available_from' => $nextAvailableDate
        ]);
    }


    $product         = Product::findOrFail($productId);
    $deposit_amount  = $product->price;   // base security deposit
    $per_day_rent    = $product->rent;
    $total_rent      = $days * $per_day_rent;

    /* ---------------- Discount Logic ---------------- */
    $discount = 0;
    if ($days >= 0 && $days <= 7) {
        $discount = $product->offer_7 ?? 0;
    } elseif ($days >= 8 && $days <= 15) {
        $discount = $product->offer_15 ?? 0;
    } elseif ($days >= 16) {
        $discount = $product->offer_30 ?? 0;
    }

    $discounted_rent = $total_rent * (1 - ($discount / 100));
    $discount_amount = $total_rent - $discounted_rent;

    /* ---------------- Money-Flow Logic ---------------- */
    $extra_charge       = 0;
    $pay_now            = 0;
    $refund_at_checkout = 0;

    // Difference between deposit and rent
    $difference = $deposit_amount - $discounted_rent;

    if ($difference >= 0 && $difference <= 2000) {
        // Special Case: rent is close to deposit (gap ≤ 2000)
        $extra_charge       = 2000;
        $pay_now            = $deposit_amount + $extra_charge;
        $refund_at_checkout = $difference + $extra_charge; // (deposit - rent + 2000)
    } elseif ($discounted_rent < $deposit_amount) {
        // Rent kam hai deposit se (normal case)
        $pay_now            = $deposit_amount;
        $refund_at_checkout = $deposit_amount - $discounted_rent;
    } else {
        // Rent jyada hai deposit se
        $extra_charge       = 2000;
        $pay_now            = $discounted_rent + $extra_charge;
        $refund_at_checkout = $extra_charge;
    }

    session(['discount' => $discount]);

    $final_amount = $pay_now;

    $message = $discount > 0
        ? "🎉 You saved ₹" . number_format($discount_amount, 2) .
          " with {$discount}% discount on rent!"
        : "✅ No discount applied.";

    return response()->json([
        'message'            => $message,
        'discount'           => $discount,
        'discount_amount'    => number_format($discount_amount, 2),
        'rent'               => number_format($per_day_rent, 2),
        'deposit'            => number_format($deposit_amount, 2),
        'total_rent'         => number_format($total_rent, 2),
        'discounted_rent'    => number_format($discounted_rent, 2),
        'extra_charge'       => number_format($extra_charge, 2),
        'pay_now'            => number_format($pay_now, 2),
        'remaining_rent'     => number_format($refund_at_checkout, 2), // ✅ Final correct refund logic
        'final_amount'       => number_format($final_amount, 2),
        'days'               => $days
    ]);
}






public function product_edit_front(Request $request,$slug){
    $product = Product::where('slug',$slug)->where('user_id',Auth::user()->id)->firstorfail();
    if ($request->method() == "POST") {
        $product->update([
            'offer_7' => $request->input('offer_7'),
            'offer_15' => $request->input('offer_15'),
            'offer_30' => $request->input('offer_30'),
        ]);
        return redirect('/my-products')->with('success', 'Offers updated successfully.');
    }
        return view('front.product_edit',compact('product'));
}

}