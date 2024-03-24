@extends('layouts.main')

@section('container')

@if (session('message'))
   <div id="toast-container" class="hidden fixed z-50 items-center w-full max-w-xs p-4 space-x-4 text-gray-500 bg-white divide-x divide-gray-200 rounded border-l-2 border-green-400 shadow top-5 right-5 dark:text-gray-400 dark:divide-gray-700 space-x dark:bg-gray-800" role="alert">
    <div class=" text-green-400 text-sm font-bold capitalize">{{session()->get('message')}}</div>
</div>
@endif
    <div class="container px-4">
        <div class="bg-white mt-5 p-5 rounded-lg">
            <div class="flex justify-between">
                <div class="text-left">
                    <h2 class="text-gray-600 font-bold">Data Produk</h2>
                    <a href="/input-produk" class="text-sm inline-block bg-gray-700 text-white mt-2 px-2 py-1">Input Produk</a>
                </div>
                <form method="get" action="/produk" class="form">
                    <div class="flex">
                        <div class="border p-1 px-2 rounded-l">
                          <input id="search" name="search" class="focus:outline-none text-sm" type="text" placeholder="search">
                        </div>
                        <button type="submit" class="text-sm bg-gray-700 p-2 rounded-r text-white h-full">cari</button>
                    </div>
                </form>
            </div>

            <table class="w-full mt-5 text-sm text-gray-600">
                <thead>
                    <tr class="font-bold border-b-2 p-2">
                        <td class="p-2">No</td>
                        <td class="p-2">Nama Produk</td>
                        <td class="p-2">Harga Produk</td>
                        <td class="p-2">Jumlah Produk</td>
                        <td class="p-2">Kategori Produk</td>
                        <td class="p-2">Status</td>
                        <td class="p-2">Deskripsi</td>
                        <td class="p-2">Gambar Produk</td>
                        <td class="p-2">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $noProduct = 1;
                    @endphp
                    @foreach ($products as $product)
                        <tr class="border-b p-2">
                        <td class="p-2">{{$noProduct}}</td>
                        <td class="p-2">{{$product->name}}</td>
                        <td class="p-2">Rp.{{number_format($product->price,0) }}</td>
                        <td class="p-2">{{$product->stock}}</td>
                        <td class="p-2">{{$product->category}}</td>
                        <td class="p-2">
                            @if($product->status)
                                Aktif
                            @else
                                Non Aktif
                            @endif
                        </td>
                        <td class="p-2">{{$product->description}}</td>
                        <td class="p-2 w-[150px]"><img src="{{asset('storage/'.$product->image)}}"/></td>
                        <td class="p-2 flex gap-2">
                            <button data-id="{{$product->id}}" class="btn-delete-product bg-red-500 py-1 px-4 rounded text-white">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                            <a href="/ubah-produk/{{$product->id}}" class="bg-yellow-400 py-1 px-4 rounded text-white">
                                <i class="ri-edit-box-line"></i>
                            </a>
                        </td>
                    </tr>
                    @php
                        $noProduct++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{$products->links('pagination::tailwind')}}
            </div>
        </div>
    </div>
@endsection