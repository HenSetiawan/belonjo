<?php

namespace App\Services\Midtrans;

use Midtrans\Snap;

class CreateSnapTokenService extends Midtrans
{
	protected $user;
    protected $product;
    protected $order;

	public function __construct($order, $user, $product)
	{
		parent::__construct();

		$this->user = $user;
        $this->product = $product;
        $this->order = $order;
	}

	public function getSnapToken()
	{
		$params = [
			'transaction_details' => [
				'order_id' => $this->order->id,
				'gross_amount' => $this->order->amount,
			],
			'item_details' => [
				[
					'id' => $this->product->id,
					'price' => $this->product->price,
					'quantity' => $this->order->quantity,
					'name' => $this->product->name,
				],
			],
			'customer_details' => [
				'first_name' => $this->user->username,
				'email' => $this->user->email,
				'phone' => $this->user->phone,
			]
		];

		$snapToken = Snap::getSnapToken($params);

		return $snapToken;
	}
}