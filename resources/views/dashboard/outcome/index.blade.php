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
                    <h2 class="text-gray-600 font-bold">Data Produk Keluar</h2>
                    <a href="/input-barang-keluar" class="text-sm bg-gray-700 text-white block mt-2 px-2 py-1">Input Produk Keluar</a>
                </div>
                <form method="get" action="/supplier" class="form">
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
                        <td class="p-2">Nama Admin</td>
                        <td class="p-2">Jumlah Produk Keluar</td>
                        <td class="p-2">Tanggal</td>
                        <td class="p-2">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productsOutcome as $productOutcome)
                    <tr class="border-b-2 p-2">
                        <td class="p-2">1</td>
                        <td class="p-2">{{$productOutcome->product->name}}</td>
                        <td class="p-2">{{$productOutcome->user->name}}</td>
                        <td class="p-2">{{$productOutcome->quantity}}</td>
                        <td class="p-2">{{$productOutcome->date}}</td>
                        <td class="p-2 flex gap-2">
                            <button data-id="{{$productOutcome->id}}" class="btn-delete-product-outcome bg-red-500 py-1 px-4 rounded text-white">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                            <a href="/ubah-barang-keluar/{{$productOutcome->id}}" class="bg-yellow-400 py-1 px-4 rounded text-white">
                                <i class="ri-edit-box-line"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{$productsOutcome->links('pagination::tailwind')}}
            </div>
        </div>
    </div>
@endsection