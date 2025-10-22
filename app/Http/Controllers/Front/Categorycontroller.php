<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\State;
use Illuminate\Support\Facades\DB;

class Categorycontroller extends Controller
{
    
    
    public function searchcycles(Request $request){
        $location = $request->location;
        $category = $request->category;
        $checkin = $request->checkin;
        $checkout = $request->checkout;
        
        // Redirect with all parameters
        return redirect('/rental-products?location='.$location.'&searchcategory='.$category.'&checkin='.$checkin.'&checkout='.$checkout);
    }
    
    
    // public function products(Request $request){
    //     $data['categories'] = Category::where('status','Y')->where('parent_category',0)->get();
    //     $data['brand'] = Brands::where('status','Y')->get();
    //     $data['State'] = State::where('status','Y')->get();
        
    //     // Prepare the base query - this will be reused
    //     $baseQuery = Product::where('is_verify','Y')
    //         ->where(function($query) {
    //             $query->where('repair_status', '!=', 'requested')
    //                   ->orWhereNull('repair_status');
    //         });
        
    //     // Handle date filtering if both dates are provided
    //     $checkin = isset($_GET['checkin']) && !empty($_GET['checkin']) ? $_GET['checkin'] : null;
    //     $checkout = isset($_GET['checkout']) && !empty($_GET['checkout']) ? $_GET['checkout'] : null;
        
    //     if ($checkin && $checkout) {
    //         // Get IDs of products that are booked during the selected date range
    //         $bookedProductIds = DB::table('booking')
    //             ->where('booking_status', '!=', 'cancelled')
    //             ->where(function($query) use ($checkin, $checkout) {
    //                 // Find bookings that overlap with the requested date range
    //                 $query->where(function($q) use ($checkin, $checkout) {
    //                     $q->where('check_in', '<=', $checkout)
    //                       ->where('check_out', '>=', $checkin);
    //                 });
    //             })
    //             ->pluck('product_id')
    //             ->toArray();
            
    //         // Exclude booked products from our results
    //         if (!empty($bookedProductIds)) {
    //             $baseQuery->whereNotIn('products.id', $bookedProductIds);
    //         }
    //     }
        
    //     if ($request->method() == "POST") {
    //         if ($request->categories) {
    //             $selectedCategories = $request->categories;
    //             $data['categories'] = Category::where('status','Y')->where('parent_category',0)->get();
    //             $data['products'] = $baseQuery
    //                 ->join('categories', 'products.category', '=', 'categories.id')
    //                 ->whereIn('categories.id', $selectedCategories)
    //                 ->join('state', 'products.state', '=', 'state.id')
    //                 ->join('district', 'products.district', '=', 'district.id')
    //                 ->select('products.id','products.category', 'products.title','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                 ->paginate(20);
    //         }
    //         elseif($request->size){
    //             $selectedsize = $request->size;
    //             $data['products'] = $baseQuery
    //                 ->join('categories', 'products.category', '=', 'categories.id')
    //                 ->whereIn('products.size', $selectedsize)
    //                 ->join('state', 'products.state', '=', 'state.id')
    //                 ->join('district', 'products.district', '=', 'district.id')
    //                 ->select('products.id','products.category', 'products.title', 'products.size','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                 ->paginate(20);
    //         }
    //         elseif($request->state){
    //             $selectedstate = $request->state;
    //             $data['products'] = $baseQuery
    //                 ->join('categories', 'products.category', '=', 'categories.id')
    //                 ->whereIn('products.state', $selectedstate)
    //                 ->join('state', 'products.state', '=', 'state.id')
    //                 ->join('district', 'products.district', '=', 'district.id')
    //                 ->select('products.id','products.category', 'products.title', 'products.size','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                 ->paginate(20);
    //         }
    //         else{
    //             $data['products'] = $baseQuery
    //                 ->orderBy('id','desc')
    //                 ->join('state', 'products.state', '=', 'state.id')
    //                 ->join('district', 'products.district', '=', 'district.id')
    //                 ->select('products.id','products.category', 'products.title','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                 ->paginate(20);
    //         }
    //     } else {
    //         if(isset($_GET['category']) && !empty($_GET['category'])){
    //             $data['products'] = $baseQuery
    //                 ->orderBy('id','desc')
    //                 ->join('state', 'products.state', '=', 'state.id')
    //                 ->join('district', 'products.district', '=', 'district.id')
    //                 ->where('products.category',$_GET['category'])
    //                 ->select('products.id','products.category', 'products.title','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                 ->paginate(20);
    //         } else {
    //             if(isset($_GET['location']) && !empty($_GET['location']) && isset($_GET['searchcategory']) && !empty($_GET['searchcategory'])){
    //                 $data['products'] = $baseQuery
    //                     ->orderBy('id','desc')
    //                     ->join('state', 'products.state', '=', 'state.id')
    //                     ->join('district', 'products.district', '=', 'district.id')
    //                     ->where('products.area', $_GET['location'])
    //                     ->where('products.category', $_GET['searchcategory'])
    //                     ->select('products.id','products.category', 'products.title','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                     ->paginate(20);
    //             }
    //             elseif(isset($_GET['location']) && !empty($_GET['location'])){
    //                 $data['products'] = $baseQuery
    //                     ->orderBy('id','desc')
    //                     ->join('state', 'products.state', '=', 'state.id')
    //                     ->join('district', 'products.district', '=', 'district.id')
    //                     ->where('products.area', $_GET['location'])
    //                     ->select('products.id','products.category', 'products.title','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                     ->paginate(20);
    //             }
    //             elseif(isset($_GET['searchcategory']) && !empty($_GET['searchcategory'])){
    //                 $data['products'] = $baseQuery
    //                     ->orderBy('id','desc')
    //                     ->join('state', 'products.state', '=', 'state.id')
    //                     ->join('district', 'products.district', '=', 'district.id')
    //                     ->where('products.category', $_GET['searchcategory'])
    //                     ->select('products.id','products.category', 'products.title','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                     ->paginate(20);
    //             } else {
    //                 $data['products'] = $baseQuery
    //                     ->orderBy('id','desc')
    //                     ->join('state', 'products.state', '=', 'state.id')
    //                     ->join('district', 'products.district', '=', 'district.id')
    //                     ->select('products.id','products.category', 'products.title','products.slug','products.price','products.image1','products.created_at','state.name as state_name','district.name as district_name')
    //                     ->paginate(20);
    //             }
    //         }
    //     }
        
