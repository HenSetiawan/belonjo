<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TransactionController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $orderList = DB::table('orders')->leftjoin('products','orders.product_id','=','products.id')->leftjoin('users','orders.user_id','=','users.id')->where('products.name','LIKE',"%{$request->search}%")->paginate(10,['products.name as productName','orders.quantity as quantity','orders.amount as amount','users.name as username','users.phone as phone', 'users.email as email','users.address as address','orders.date as date','orders.payment_status']);
        } else {
            $orderList = DB::table('orders')->leftjoin('products','orders.product_id','=','products.id')->leftjoin('users','orders.user_id','=','users.id')->paginate(10,['products.name as productName','orders.quantity as quantity','orders.amount as amount','users.name as username','users.phone as phone', 'users.email as email','users.address as address','orders.date as date','orders.payment_status']);
        }

        return view('dashboard.transaction.index',['orderList'=>$orderList]);
    }
}
