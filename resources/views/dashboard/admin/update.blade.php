@extends('layouts.main')

@section('container')
<div class="container px-4">
    <div class="bg-white p-5 mt-5 rounded-lg">
        <div class="flex">
            <h2 class="text-gray-600 font-bold">Ubah Data Admin</h2>
        </div>

        <form action="/ubah-admin/{{$admin->id}}" method="POST" class="w-1/2 mt-5">
            @csrf
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="name">Nama Admin</label>
                <div class="border-2 p-1 @error('name')  border-red-400  @enderror">
                    <input autocomplete="off" name="name" value="{{$admin->name}}" class="w-full h-full focus:outline-none text-sm" id="name" type="text">
                </div>
                @error('name')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="email">Email Admin</label>
                <div class="@error('email')  border-red-400  @enderror border-2 p-1">
                    <input autocomplete="off" type="email" value="{{$admin->email}}"  name="email" class="text-sm w-full h-full focus:outline-none" id="email" type="text">
                </div>
                @error('email')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <label class="text-sm text-gray-600" for="password">Password Admin</label>
                <div class="@error('password')  border-red-400  @enderror border-2 p-1">
                    <input autocomplete="off" type="password" value="{{old('password')}}"  name="password" class="text-sm w-full h-full focus:outline-none" id="password" type="text">
                </div>
                 @error('password')
                    <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="mt-3">
                <button class="bg-gray-600 w-full text-white p-2 rounded text-sm">Simpan Data</button>
            </div>
    </form>
    </div>
</div>
@endsection