    //     // Pass the date filter values to the view for form persistence
    //     $data['checkin'] = $checkin;
    //     $data['checkout'] = $checkout;
        
    //     return view('front/products/index', $data);
    // }



    public function products(Request $request)
{
    $data['categories'] = Category::where('status', 'Y')->where('parent_category', 0)->get();
    $data['brand'] = Brands::where('status', 'Y')->get();
    $data['State'] = State::where('status', 'Y')->get();

    $baseQuery = Product::where('is_verify', 'Y')
        ->where(function ($query) {
            $query->where('repair_status', '!=', 'requested')
                ->orWhereNull('repair_status');
        });

    // Date filtering
    $checkin = $request->get('checkin');
    $checkout = $request->get('checkout');

    if ($checkin && $checkout) {
        $bookedProductIds = DB::table('booking')
            ->where('booking_status', '!=', 'cancelled')
            ->where(function ($query) use ($checkin, $checkout) {
                $query->where('check_in', '<=', $checkout)
                    ->where('check_out', '>=', $checkin);
            })
            ->pluck('product_id')
            ->toArray();

        if (!empty($bookedProductIds)) {
            $baseQuery->whereNotIn('products.id', $bookedProductIds);
        }
    }

    // Apply filters
    $baseQuery
        ->join('categories', 'products.category', '=', 'categories.id')
        ->join('state', 'products.state', '=', 'state.id')
        ->join('district', 'products.district', '=', 'district.id');

    if ($request->isMethod('post')) {
        if ($request->filled('categories')) {
            $baseQuery->whereIn('categories.id', $request->categories);
        } elseif ($request->filled('size')) {
            $baseQuery->whereIn('products.size', $request->size);
        } elseif ($request->filled('state')) {
            $baseQuery->whereIn('products.state', $request->state);
        }
    } else {
        if ($request->filled('category')) {
            $baseQuery->where('products.category', $request->get('category'));
        }

        if ($request->filled('location')) {
            $baseQuery->where('products.area', $request->get('location'));
        }

        if ($request->filled('searchcategory')) {
            $baseQuery->where('products.category', $request->get('searchcategory'));
        }
    }

    $data['products'] = $baseQuery
        ->select(
            'products.id',
            'products.category',
            'products.title',
            'products.slug',
            'products.price',
            'products.size',
            'products.image1',
            'products.created_at',
            'state.name as state_name',
            'district.name as district_name'
        )
        ->orderBy('products.id', 'desc')
        ->paginate(20);

    // Send check-in/out values back to view
    $data['checkin'] = $checkin;
    $data['checkout'] = $checkout;

    return view('front/products/index', $data);
}

}