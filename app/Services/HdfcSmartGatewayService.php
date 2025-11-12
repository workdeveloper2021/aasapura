<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class HdfcSmartGatewayService
{
    protected $client;
    protected $baseUrl;
    protected $merchantId;
    protected $clientId;
    protected $username;
    protected $password;
    protected $HDFC_KEY_auth;

    public function __construct()
    {
        $this->client = new Client();
        $this->baseUrl = rtrim(env('HDFC_SG_BASE_URL'), '/');
        $this->merchantId = env('HDFC_SG_MERCHANT_ID');
        $this->clientId = env('HDFC_SG_CLIENT_ID');
        $this->username = env('HDFC_SG_USERNAME');
        $this->password = env('HDFC_SG_PASSWORD');
        $this->HDFC_KEY_auth = env('HDFC_KEY_auth');
    }

    /**
     * STEP 1: Create payment session (new API)
     */
    public function createPaymentOrder($amount, $orderId, $returnUrl, $customer)
    {
        $url = $this->baseUrl . "/session";

        $payload = [
            "order_id" => $orderId,
            "amount" => (string) $amount,
            "customer_id" => $customer['id'] ?? 'cust_' . time(),
            "customer_email" => $customer['email'] ?? 'test@mail.com',
            "customer_phone" => $customer['phone'] ?? '0000000000',
            "payment_page_client_id" => $this->clientId,
            "action" => "paymentPage",
            "currency" => "INR",
            "return_url" => $returnUrl,
            "description" => $customer['description'] ?? 'Complete your payment',
            "first_name" => $customer['first_name'] ?? 'John',
            "last_name" => $customer['last_name'] ?? 'Doe'
        ];

        Log::info("HDFC Payment Session Payload: " . json_encode($payload));

        $response = $this->client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'x-merchantid' => $this->merchantId,
                'x-customerid' => $payload['customer_id'],
                 'Authorization' => 'Basic ' . base64_encode($this->HDFC_KEY_auth),
            ],
            'json' => $payload,
            'http_errors' => false
        ]);

        $body = $response->getBody()->getContents();
        Log::info("HDFC Payment Session Response: " . $body);

        return json_decode($body, true);
    }

  public function verifyPayment($orderId, $customerId = null)
{
    try {
        $url = $this->baseUrl . "/orders/" . $orderId;

        $headers = [
            'Authorization' => 'Basic ' . base64_encode($this->HDFC_KEY_auth),
            'version'       => '2023-06-30',
            'Content-Type'  => 'application/x-www-form-urlencoded',
            'x-merchantid'  => $this->merchantId,
        ];

        if ($customerId) {
            $headers['x-customerid'] = $customerId;
        }

        $response = $this->client->get($url, [
            'headers' => $headers,
            'http_errors' => false,
        ]);

        $body = $response->getBody()->getContents();
        Log::info("HDFC Verify Payment Response: " . $body);

        return json_decode($body, true);
    } catch (\Exception $e) {
        Log::error("HDFC verifyPayment error: " . $e->getMessage());
        return ['status' => 'error', 'message' => $e->getMessage()];
    }
}

}
