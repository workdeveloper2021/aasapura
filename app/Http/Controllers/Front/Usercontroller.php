<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorEnquiry;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Auth;


class Usercontroller extends Controller
{
    public function bulk_enquiry(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->validate([
                'name'             => 'required|string|max:255',
                'email'            => 'required|email|max:255',
                'phone'            => 'required|string|max:20',
                'address_1'        => 'required|string',
                'check_in_date'    => 'required|date_format:d/m/Y',
                'check_out_date'   => 'required|date_format:d/m/Y|after_or_equal:check_in_date',
                'quantity'         => 'required|integer|min:1',
                'vendor_id'        => 'required|exists:users,id',
            ]);
    
            $data['check_in_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_in_date'])->format('Y-m-d');
            $data['check_out_date'] = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_out_date'])->format('Y-m-d');
    
            VendorEnquiry::create($data);
    
            return redirect('/bulk-enquiry')->with('success', 'Enquiry submitted successfully.');
        }
        return view('front.users.bulk_enquiry');
    }

    public function my_enquires(){
        $user = auth()->user();
        $enquiries = VendorEnquiry::where('vendor_id', $user->id)->paginate(10); // 10 per page
        return view('front.users.my_enquires', compact('enquiries'));
    }


    public function mywallet(Request $request){
 
  $transactions = WalletTransaction::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->paginate(20);
       return view('front.mywallet',compact('transactions'));
 }


}