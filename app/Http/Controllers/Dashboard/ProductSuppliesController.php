<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSupplies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductSuppliesController extends Controller
{
    public function indexIncome () {
        $productsIncome = ProductSupplies::with(['product', 'user'])->where('type', '=','income')->paginate(10);
        return view('dashboard.income.index', ['productsIncome'=>$productsIncome]);
    }

    public function indexOutcome () {
        $productsOutcome = ProductSupplies::with(['product', 'user'])->where('type','outcome')->paginate(10);
        return view('dashboard.outcome.index', ['productsOutcome'=>$productsOutcome]);
    }

    public function createIncome(){
        return view('dashboard.income.input');
    }

    public function createOutcome(){
        return view('dashboard.outcome.input');
    }

    public function storeIncome(Request $request) {
        $this->validate($request, [
            'date'=> ['required'],
            'quantity'=>['required'],
            'product_id'=>['required'],
        ]);

       $created = ProductSupplies::create([
            'product_id'=>$request->product_id,
            'user_id'=>Auth::user()->id,
            'date'=>$request->date,
            'quantity'=>$request->quantity,
            'type'=>'income'
            
       ]);

       $sumIncomeQuantity = ProductSupplies::where('type', 'income')->where('product_id', $request->product_id)->sum('quantity');
       $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->where('product_id', $request->product_id)->sum('quantity');
       $orderQuantity = DB::table('orders')->join('products','orders.product_id','=','products.id')->where('products.id','=',
       $request->product_id)->where('payment_status','=','2')->sum('quantity');

       $product = Product::findOrFail($request->product_id);
       $quantityUpdated = $product->update([
        'stock'=>($sumIncomeQuantity - ($sumOutcomeQuantity+$orderQuantity))
       ]);

       if($created && $quantityUpdated){
        return redirect('/produk-masuk')->with('message', 'data berhasil ditambahkan');
       }
    }

    public function storeOutcome(Request $request) {
        $product = Product::findOrFail($request->product_id);
        $this->validate($request, [
            'date'=> ['required'],
            'quantity'=>['required'],
            'product_id'=>['required'],
            'quantity'=>["digits_between:1,$product->stock"]
        ]);

       $created = ProductSupplies::create([
            'product_id'=>$request->product_id,
            'user_id'=>Auth::user()->id,
            'date'=>$request->date,
            'quantity'=>$request->quantity,
            'type'=>'outcome'
            
       ]);

       $sumIncomeQuantity = ProductSupplies::where('type', 'income')->where('product_id', $request->product_id)->sum('quantity');
       $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->where('product_id', $request->product_id)->sum('quantity');
       $orderQuantity = DB::table('orders')->join('products','orders.product_id','=','products.id')->where('products.id','=',
       $request->product_id)->where('payment_status','=','2')->sum('quantity');
       
       $quantityUpdated = $product->update([
        'stock'=>($sumIncomeQuantity - ($sumOutcomeQuantity+$orderQuantity))
       ]);

       if($created && $quantityUpdated){
        return redirect('/produk-keluar')->with('message', 'data berhasil ditambahkan');
       }
    }

    public function deleteProductSupply($id) {
        $productSupply = ProductSupplies::findOrFail($id);
        $product = Product::findOrFail($productSupply->product_id);

        $deleted = $productSupply->delete();
        $sumIncomeQuantity = ProductSupplies::where('type', 'income')->sum('quantity');
        $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->sum('quantity');
        $orderQuantity = DB::table('orders')->join('products','orders.product_id','=','products.id')->where('products.id','=',
       $id)->where('payment_status','=','2')->sum('quantity');

        $updated = $product->update([
            'stock'=>($sumIncomeQuantity - ($sumOutcomeQuantity+$orderQuantity))
        ]);
        if($deleted && $updated){
            session()->flash('message', 'berhasil hapus data');
            return response()->json(['message'=> 'success delete data'],200);
        }
    }

    public function editIncome ($id) {
        $productIncome = ProductSupplies::findOrFail($id);
        return view('dashboard.income.update', ['productIncome'=>$productIncome]);
    }

    public function editOutCome ($id) {
        $productOutcome = ProductSupplies::findOrFail($id);
        return view('dashboard.outcome.update', ['productOutcome'=>$productOutcome]);
    }

    public function updateIncome(Request $request, $id) {
        $productIncome = ProductSupplies::findOrFail($id);
        $product = Product::findOrFail($productIncome->product_id);

        $updated = $productIncome->update([
            'product_id'=>$request->product_id,
            'user_id'=>Auth::user()->id,
            'date'=>$request->date,
            'quantity'=>$request->quantity,
        ]);

        $sumIncomeQuantity = ProductSupplies::where('type', 'income')->sum('quantity');
        $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->sum('quantity');
        $orderQuantity = DB::table('orders')->join('products','orders.product_id','=','products.id')->where('products.id','=',
       $id)->where('payment_status','=','2')->sum('quantity');

        $product->update([
            'stock'=>($sumIncomeQuantity - ($sumOutcomeQuantity+$orderQuantity))
        ]);

        if($updated){
            return redirect('/produk-masuk')->with('message', 'data berhasil diubah');
        }
    }

    public function updateOutcome(Request $request, $id) {
        $productOutcome = ProductSupplies::findOrFail($id);
        $product = Product::findOrFail($productOutcome->product_id);


        $maxValue = $product->stock+$productOutcome->quantity;
        $this->validate($request, [
            'date'=> ['required'],
            'quantity'=>['required'],
            'product_id'=>['required'],
            'quantity'=>["digits_between:1,$maxValue"]
        ]);

        $updated = $productOutcome->update([
            'product_id'=>$request->product_id,
            'user_id'=>Auth::user()->id,
            'date'=>$request->date,
            'quantity'=>$request->quantity,
        ]);

        $sumIncomeQuantity = ProductSupplies::where('type', 'income')->sum('quantity');
        $sumOutcomeQuantity = ProductSupplies::where('type', 'outcome')->sum('quantity');
        $orderQuantity = DB::table('orders')->join('products','orders.product_id','=','products.id')->where('products.id','=',
       $id)->where('payment_status','=','2')->sum('quantity');
        $product->update([
            'stock'=>($sumIncomeQuantity - ($sumOutcomeQuantity+$orderQuantity))
        ]);

        if($updated){
            return redirect('/produk-keluar')->with('message', 'data berhasil diubah');
        }
    }
}
