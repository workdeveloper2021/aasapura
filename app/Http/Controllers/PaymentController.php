<?php

namespace App\Http\Controllers;

use App\Services\HdfcSmartGatewayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Booking;


class PaymentController extends Controller
{
    public function createOrder()
    {
        $service = new HdfcSmartGatewayService();

        $orderId = "ORD" . time();
        $amount = 100;
        $returnUrl = route('payment.callback');

        $response = $service->createPaymentOrder($amount, $orderId, $returnUrl);
           
        // Redirect user to HDFC payment page
        return redirect($response['paymentUrl']);
    }

   public function callback_HDFC(Request $request)
{
    $data = session()->get('booking_data');
    if (empty($data)) {
        return redirect('/')->with('error', 'Invalid payment request');
    }

    Log::info('HDFC callback data:', $request->all());

    $orderId = $data['order_id'];
    $customerId = $data['customer_id'] ?? null;

    $service = new HdfcSmartGatewayService();
    $result = $service->verifyPayment($orderId, $customerId);

    Log::info('HDFC Payment Verification Result: ', $result);

    if (isset($result['status']) && strtoupper($result['status']) === 'CHARGED') {
        $booking = new Booking;
        $booking->name       = $data['name'] ?? null;
        $booking->order_id   = $orderId;
        $booking->product_id = $data['product_id'];
        $booking->seller_id  = $data['seller_id'];
        $booking->user_id    = $data['user_id'];
        $booking->discount   = $data['discount'] ?? 0;
        $booking->securityamount = isset($data['securityamount']) 
            ? round((float) $data['securityamount'], 2) 
            : 0.00;

        $checkin  = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_in'])->format('Y-m-d');
        $checkout = \Carbon\Carbon::createFromFormat('d/m/Y', $data['check_out'])->format('Y-m-d');

        $booking->check_in  = $checkin;
        $booking->check_out = $checkout;
        $booking->phone     = $data['phone'] ?? null;
        $booking->address_1 = $data['address_1'] ?? null;
        $booking->address_2 = $data['address_2'] ?? null;
        $booking->pincode   = $data['pincode'] ?? null;
        $booking->verify         = 'Y';
        $booking->quantity       = 1;
        $booking->payment_verify = 'Y';
        $booking->paid_amount    = $result['amount'];

        $booking->save();

        session()->forget(['booking_submit_items', 'booking_data', 'discount']);

        return redirect('/')->with('success', 'Order Created Successfully');
    }

    return redirect('/book-cycle')->with('error', 'Payment Failed or Not Charged');
}

}
