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
                    <h2 class="text-gray-600 font-bold">Data Transaksi Masuk</h2>
                </div>
                <form method="get" action="/transaksi-masuk" class="form">
                    <div class="flex">
                        <div class="border p-1 px-2 rounded-l">
                          <input id="search" name="search" class="focus:outline-none text-sm" type="text" placeholder="search">
                        </div>
                        <button type="submit" class="text-sm bg-gray-700 p-2 rounded-r text-white h-full">cari</button>
                    </div>
                </form>
            </div><table class="w-full mx-auto mt-5 text-sm text-gray-600">
                <thead>
                    <tr class="font-bold border-b-2 p-2">
                        <td class="p-2">No</td>
                        <td class="p-2">Nama Pembeli</td>
                        <td class="p-2">Alamat Pembeli</td>
                        <td class="p-2">HP Pembeli</td>
                        <td class="p-2">Nama Produk</td>
                        <td class="p-2">Jumlah</td>
                        <td class="p-2">Total Harga</td>
                        <td class="p-2">Tanggal</td>
                        <td class="p-2">Status</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderList as $order)
                    <tr class="border-b-2 p-2">
                        <td class="p-2">1</td>
                        <td class="p-2">{{$order->username}}</td>
                        <td class="p-2">{{$order->address}}</td>
                        <td class="p-2">{{$order->phone}}</td>
                        <td class="p-2">{{$order->productName}}</td>
                        <td class="p-2">{{$order->quantity}}</td>
                        <td class="p-2">{{$order->amount}}</td>
                        <td class="p-2">{{$order->date}}</td>
                         <td class="p-2">@if($order->payment_status == '1')
                            <span class="border-red-500 border p-2 rounded-lg">Belum Membayar</span>
                            @endif
                            @if($order->payment_status == '2')
                            <span class="border-green-500 border p-2 rounded-lg">Membayar</span>
                            @endif</td>
                            @if($order->payment_status == '3')
                            <span class="border-red-500 border p-2 rounded-lg">Kadaluarwarsa</span>
                            @endif
                            @if($order->payment_status == '4')
                            <span class="border-red-500 border p-2 rounded-lg">Batal</span>
                            @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>


        </div>
    </div>
@endsection