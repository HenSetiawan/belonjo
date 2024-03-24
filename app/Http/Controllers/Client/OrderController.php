<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\Midtrans\CreateSnapTokenService;

class OrderController extends Controller
{
    public function index($id){
        $product = Product::find($id);
        return view('client.order.index',['product'=>$product]);
    }

    public function order(Request $request){
        $validated = $this->validate($request,[
            'quantity'=>['required'],
            'product_id'=>['required']
        ]);
        $productData = Product::find($request->product_id);
        $userData = User::find(Auth::user()->id);
        $date = date('Y-m-d H:i:s');

        
        $created = Order::create([
            'product_id'=>$request->product_id,
            'user_id'=>$userData->id,
            'date'=>$date,
            'payment_status'=>'1',
            'quantity'=>$request->quantity,
            'amount'=>$productData->price*$request->quantity,
        ]);

        $orderData = Order::find($created->id);

        $midtrans = new CreateSnapTokenService($orderData, $userData,$productData);
        $snapToken = $midtrans->getSnapToken();

        $orderData->snap_token = $snapToken;
        $orderData->save();

        if($created){
            return redirect('/')->with('message', 'berhasil menambahkan data');
        }
    }

    public function orderList(){
        $userId = Auth::user()->id;
        $orderList = Order::with(['product', 'user'])->where('user_id',$userId)->get();
        return view('client.order.list',['orderList'=>$orderList]);
    }

    public function delete ($id) {
        $order = Order::findOrFail($id);
        $deletedOrder = $order->delete();

        if($deletedOrder){
            session()->flash('message', 'berhasil hapus data');
            return response()->json(['message'=> 'success delete data'],200);
        }
    }

}
