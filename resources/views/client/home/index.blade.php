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
            @if(Auth::user()->role == 'user')
                <li class="px-2">Hi, {{Auth::user()->name}}</li>
                <li class="px-4"><a href="/transaksi">Daftar Transaksi</a></li>
                <li class="px-4 bg-white text-black rounded-lg py-1"><a href="/logout">Logout</a>
                </li>
            @endif
            </div>
        </ul>
        </div>
    </nav>
    <main class="container">
        <div class="flex m-auto px-4 py-6 mt-5 justify-between w-full gap-8">
            @foreach ($products as $product)
            <div class="card w-1/4 shadow-sm p-8 rounded border">
                <img class="mb-2" src="{{asset('storage/'.$product->image)}}">
                <p class="text-slate-800 text-md">{{$product->name}}</p>
                <p class="text-slate-700 text-sm mt-1 mb-2">Rp.{{$product->price}}</p>
                <a class="bg-slate-500 text-white px-4 py-1 text-center block rounded mt-1 mx-auto" href="/order/{{$product->id}}">Detail</a>
            </div>
            @endforeach
        </div>
    </main>
</body>
</html>