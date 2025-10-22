<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;
use App\Models\Purchasedplans;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class Packagecontrolller extends Controller
{

public function packages()
{
    $packages = Packages::get();
    $purchased = Purchasedplans::where('user_id', Auth::id())
                    ->orderBy('id','desc')
                    ->get();
    return view('front.packages', compact('packages','purchased'));
}


//  public function buypackage(Request $request)
// {
//     if ($request->method() != "POST") {
//         return redirect('/');
//     }

//     $request->validate([
//         'package_id' => 'required|numeric',
//     ]);

//     $package = Packages::findOrFail($request->package_id);
//     $userId = Auth::id();

//     $startDate = now();
//     $endDate = now()->addDays(365);
//     $remainingDays = 365;

//     $purchase = new Purchasedplans();
//     $purchase->user_id = $userId;
//     $purchase->package_id = $package->id;
//     $purchase->start_date = $startDate;
//     $purchase->end_date = $endDate;
//     $purchase->post_quantity  = $package->post_quantity;
//     $purchase->used_posts = 0;
//     $purchase->status = 'active';
//     $purchase->amount_paid = $package->purchase_price;
//     $purchase->remaining_days = $remainingDays;
//     $purchase->remaining_value = $package->purchase_price;
//     $purchase->save();

//     return redirect()->back()->with('success', 'Package purchased successfully!');
// }


public function buypackage(Request $request)
{
    if ($request->method() != "POST") {
        return redirect('/');
    }

    $request->validate([
        'package_id' => 'required|numeric',
    ]);

    $package = Packages::findOrFail($request->package_id);
    $userId = Auth::id();

    // Check if user already has an active package
    $oldPurchase = Purchasedplans::where('user_id', $userId)
        ->whereIn('status', ['active', 'upgraded'])
        ->latest('id')
        ->first();

    // Agar already koi package hai to upgrade kar dena
    if ($oldPurchase) {
        $today = Carbon::now();
        $remainingDays = $today->diffInDays(Carbon::parse($oldPurchase->end_date), false);
        if ($remainingDays < 0) $remainingDays = 0;

        $remainingValue = ($oldPurchase->amount_paid / 365) * $remainingDays;
        // $newAmount = $package->purchase_price - $remainingValue;
        $newAmount = $package->purchase_price;

        // Remaining quantity from old package
        $oldRemainingPosts = $oldPurchase->post_quantity - $oldPurchase->used_posts;
        // $newTotalPosts = $package->post_quantity + $oldRemainingPosts;
        $newTotalPosts = $package->post_quantity;

        // Upgrade existing package
        $oldPurchase->package_id = $package->id;
        $oldPurchase->amount_paid = $newAmount;
        $oldPurchase->remaining_days = 365;
        $oldPurchase->remaining_value = $newAmount;
        $oldPurchase->post_quantity = $newTotalPosts;
        $oldPurchase->used_posts = 0;
        $oldPurchase->start_date = now();
        $oldPurchase->end_date = now()->addDays(365);
        $oldPurchase->status = 'upgraded';
        $oldPurchase->save();

        return redirect()->back()->with('success', 'Package upgraded successfully!');
    }

    // Otherwise create new purchase
    $purchase = new Purchasedplans();
    $purchase->user_id = $userId;
    $purchase->package_id = $package->id;
    $purchase->start_date = now();
    $purchase->end_date = now()->addDays(365);
    $purchase->post_quantity  = $package->post_quantity;
    $purchase->used_posts = 0;
    $purchase->status = 'active';
    $purchase->amount_paid = $package->purchase_price;
    $purchase->remaining_days = 365;
    $purchase->remaining_value = $package->purchase_price;
    $purchase->save();

    return redirect()->back()->with('success', 'Package purchased successfully!');
}



 public function renew($id)
    {
        $purchase = Purchasedplans::findOrFail($id);
      // Extend end_date by 365 days
        $purchase->end_date = Carbon::parse($purchase->end_date)->addDays(365);
        $purchase->remaining_days = 365;
        $purchase->remaining_value = $purchase->amount_paid; // full price
        $purchase->status = 'renewed';
        $purchase->save();
        return redirect()->back()->with('success','Package renewed successfully!');
    }



//     public function upgrade(Request $request, $id)
// {
//     $request->validate([
//         'package_id' => 'required|numeric'
//     ]);

//     $oldPurchase = Purchasedplans::findOrFail($id);
//     $newPackage = Packages::findOrFail($request->package_id);

//     $today = Carbon::now();
//     $remainingDays = $today->diffInDays(Carbon::parse($oldPurchase->end_date), false);
//     if($remainingDays < 0) $remainingDays = 0;

//     $remainingValue = ($oldPurchase->amount_paid / 365) * $remainingDays;

//     $newAmount = $newPackage->purchase_price - $remainingValue;

//     $startDate = now();
//     $endDate = now()->addDays(365);

//     $newPurchase = new Purchasedplans();
//     $newPurchase->user_id = Auth::id();
//     $newPurchase->package_id = $newPackage->id;
//     $newPurchase->start_date = $startDate;
//     $newPurchase->end_date = $endDate;
//     $newPurchase->status = 'upgraded';
//     $newPurchase->amount_paid = $newAmount;
//     $newPurchase->remaining_days = 365;
//     $newPurchase->remaining_value = $newAmount;
//     $newPurchase->save();

//     return redirect()->back()->with('success','Package upgraded successfully!');
// }




public function upgrade(Request $request, $id)
{
    $request->validate([
        'package_id' => 'required|numeric'
    ]);

    $oldPurchase = Purchasedplans::findOrFail($id);
    $newPackage = Packages::findOrFail($request->package_id);

    $today = Carbon::now();
    $remainingDays = $today->diffInDays(Carbon::parse($oldPurchase->end_date), false);
    if($remainingDays < 0) $remainingDays = 0;

    $remainingValue = ($oldPurchase->amount_paid / 365) * $remainingDays;
    // $newAmount = $newPackage->purchase_price - $remainingValue;
    $newAmount = $newPackage->purchase_price;

    // Remaining quantity from old package
    $oldRemainingPosts = $oldPurchase->post_quantity - $oldPurchase->used_posts;
    // $newTotalPosts = $newPackage->post_quantity + $oldRemainingPosts;
    $newTotalPosts = $newPackage->post_quantity;

    // Upgrade existing purchase instead of creating new one
    $oldPurchase->package_id = $newPackage->id;
    $oldPurchase->amount_paid = $newAmount;
    $oldPurchase->remaining_days = $remainingDays;
    $oldPurchase->remaining_value = $remainingValue;
    $oldPurchase->post_quantity = $newTotalPosts;
    $oldPurchase->used_posts = 0;
    $oldPurchase->status = 'upgraded';
    $oldPurchase->save();

    return redirect()->back()->with('success','Package upgraded successfully!');
}



}