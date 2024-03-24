<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Register</title>
</head>
<body>
    <nav class="p-4 bg-slate-500">
        <div class="brand text-white">
        <ul class="flex justify-between">
            <li class="font-bold text-2xl">
                <a href="/">Belonjo</a>
            </li>
            @guest
            <li class="bg-white text-black rounded-lg px-4 py-1">
                <a href="/login">Login</a>
            </li>
            @endguest
        </ul>
        </div>
    </nav>
    <div class="container">
        <div class="w-1/3 mx-auto p-5 mt-2 rounded-lg">
            <div class="flex">
                <h2 class="text-gray-600 font-bold">Register User</h2>
            </div>

            <form action="/register" method="POST" class="w-full mx-auto mt-5">
                @csrf
                <div class="mt-3">
                    <label class="text-sm text-gray-600" for="name">Nama</label>
                    <div class="border-2 p-1 @error('name')  border-red-400  @enderror">
                        <input autocomplete="off" name="name" value="{{old('name')}}" class="w-full h-full focus:outline-none text-sm" id="name" type="text">
                    </div>
                    @error('name')
                        <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-sm text-gray-600" for="email">Email</label>
                    <div class="@error('email')  border-red-400  @enderror border-2 p-1">
                        <input autocomplete="off" type="email" value="{{old('email')}}"  name="email" class="text-sm w-full h-full focus:outline-none" id="email" type="text">
                    </div>
                    @error('email')
                        <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-sm text-gray-600" for="email">No HP</label>
                    <div class="@error('phone')  border-red-400  @enderror border-2 p-1">
                        <input autocomplete="off" type="number" value="{{old('phone')}}"  name="phone" class="text-sm w-full h-full focus:outline-none" id="email" type="text">
                    </div>
                    @error('phone')
                        <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-sm text-gray-600" for="email">Alamat Lengkap</label>
                    <div class="@error('address')  border-red-400  @enderror border-2 p-1">
                        <textarea name="address" class="w-full" cols="30" rows="5"></textarea>
                    </div>
                    @error('address')
                        <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <label class="text-sm text-gray-600" for="password">Password</label>
                    <div class="@error('password')  border-red-400  @enderror border-2 p-1">
                        <input autocomplete="off" type="password" value="{{old('password')}}"  name="password" class="text-sm w-full h-full focus:outline-none" id="password" type="text">
                    </div>
                    @error('password')
                        <p class="italic text-red-500 text-sm mt-1">{{$message}}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <button class="bg-gray-600 w-full text-white p-2 rounded text-sm">Register</button>
                </div>
        </form>
        </div>
    </div>
</body>
</html>