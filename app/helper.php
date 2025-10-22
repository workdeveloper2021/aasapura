<?php

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



if (!function_exists('isProductAvailable')) {
    function isProductAvailable($productId, $checkIn, $checkOut)
    {
        // If no dates are selected, don't block booking
        if (!$checkIn || !$checkOut) {
            return true;
        }

       $checkIn = Carbon::parse($checkIn)->startOfDay();
$checkOut = Carbon::parse($checkOut)->endOfDay();

        $conflictingBooking = DB::table('booking')
            ->where('product_id', $productId)
            ->where('owner_status', 'accept')
            ->whereIn('booking_status', ['running', 'complete', 'decline_ride']) // include all statuses
            ->where(function ($query) use ($checkIn, $checkOut) {
                $query->whereBetween('check_in', [$checkIn, $checkOut])
                    ->orWhereBetween('check_out', [$checkIn, $checkOut])
                    ->orWhere(function ($query) use ($checkIn, $checkOut) {
                        $query->where('check_in', '<=', $checkIn)
                              ->where('check_out', '>=', $checkOut);
                    });
            })
            ->exists();

        return !$conflictingBooking;
    }
}

function getcategories(){
    $categories  = DB::table('categories')->where('parent_category',0)->where('status','Y')->get();
    return $categories;
}


function view_seller($user_id){
    $user  = DB::table('users')->where('id',$user_id)->first();
    if(isset($user)){
    return $user->name;    
    }else{
        return "User Not Found";
    }
    
}

function bookornotbook($product_id){
    $getorder = DB::table('booking')->where('product_id',$product_id)->where('booking_status','running')->first();
    if(isset($getorder)){
        return "Booked";
    }else{
        return "Book Now";
    }
}



function remaining_service_time($product_id)
{
    $product = DB::table('products')->where('id', $product_id)->first();
    
    if ($product) {
        return $product->service_days_count;
    }
    
    return 0;
}




if (!function_exists('uploadImage')) {
    function uploadImage($file, $data)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('uploads', $fileName);
        return $data->image = $fileName;
    }
}


if (!function_exists('uploadImagedyanamic')) {
    function uploadImagedyanamic($file, $data,$colom)
    {
        $fileName = rand() . rand() . '_' . $file->getClientOriginalName();
        $file->move('products', $fileName);
        return $data->$colom = $fileName;
    }
}

if (!function_exists('imagegetnameandupload')) {
    function imagegetnameandupload($file)
    {
        $fileName = rand() . rand() . '_' . $file->getClientOriginalName();
        $file->move('products', $fileName);
        return $fileName;
    }
}


if (!function_exists('updateImage')) {
    function updateImage($file, $data)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('uploads', $fileName);
        if ($data->image) {
            $image_path = public_path("uploads/" . $data->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }

        }
        return $data->image = $fileName;
    }

}


if (!function_exists('updateimagedy')) {
    function updateimagedy($file, $data,$colom)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        $file->move('uploads', $fileName);
        if ($data->$colom) {
            $image_path = public_path("uploads/" . $data->$colom);
            if (file_exists($image_path)) {
                unlink($image_path);
            }

        }
        return $data->$colom = $fileName;
    }

}
if (!function_exists('updateImagefavicon')) {
    function updateImagefavicon($file, $data)
    {
        $fileName = rand().time() . '_' . $file->getClientOriginalName();
        $file->move('uploads', $fileName);
        if ($data->favicon) {
            $image_path = public_path("uploads/" . $data->favicon);
            if (file_exists($image_path)) {
                unlink($image_path);
            }

        }
        return $data->favicon = $fileName;
    }

}

function countsubcategories($id){
    $data = DB::table('categories')->where('parent_category',$id)->count();
    return $data;
}

function checkifprovider_post_or_not(){
    $user_id = Auth::user()->id;
    if (Auth::user()->role == "provider") {

    $find = DB::table('products')->where('user_id',$user_id)->first();
    if (isset($find)) {
        return "false";
    }else{
        return "true";
    }

}else{
    return "true";
}


}

function countproductbycategories($category){
    $data = DB::table('products')->where('category',$category)->count();
    return $data;
}



function create_razorpay_order($amount,$order_id){

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/orders');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'content-type: application/json',
    ]);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_QnDKE8IS9ia1FB:eWBOWYbhq3dhFfZi7czd2GS0');
    curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"amount\": $amount,\n  \"currency\": \"INR\",\n  \"receipt\": \"receipt#1\",\n  \"notes\": {\n    \"order_id\": \"$order_id\",\n    \"key2\": \"value2\"\n  }\n}");

    $response = curl_exec($ch);
    // echo "<pre>";
    $result = json_decode($response);

    curl_close($ch);

    return $result;

}



function checkifrefunded($payment_id){
    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payments/'.$payment_id.'/refunds');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_QnDKE8IS9ia1FB' . ':' . 'eWBOWYbhq3dhFfZi7czd2GS0');

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

$response = json_decode($result);
return $response;

}


function createrefund($paymentid,$mainamount){
    
    $ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.razorpay.com/v1/payments/'.$paymentid.'/refund');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
]);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_USERPWD, 'rzp_test_QnDKE8IS9ia1FB:eWBOWYbhq3dhFfZi7czd2GS0');
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n  \"amount\": 100\n}");

$response = curl_exec($ch);

curl_close($ch);


$result = json_decode($response,true);
return $result;

}



function site_favicon(){
    $icon = DB::table('site_setting')->where('id',1)->first();
    if(isset($icon)){
        return $icon->favicon;
    }else{
        echo "not found";
    }
}


function site_logo(){
    $icon = DB::table('site_setting')->where('id',1)->first();
    if(isset($icon)){
        return $icon->image;
    }else{
        echo "not found";
    }
}

function site_phone(){
    $icon = DB::table('site_setting')->where('id',1)->first();
    if(isset($icon)){
        $json = json_decode($icon->info_first);
        return $json->phone;
    }else{
        echo "not found";
    }
}


function site_email(){
    $icon = DB::table('site_setting')->where('id',1)->first();
    if(isset($icon)){
        $json = json_decode($icon->info_first);
        return $json->email;
    }else{
        echo "not found";
    }
}


function site_address(){
    $icon = DB::table('site_setting')->where('id',1)->first();
    if(isset($icon)){
        $json = json_decode($icon->info_first);
        return $json->address;
    }else{
        echo "not found";
    }
}

function get_areas(){
    $areas = DB::table('areas')->where('status','Y')->get(['id','name']);
    return $areas;
}