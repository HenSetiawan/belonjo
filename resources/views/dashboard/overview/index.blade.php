@extends('layouts.main')

@section('container')
   <div class="container px-4">
    <div class="p-5 mt-5 rounded-lg">
        <div class="text-left">
            <h1 class="text-gray-600 font-semibold">Overview</h1>
        </div>
        <div class="flex gap-4 mt-5">
        <div class="bg-white rounded w-1/3 text-center hover:border-blue-500 p-10">
            <h2 class="font-bold text-4xl">{{$countProducts}}</h2>
            <p class="text-sm mt-2 text-gray-600">Jumlah Data Produk</p>
        </div>
        <div class="bg-white rounded text-center hover:border-blue-500 w-1/3 p-10">
              <h2 class="font-bold text-4xl">{{$countProductOutcome}}</h2>
            <p class="text-sm text-gray-600 mt-2">Jumlah Data Produk Keluar</p>
        </div>
        <div class="bg-white rounded w-1/3 text-center hover:border-blue-500 p-10">
              <h2 class="font-bold text-4xl">{{$countProductIncome}}</h2>
            <p class="text-sm mt-2 text-gray-600">Jumlah Data Produk Masuk</p>
        </div>
        </div>
    </div>
   </div>
@endsection