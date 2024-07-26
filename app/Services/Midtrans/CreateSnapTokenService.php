<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;
use App\Models\Biaya;

class CreateSnapTokenService extends Midtrans
{
	protected $order;

	public function __construct($order)
	{
		parent::__construct();

		$this->order = $order;
	}

	public function getSnapToken()
	{

        $biaya = Biaya::first();
		$params = [

			'transaction_details' => [
				'order_id' => $this->order->number,
				'gross_amount' => $biaya->biaya,
			],

			'item_details' => [
				[
					'id' => $this->order->id, // primary key produk
					'price' => $this->order->total_price, // harga satuan produk
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



		return $snapToken;
	}
}
