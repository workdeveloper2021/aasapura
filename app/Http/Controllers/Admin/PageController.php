<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Enquiries;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function dashboard(){

          $data['products'] = DB::table('products')
    ->join('brands', 'products.brands', '=', 'brands.id')
    ->join('categories', 'products.category', '=', 'categories.id')
    ->join('users', 'products.user_id', '=', 'users.id')
    // ->where('verify_status','panding')
    ->select('products.*', 'brands.name as brand_name','categories.name as category_name','users.name as username')
    ->count();


     $data['enquires'] = Enquiries::count();
     $data['provider'] = User::where('role','provider')->count();
     $data['vendor'] = User::where('role','vendor')->count();
     $data['user'] = User::where('role','user')->count();
        return view('admin/dashboard',$data);
    }

    public function adminform(){
        return view('admin/adminform');
    }

    public function tables(){
        return view('admin/tables');
    }


    public function profile(){
        return view('admin.profile');
    }

    public function updatepassword(Request $request){
        $request->validate([
            'currunt_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);


        #Match The Old Password
        if(!Hash::check($request->currunt_password, auth()->user()->password)){
            return back()->with("error", "Currunt Password Doesn't match!");
        }

        #Update the new Password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("success", "Password changed successfully!");
    }

    public function updateprofileadmin(Request $request){
        if (Auth::check()) {
            $credentials = $request->validate([
                'name' => ['required'],
                'email' => ['required', 'email'],
                'phone' => ['required','digits:10'],
            ]);
            $userid = Auth::user()->id;
            $user = User::find($userid);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();
            return redirect()->back()->with('success','Profile Update Successfully');
        }
    }



}
