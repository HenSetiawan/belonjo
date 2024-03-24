<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductExport;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Process;

class ProductController extends Controller
{
    public function index (Request $request) {
        if($request->has('search')){
            $products = DB::table('products')
            ->join('categories', 'products.category_id', '=' , 'categories.id')
            ->where('products.name', "LIKE","%{$request->search}%")
            ->select('products.*','categories.name as category')
            ->orderBy('products.created_at')
            ->paginate(10);
        } else {
             $products = DB::table('products')
            ->join('categories', 'products.category_id', '=' , 'categories.id')
            ->select('products.*','categories.name as category')
            ->orderBy('products.created_at')
            ->paginate(10);
        }

        return view('dashboard.products.index', ['products'=>$products]);
    }

    public function delete ($id) {
        $product = Product::findOrFail($id);
        Storage::delete($product->image);
        $deletedProduct = $product->delete();

        if($deletedProduct){
            session()->flash('message', 'berhasil hapus data');
            return response()->json(['message'=> 'success delete data'],200);
        }
    }

    public function create () {
        $category = Category::all();
        return view('dashboard.products.input', ['categories'=> $category]);
    }

    public function store (Request $request) {
        $validated = $this->validate($request,[
            'name'=>['required'],
            'price'=>['required'],
            'image'=>['required', 'image','max:1024'],
            'category_id'=>['required'],
            'status'=>['required'],
            'description'=>['required']
        ]);

        $imagePath = $request->file('image')->store('products');

        $created = Product::create([
            'name'=>$request->name,
            'price'=>$request->price,
            'image'=>$imagePath,
            'category_id'=>$request->category_id,
            'status'=>$request->status,
            'description'=>$request->description,
        ]);
        if($created){
            return redirect('/produk')->with('message', 'berhasil menambahkan data');
        }
    }

    public function edit ($id) {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('dashboard.products.update', ["product"=>$product, 'categories'=>$category]);
    }

    public function update (Request $request, $id) {
        $validated = $this->validate($request,[
            'name'=>['required'],
            'price'=>['required'],
            'category_id'=>['required'],
            'status'=>['required'],
            'description'=>['required'],
        ]);

        $productWithId = Product::findOrFail($id);
        $imagePath = null;

        if($request->image == null){
            $imagePath = $productWithId->image;
        } else {
            Storage::delete($productWithId->image);
            $imagePath = $request->file('image')->store('products');
        }

        $updated = $productWithId->update([
            'name'=>$request->name,
            'price'=>$request->price,
            'stock'=>$request->stock,
            'image'=>$imagePath,
            'status'=>$request->status,
            'description'=>$request->description,
            'category_id'=>$request->category_id,
        ]);

        if($updated){
            return redirect('/produk')->with('message', 'berhasil update data');
        }

    }

    public function getAllProducts () {
        $products = Product::all();
        return response()->json(['data' => $products], 200);
    }
}
