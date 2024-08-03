<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Biaya;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Services\Midtrans\CreateSnapTokenService;

class BerandaController extends Controller
{

    protected $serverKey;
    protected $isProduction;
    protected $isSanitized;
    protected $is3ds;


    public function __construct()
    {
        $this->serverKey = config('midtrans.server_key');
        $this->isProduction = config('midtrans.is_production');
        $this->isSanitized = config('midtrans.is_sanitized');
        $this->is3ds = config('midtrans.is_3ds');

        $this->_configureMidtrans();
    }

    public function _configureMidtrans()
    {
        Config::$serverKey = $this->serverKey;
        Config::$isProduction = $this->isProduction;
        Config::$isSanitized = $this->isSanitized;
        Config::$is3ds = $this->is3ds;
    }

    public function beranda()
    {
        $data['biaya'] = Biaya::first();
        return view('frontend.beranda', $data);
    }

    public function createOrder(Request $request)
    {
        $snapToken = '';
        $biaya = Biaya::first();

        $newOrder = new Order();
        $newOrder->total_price = $biaya->biaya;
        $newOrder->payment_status = 1;
        $newOrder->nama_pemesan = 'CEK';
        $newOrder->email_pemesan = 'admin@gmail.com';
        $newOrder->save();

        $midtrans = new CreateSnapTokenService($newOrder);


        $params = [

            'transaction_details' => [
                'order_id' => $newOrder->number,
                'gross_amount' => $biaya->biaya,
            ],

            'item_details' => [
                [
                    'id' => $newOrder->id, // primary key produk
                    'price' => $biaya->biaya, // harga satuan produk
                    'quantity' => 1, // kuantitas pembelian
                    'name' => 'Photobooth', // nama produk
                ],
            ],
            'customer_details' => [
                // Key `customer_details` dapat diisi dengan data customer yang melakukan order.
                'first_name' => 'Photobooth',
                'email' => 'photobooth@gmail.com',
                'phone' => '000000000',
            ]
        ];

        if (empty($newOrder->snap_token)) {
            $snapToken =$midtrans->getSnapToken();
            $newOrder->snap_token = $snapToken;
            $newOrder->save();
        }


        // dd($snapToken);

        return view('frontend.bayar', compact('snapToken'));
    }
}
