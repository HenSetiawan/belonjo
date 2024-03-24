@extends('layouts.main')

@section('container')
<div class="container px-4">
    <div class="bg-white p-5 mt-5 rounded-lg">
        <div class="flex">
            <h2 class="text-gray-600 font-bold">Input Data Produk</h2>
        </div>

        <form action="/ubah-produk/{{$product->id}}" enctype="multipart/form-data" method="POST" class="w-1/2 mt-5">
            @csrf
            <input class="hidden" type="number" value="{{$product->stock}}" name="stock">
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="name">Nama Produk</label>
                <div class="border-2 p-1 @error('name')  border-red-400  @enderror">
                    <input name="name" value="{{$product->name}}" class="w-full h-full focus:outline-none text-sm" id="name" type="text">
                </div>
                @error('name')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="price">Harga Produk</label>
                <div class="@error('price')  border-red-400  @enderror border-2 p-1">
                    <input value="{{$product->price}}"  name="price" class="text-sm w-full h-full focus:outline-none" id="price" type="text">
                </div>
                @error('price')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600"  for="name">Status</label>
                    <div class="border-2 p-1">
                        <select class="text-black w-full bg-transparent h-full border-transparent" name="status" id="">
                            <option @if($product->status == 1) selected @endif value="true">Aktif</option>
                            <option @if($product->status == 0) selected @endif value="false">Non Aktif</option>
                        </select>
                    </div>
            </div>
            <label class="text-sm text-gray-600"  for="description">Deskripsi</label>
            <div class="border-2 p-1 @error('description')  border-red-400  @enderror">
                <textarea name="description" id="" class="w-full" cols="20" rows="5"></textarea>
            </div>
                @error('description')<p class="italic text-red-500 text-sm mt-1">{{$message}}</p>@enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="image">Gambar Produk</label>
                <div class="@error('image')  border-red-400  @enderror border-2 p-1">
                    <input type="file" name="image" class="text-sm w-full h-full focus:outline-none" id="image" type="text">
                </div>
                 @error('image')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="flex gap-1 mt-3">
                <div class="w-full">
                    <label class="text-sm text-gray-600"  for="category">Kategori Produk</label>
                    <div class="border">
                        <select name="category_id" class="w-full p-2 text-sm bg-transparent focus:outline-none" name="" id="">
                            @foreach($categories as $category)
                                <option class="text-sm" value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button class="bg-gray-600 text-white w-full p-2 rounded text-sm">Simpan Data</button>
            </div>
        </div>
    </form>
    </div>
</div>
@endsection

