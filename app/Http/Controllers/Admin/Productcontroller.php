<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class Productcontroller extends Controller
{
    public function products(Request $request){
        if (isset($_GET['type']) && !empty($_GET['type'])) {
            if ($_GET['type'] == "panding") {

        $results = DB::table('products')
    ->join('brands', 'products.brands', '=', 'brands.id')
    ->join('categories', 'products.category', '=', 'categories.id')
    ->join('users', 'products.user_id', '=', 'users.id')
    ->where('verify_status','panding')
    ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username')
    ->get();

}elseif($_GET['type'] == "verified"){
    $results = DB::table('products')
    ->join('brands', 'products.brands', '=', 'brands.id')
    ->join('categories', 'products.category', '=', 'categories.id')
    ->join('users', 'products.user_id', '=', 'users.id')
    ->where('verify_status','verified')
    ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username')
    ->get();
}else{
    $results = DB::table('products')
    ->join('brands', 'products.brands', '=', 'brands.id')
    ->join('categories', 'products.category', '=', 'categories.id')
    ->join('users', 'products.user_id', '=', 'users.id')
    ->where('verify_status','reject')
    ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username')
    ->get();
}
        return view('admin/products/index',compact('results'));
    }
}


public function productview($id){
    $row = DB::table('products')
    ->join('brands', 'products.brands', '=', 'brands.id')
    ->join('categories', 'products.category', '=', 'categories.id')
    ->join('state', 'products.state', '=', 'state.id')
    ->join('district', 'products.district', '=', 'district.id')
    ->join('users', 'products.user_id', '=', 'users.id')
    ->where('products.id',$id)
    ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username','state.name as statename','district.name as district_name')
    ->first();

    return view('admin/products/productview',compact('row'));
}

public function product_verify($status,$id){
    $product = Product::find($id);

    if ($status == "verify") {
        $changed = "verified";
        $status = "Y";
    }else{
        $changed = "reject";
        $status = "N";

    }
    $product->verify_status = $changed;
    $product->is_verify = $status;
    $product->save();
    return redirect()->back()->with('success',' '.$changed.' Successfully');

}

public function delete_products($id){
    $product = Product::find($id);


        $image1 = public_path("products/" . $product->image1);
        if (file_exists($image1)) {
            unlink($image1);
        }


        $image2 = public_path("products/" . $product->image2);
        if (file_exists($image2)) {
            unlink($image2);
        }



        $image3 = public_path("products/" . $product->image3);
        if (file_exists($image3)) {
            unlink($image3);
        }



        $image4 = public_path("products/" . $product->image4);
        if (file_exists($image4)) {
            unlink($image4);
        }

        if (isset($product->image5)) {
        $image5 = public_path("products/" . $product->image5);
        if (file_exists($image5)) {
            unlink($image5);
        }
    }


    if (isset($product->image6)) {
        $image6 = public_path("products/" . $product->image6);
        if (file_exists($image6)) {
            unlink($image6);
        }
    }

    if (isset($product->image7)) {
        $image7 = public_path("products/" . $product->image7);
        if (file_exists($image7)) {
            unlink($image7);
        }
    }

    if (isset($product->image8)) {
        $image8 = public_path("products/" . $product->image8);
        if (file_exists($image8)) {
            unlink($image8);
        }
    }
    $product->delete();
    return redirect()->back()->with('success','Product Deleted Successfully.');
}
}
