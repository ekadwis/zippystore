<?php

namespace App\Libraries\PaymentGateway;

/**
 * DuitkuService
 * Library integrasi Payment Gateway Duitku (POP API / Request Transaction & Callback)
 * Mendukung mode Sandbox & Production
 */
class DuitkuService
{
    protected string $merchantCode;
    protected string $apiKey;
    protected string $env; // 'sandbox' atau 'production'
    protected string $baseUrl;

    public function __construct(?string $env = null)
    {
        $this->env          = $env ?: (getenv('DUITKU_ENV') ?: 'sandbox');
        $this->merchantCode = getenv('DUITKU_MERCHANT_CODE') ?: '';
        $this->apiKey       = getenv('DUITKU_API_KEY') ?: '';

        $this->baseUrl = ($this->env === 'production')
            ? 'https://passport.duitku.com/webapi/api/merchant/'
            : 'https://sandbox.duitku.com/webapi/api/merchant/';
    }

    /**
     * Kirim request JSON POST ke Duitku
     */
    protected function postRequest(string $endpoint, array $payload): array
    {
        $url = rtrim($this->baseUrl, '/') . '/' . ltrim($endpoint, '/');
        $jsonPayload = json_encode($payload);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($jsonPayload),
        ]);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            return [
                'success' => false,
                'message' => 'cURL Error: ' . $error,
                'raw'     => null,
            ];
        }

        $decoded = json_decode($response, true);

        return [
            'success'   => ($httpCode === 200 && !empty($decoded['paymentUrl'])),
            'data'      => $decoded,
            'http_code' => $httpCode,
            'raw'       => $response,
        ];
    }

    /**
     * Buat Transaksi Pembayaran (Request Transaction)
     *
     * @param string $merchantOrderId Kode unik pesanan toko (order_code)
     * @param int    $paymentAmount   Nominal tagihan
     * @param string $paymentMethod   Metode bayar (contoh: 'SP' untuk QRIS ShopeePay/All, 'NQ' untuk Nobu QRIS, 'VA' untuk BCA, dll)
     * @param string $productDetails  Nama produk/layanan
     * @param array  $customer        ['name' => ..., 'email' => ..., 'phone' => ...]
     * @param string $callbackUrl     URL webhook callback
     * @param string $returnUrl       URL redirect buyer setelah bayar
     */
    public function createInvoice(
        string $merchantOrderId,
        int $paymentAmount,
        string $paymentMethod = 'SP', // Default QRIS
        string $productDetails = 'Sosmed Boost Order',
        array $customer = [],
        ?string $callbackUrl = null,
        ?string $returnUrl = null
    ): array {
        $callbackUrl = $callbackUrl ?: base_url('payment/duitku-callback');
        $returnUrl   = $returnUrl ?: base_url('sosmed');

        // Signature Request Transaction Duitku:
        // MD5(merchantCode + merchantOrderId + paymentAmount + apiKey)
        $signature = md5($this->merchantCode . $merchantOrderId . $paymentAmount . $this->apiKey);

        $params = [
            'merchantCode'     => $this->merchantCode,
            'paymentAmount'    => (int)$paymentAmount,
            'paymentMethod'    => $paymentMethod,
            'merchantOrderId'  => $merchantOrderId,
            'productDetails'   => $productDetails,
            'email'            => $customer['email'] ?? 'customer@zippystore.my.id',
            'phoneNumber'      => $customer['phone'] ?? '081234567890',
            'customerVaName'   => $customer['name'] ?? 'Pelanggan Zippy Store',
            'callbackUrl'      => $callbackUrl,
            'returnUrl'        => $returnUrl,
            'signature'        => $signature,
            'expiryPeriod'     => 1440, // 24 jam (dalam menit)
        ];

        return $this->postRequest('v2/inquiry', $params);
    }

    /**
     * Validasi Signature Callback Webhook dari Duitku
     * Format Duitku Callback Signature: MD5(merchantCode + amount + merchantOrderId + apiKey)
     */
    public function validateCallback(array $postData): bool
    {
        $merchantCode    = $postData['merchantCode'] ?? '';
        $amount          = $postData['amount'] ?? '';
        $merchantOrderId = $postData['merchantOrderId'] ?? '';
        $signature       = $postData['signature'] ?? '';

        if (empty($signature) || empty($merchantOrderId)) {
            return false;
        }

        $calculatedSignature = md5($merchantCode . $amount . $merchantOrderId . $this->apiKey);
        return hash_equals($calculatedSignature, $signature);
    }
}

