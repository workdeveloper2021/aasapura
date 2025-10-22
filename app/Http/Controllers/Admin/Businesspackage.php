<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;


class Businesspackage extends Controller
{
    public function packages(){
        $data = Packages::get();
        return view('admin.package.index',compact('data'));
    }

    public function newpackage(Request $request){
        if ($request->method() == "POST") {

            $credentials = $request->validate([
                'name' => ['required'],
                'post_quantity' => ['required','numeric'],
                'price' => ['required','numeric'],
                'purchase_price' => ['required','numeric'],
            ]);

            $package = new Packages;
            $package->name = $request->name;
            $package->post_quantity = $request->post_quantity;
            $package->price = $request->price;
            $package->purchase_price = $request->purchase_price;
            $package->save();
            return redirect('/admin/packages')->with('success','Created Successfully');
        }else{
        return view('admin.package.create');
    }
    }

    public function packageupdate(Request $request, $id){
        $package =  Packages::find($id);
        if ($request->method() == "POST") {
            $credentials = $request->validate([
                'name' => ['required'],
                'post_quantity' => ['required','numeric'],
                'price' => ['required','numeric'],
                'purchase_price' => ['required','numeric'],
            ]);
            $package->name = $request->name;
            $package->post_quantity = $request->post_quantity;
            $package->price = $request->price;
            $package->purchase_price = $request->purchase_price;
            $package->save();
            return redirect('/admin/packages')->with('success','Updated Successfully');
        }else{
            return view('admin.package.edit',compact('package'));
        }
    }

}
