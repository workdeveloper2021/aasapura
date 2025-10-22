<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class Auditorcontroller extends Controller
{
    public function dashboard (){

        $data['total_cycles'] = DB::table('products')
        ->join('brands', 'products.brands', '=', 'brands.id')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->join('users', 'products.user_id', '=', 'users.id')
        // ->where('verify_status','verified')
        ->count();

        $data['verified_cycles'] = DB::table('products')
        ->join('brands', 'products.brands', '=', 'brands.id')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('verify_status','verified')
        ->count();


        $data['renter_cycles'] = DB::table('products')
        ->join('brands', 'products.brands', '=', 'brands.id')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('users.role','provider')
        ->where('verify_status','verified')
        ->count();

        $data['provider_cycles'] = DB::table('products')
        ->join('brands', 'products.brands', '=', 'brands.id')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('users.role','vendor')
        ->where('verify_status','verified')
        ->count();

        $data['repair_cycles'] = DB::table('products')
        ->join('brands', 'products.brands', '=', 'brands.id')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('repair_status', 'requested')
        ->where('auditor', Auth::user()->id)
        ->count();

        return view('auditor/dashboard',$data);
    }

    public function repairCycles()
{
    $results = DB::table('products')
        ->join('brands', 'products.brands', '=', 'brands.id')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->join('users', 'products.user_id', '=', 'users.id')
        ->where('repair_status', 'requested')
        ->where('auditor', Auth::user()->id)
        ->select('products.*', 'brands.name as brand_name', 'categories.name as category_name', 'users.name as username', 'users.role as usertype')
        ->paginate(10);
    
    return view('auditor/repair_cycles', compact('results'));
}



public function markRepaired($id)
{
    $product = Product::find($id);
    
    if ($product) {
        // Reset service counter to 0
        $product->service_days_count = 0;
        $product->repair_status = 'completed';
        $product->last_repair_date = now();
        $product->auditor = null;
        $product->save();
        
        return redirect()->back()->with('success', 'Cycle marked as repaired successfully. Service day counter has been reset.');
    } else {
        return redirect()->back()->with('error', 'Cycle not found');
    }
}



    public function cycles (){


        if (isset($_GET['added_by']) && !empty($_GET['added_by']) && $_GET['added_by'] =="rentar"){
            $results = DB::table('products')
            ->join('brands', 'products.brands', '=', 'brands.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->where('verify_status','verified')
            ->where('users.role','provider')
            ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username','users.role as usertype')
            ->get();
        }elseif(isset($_GET['added_by']) && !empty($_GET['added_by']) && $_GET['added_by'] =="provider"){
            $results = DB::table('products')
            ->join('brands', 'products.brands', '=', 'brands.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->where('verify_status','verified')
            ->where('users.role','vendor')
            ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username','users.role as usertype')
            ->get();
        }else{
            $results = DB::table('products')
            ->join('brands', 'products.brands', '=', 'brands.id')
            ->join('categories', 'products.category', '=', 'categories.id')
            ->join('users', 'products.user_id', '=', 'users.id')
            ->where('verify_status','verified')
            ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username','users.role as usertype')
            ->paginate(10);
        }


        return view('auditor/cycles',compact('results'));
    }

    public function view_cycle($id){
        $row = DB::table('products')
    ->join('brands', 'products.brands', '=', 'brands.id')
    ->join('categories', 'products.category', '=', 'categories.id')
    ->join('state', 'products.state', '=', 'state.id')
    ->join('district', 'products.district', '=', 'district.id')
    ->join('users', 'products.user_id', '=', 'users.id')
    ->where('products.id',$id)
    ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username','state.name as statename','district.name as district_name')
    ->first();
        return view('auditor/view_cycle',compact('row'));
    }


    public function myprofile(Request $request){
        if ($request->method() == "POST") {

        }else{
            return view('auditor/myprofile');
        }
    }


    public function updateprofile(Request $request){
        $userid  = Auth::user()->id;

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address_1' => $request->address,
        ];

        DB::table('users')->where('id',$userid)->update($data);
        return redirect()->back()->with('success','Profile Updated Successfully');

    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('success','Log Out Successfully');
    }



}