<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class PaymentController extends Controller
{
    public function paymentHandler (Request $request){
        $snapToken = $request->token;

        $order = Order::where('snap_token','=',$snapToken)->first();
        $product = Product::find($order->product_id);

        $order->payment_status = '2';
        $order->save();

        $product->stock = $product->stock - $order->quantity;
        $product->save();

        return redirect('/transaksi');
    }
}
