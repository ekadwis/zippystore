<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\LinkstreamingModel;

class Home extends BaseController
{

    protected $ProductsModel;
    protected $LinkstreamingModel;

    public function __construct()
    {
        $this->ProductsModel = new ProductsModel();
        $this->LinkstreamingModel = new LinkstreamingModel();
    }

    public function index(): string
    {
        $data['products'] = $this->ProductsModel->findAll();

        return view('homepage', $data);
    }

    public function purchase()
    {
        $customer_name = $this->request->getVar('customer_name');
        $email = $this->request->getVar('email');
        $phone_number = $this->request->getVar('phone_number');
        $price = (int) $this->request->getVar('price');
        $payment_method = $this->request->getVar('payment_method');


        // Fee adjustment
        if ($payment_method == 'bank') {
            $adjusted_price = $price + 4000; // Tambahan fee Rp 4.000 untuk bank transfer
        } elseif ($payment_method == 'qris') {
            $adjusted_price = $price + (0.02 * $price); // Tambah 2% untuk QRIS
        } elseif ($payment_method == 'ewallet') {
            $adjusted_price = $price + (0.04 * $price); // Tambah 4% untuk E Wallet
        } elseif ($payment_method == 'merchant') {
            $adjusted_price = $price + 5000; // Tambah 5% untuk Merchant
        } else {
            $adjusted_price = $price; // No extra fee for other methods
        }



        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-ZKeERFMGNTHXxUhukCiz0dV8';
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // Prepare the parameters for Midtrans
        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $adjusted_price, // Gunakan harga yang sudah disesuaikan
            ),
            'customer_details' => array(
                'first_name' => $customer_name,
                'last_name' => '',
                'email' => $email,
                'phone' => $phone_number,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        // Pass snapToken to the view

        if ($adjusted_price <= 30000) {
            return view('linkbola/purchase_daily', ['snapToken' => $snapToken]);
        } else {
            return view('linkbola/purchase_lifetime', ['snapToken' => $snapToken]);
        }
        
    }

    public function payment_success_lifetime()
    {
        return view('linkbola/payment_success_lifetime');
    }

    public function payment_success_daily()
    {
        $data['results'] = $this->LinkstreamingModel->getActiveLinkDaily();

        return view('linkbola/payment_success_daily', $data);
    }

}
