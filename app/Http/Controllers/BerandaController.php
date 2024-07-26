<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Biaya;
use App\Models\Order;
use Illuminate\Http\Request;

class BerandaController extends Controller
{
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
        $newOrder->nama_pemesan = $request->nama_pemesan;
        $newOrder->email_pemesan = $request->email_pemesan;
        $newOrder->save();

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

        $snapToken = Snap::getSnapToken($params);

        return view('frontend.bayar', $snapToken);
    }
}
