<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Belonjo</title>
</head>
<body>
        <nav class="p-4 bg-slate-500">
        <div class="brand text-white">
        <ul class="flex justify-between">
            <li class="font-bold text-2xl">
                <a href="/">Belonjo</a>
            </li>
            <div class="flex items-center">
            @guest
            <li class="bg-white text-black rounded-lg px-4 py-1">
                <a href="/login">Login</a>
            </li>
            @endguest
            @auth
            @if(Auth::user()->role == 'user')
                <li class="px-2">Hi, {{Auth::user()->name}}</li>
                <li class="px-4"><a href="/transaksi">Daftar Transaksi</a></li>
                <li class="px-4 bg-white text-black rounded-lg py-1"><a href="/logout">Logout</a>
                </li>
            @endif
            @endauth
            </div>
        </ul>
        </div>
    </nav>
    <main class="container">
        <div class="px-8 py-4 m-auto w-full">
            <div class="card m-auto w-1/3 shadow-sm p-4 rounded border">
                <img class="mb-8 w-full" src="{{asset('storage/'.$product->image)}}">
                <div class="mt-5">
                    <p class="text-slate-800 text-md">{{$product->name}}</p>
                    <p class="text-slate-700 text-sm mt-1">{{$product->description}}</p>
                    <p class="text-slate-700 text-sm mt-1">Rp.{{$product->price}}</p>
                    <p class="text-slate-700 text-sm mt-1">Jumlah Stock Tersedia : {{$product->stock}}</p>
                </div>
                <form action="/order" method="POST">
                @csrf
                <div class="mt-5">
                    <input type="number" id="stock" class="hidden" value="{{$product->stock}}">
                    <input name="product_id" type="text" class="hidden" value="{{$product->id}}">
                    <div class="flex justify-between gap-2">
                        <button type="button" id="minus-qty-btn" class="w-1/3 bg-slate-300">-</button>
                        <input id="qty-order" name="quantity" type="number" value="0" class="border-2 text-center w-1/3">
                        <button type="button" id="plus-qty-btn" class="w-1/3 bg-slate-300">+</button>
                    </div>
                    <button class="bg-slate-500 text-white px-4 w-full py-1 text-center block rounded mt-1">Order</button>
                </div>
                </form>
            </div>
        </div>
    </main>

     <script src="{{ asset('js/order.js') }}"></script>
</body>
</html>