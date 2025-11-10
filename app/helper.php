<?php

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Juspay\RequestOptions;
use Juspay\Exception\JuspayException;
use Juspay\JuspayEnvironment;
use Juspay\Model\JuspayJWT;
use Juspay\Model\OrderSession;
use Illuminate\Support\Facades\Http;



if (!function_exists('isProductAvailable')) {
    function isProductAvailable($productId, $checkIn, $checkOut)
    {
        // If no dates are selected, always allow booking
        if (!$checkIn || !$checkOut) {
            return true;
        }

        // Normalize date range
        $checkIn = \Carbon\Carbon::parse($checkIn)->startOfDay();
        $checkOut = \Carbon\Carbon::parse($checkOut)->endOfDay();

        // Check if product has any active booking that overlaps with selected date range
        $hasRunningBooking = DB::table('booking')
            ->where('product_id', $productId)
            ->where('owner_status', 'accept') // booking accepted by owner
            ->where(function ($query) {
                // Exclude bookings that are cancelled, completed or checkout accepted
                $query->whereNotIn('booking_status', ['cancelled', 'complete'])
                      ->whereNotIn('booking_status_user', ['cancelled'])
                      ->where('checkout_status', '!=', 'accept');
            })
            ->where(function ($query) use ($checkIn, $checkOut) {
                // Find bookings that overlap with selected period
                $query->where('check_in', '<=', $checkOut)
                      ->where('check_out', '>=', $checkIn);
            })
            ->exists();

        // Return true if no conflicting booking found
        return !$hasRunningBooking;
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


if (!function_exists('create_hdfc_order')) {
    function create_hdfc_order($amount, $orderId)
    {
        $merchantId = 'SG3667';
        $clientId = 'hdfcmaster';
        $authHeader = 'MjMzQTJBRjQ2REI0NTNCOTQ0Q0JBMUFCNDlGOTIyOg==';

        $env = 'sandbox'; // sandbox / production

         $merchantKeyId = '122050';
        $apiKey = 'key_0f086b6b9e4b4569a71749c413565f30';
        $encodedAuth = base64_encode($merchantKeyId . ':' . $apiKey);

        $baseUrl = $env == 'sandbox'
            ? 'https://smartgatewayuat.hdfcbank.com/session'
            : 'https://securepg.hdfcbank.com/session';

        $orderId = 'ORDER_' . time();
        $customerId = 'CUST_' . time();

        $postData = [
            "order_id" => $orderId,
            "amount" => strval(20),
            "customer_id" => $customerId,
            "customer_email" => Auth::user() ? Auth::user()->email : $customerEmail,
            "customer_phone" => Auth::user() ? Auth::user()->phone : $customerPhone,
            "payment_page_client_id" => $clientId,
            "action" => "paymentPage",
            "currency" => "INR",
            "return_url" => url('/verify-payment'),
            "description" => "Complete your payment",
            "first_name" => Auth::user() ? Auth::user()->name : $firstName,
            "last_name" => Auth::user() ? Auth::user()->last_name : $lastName
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $baseUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
             'Authorization: Basic ' . $authHeader,
            'Content-Type: application/json',
            'x-merchantid: ' . $merchantId,
            'x-customerid: ' . $clientId,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            return ['error' => true, 'message' => curl_error($ch)];
        }

        curl_close($ch);

        $result = json_decode($response, true);

        return $result;
    }
}
// Usage



if (!function_exists('verifyHdfcOrder')) {
    function verifyHdfcOrder($orderId)
    {
        // === HDFC Credentials ===
        $merchantId = '122050'; // apna merchant ID yahan daal
        $customerId = 'CUS12345'; // agar customer id fix ya dynamic hai
        $apiKey = '8BD7739021F4AACA8C540DAD31C764'; // apna API key
        $merchantKeyId = '233A2AF46DB453B944CBA1AB49F922'; // ya jo bhi key hai
        $version = '2023-06-30';

        // === Base64 Encode for Authorization Header ===
        $encodedAuth = base64_encode($merchantKeyId . ':' . $apiKey);

        // === API Endpoint ===
        $url = "https://smartgateway.hdfcuat.bank.in/orders/{$orderId}";

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Basic ' . $encodedAuth,
                'version' => $version,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'x-merchantid' => $merchantId,
                'x-customerid' => $customerId,
            ])->get($url);

            if ($response->successful()) {
                return $response->json();
            } else {
                return [
                    'error' => true,
                    'status' => $response->status(),
                    'message' => $response->body()
                ];
            }
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => $e->getMessage()
            ];
        }
    }
}