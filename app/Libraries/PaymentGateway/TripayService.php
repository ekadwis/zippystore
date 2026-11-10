<?php

namespace App\Libraries\PaymentGateway;

/**
 * TripayService
 * Library integrasi Payment Gateway Tripay (Closed Payment / QRIS Dinamis)
 */
class TripayService
{
    protected string $apiKey;
    protected string $privateKey;
    protected string $merchantCode;
    protected string $mode; // 'sandbox' atau 'production'
    protected string $apiUrl;

    public function __construct(?string $mode = null)
    {
        $this->mode         = $mode ?: (getenv('TRIPAY_MODE') ?: 'sandbox');
        $this->apiKey       = getenv('TRIPAY_API_KEY') ?: '';
        $this->privateKey   = getenv('TRIPAY_PRIVATE_KEY') ?: '';
        $this->merchantCode = getenv('TRIPAY_MERCHANT_CODE') ?: '';

        $this->apiUrl = ($this->mode === 'production')
            ? 'https://tripay.co.id/api/'
            : 'https://tripay.co.id/api-sandbox/';
    }

    /**
     * Kirim request cURL ke Tripay API
     */
    protected function request(string $endpoint, array $data = [], string $method = 'POST'): array
    {
        $ch = curl_init();
        $url = rtrim($this->apiUrl, '/') . '/' . ltrim($endpoint, '/');

        $headers = [
            'Authorization: Bearer ' . $this->apiKey,
        ];

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($error) {
            return [
                'success' => false,
                'message' => 'cURL Error: ' . $error,
            ];
        }

        $decoded = json_decode($response, true);

        return [
            'success'   => ($httpCode === 200 && !empty($decoded['success'])),
            'data'      => $decoded['data'] ?? null,
            'message'   => $decoded['message'] ?? 'Respon diterima',
            'raw'       => $response,
            'http_code' => $httpCode,
        ];
    }

    /**
     * Ambil Channel Pembayaran Aktif
     */
    public function getPaymentChannels(): array
    {
        return $this->request('merchant/payment-channel', [], 'GET');
    }

    /**
     * Buat Transaksi Pembayaran Baru (Contoh: QRIS / QRIS2)
     *
     * @param string $merchantRef Kode unik pesanan toko (contoh: order_code)
     * @param int    $amount      Nominal tagihan
     * @param string $method      Metode bayar (default 'QRIS')
     * @param array  $customer    Info pembeli: ['name' => ..., 'email' => ..., 'phone' => ...]
     * @param array  $orderItems  Item yang dibeli: [['name' => ..., 'price' => ..., 'quantity' => 1]]
     * @param string $returnUrl   URL redirect setelah bayar
     */
    public function createTransaction(
        string $merchantRef,
        int $amount,
        string $method = 'QRIS',
        array $customer = [],
        array $orderItems = [],
        ?string $returnUrl = null
    ): array {
        // Generate Signature Tripay: HMAC-SHA256(merchant_code + merchant_ref + amount, private_key)
        $signature = hash_hmac('sha256', $this->merchantCode . $merchantRef . $amount, $this->privateKey);

        $payload = [
            'method'         => $method,
            'merchant_ref'   => $merchantRef,
            'amount'         => $amount,
            'customer_name'  => $customer['name'] ?? 'Pelanggan Zippy Store',
            'customer_email' => $customer['email'] ?? 'customer@zippystore.my.id',
            'customer_phone' => $customer['phone'] ?? '081234567890',
            'order_items'    => $orderItems,
            'return_url'     => $returnUrl ?: base_url('sosmed'),
            'expired_time'   => (time() + (24 * 60 * 60)), // Berlaku 24 jam
            'signature'      => $signature,
        ];

        return $this->request('transaction/create', $payload, 'POST');
    }

    /**
     * Validasi Signature Callback Webhook Tripay
     */
    public function validateCallback(string $jsonPayload, string $callbackSignature): bool
    {
        $computedSignature = hash_hmac('sha256', $jsonPayload, $this->privateKey);
        return hash_equals($computedSignature, $callbackSignature);
    }
}

