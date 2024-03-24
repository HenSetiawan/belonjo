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
                    <h2 class="text-gray-600 font-bold">Data User</h2>
                </div>
                <form method="get" action="/admin" class="form">
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
                        <td class="p-2">Nama User</td>
                        <td class="p-2">Email</td>
                        <td class="p-2">No HP</td>  
                        <td class="p-2">Alamat</td>              
                        <td class="p-2">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $noUser = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr class="border-b p-2">
                        <td class="p-2">{{$noUser}}</td>
                        <td class="p-2">{{$user->name}}</td>
                        <td class="p-2">{{$user->email}}</td>
                        <td class="p-2">{{$user->phone}}</td>
                        <td class="p-2">{{$user->address}}</td>
                        <td class="p-2 flex gap-2">
                            <button data-id="{{$user->id}}" class="btn-delete-user bg-red-500 py-1 px-4 rounded text-white">
                                <i class="ri-delete-bin-line"></i>
                            </button>
                        </td>
                    </tr>
                    @php
                        $noUser++;
                    @endphp
                    @endforeach
                </tbody>
            </table>
            <div class="mt-5">
                {{$users->links('pagination::tailwind')}}
            </div>
        </div>
    </div>
@endsection