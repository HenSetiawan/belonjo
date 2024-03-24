<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                <li class="px-2">Hi, {{Auth::user()->name}}</li>
            @endauth
            @auth
            <li class="px-4"><a href="/transaksi">Daftar Transaksi</a></li>
                <li class="px-4 bg-white text-black rounded-lg py-1"><a href="/logout">Logout</a></li>
            @endauth
            </div>
        </ul>
        </div>
    </nav>
    <main class="container px-10">
        <h1 class="text-2xl mt-5 mb-5">Daftar Transaksi Anda</h1>
            <table class="w-full mx-auto mt-5 text-sm text-gray-600">
                <thead>
                    <tr class="font-bold border-b-2 p-2">
                        <td class="p-2">No</td>
                        <td class="p-2">Nama Produk</td>
                        <td class="p-2">Jumlah</td>
                        <td class="p-2">Total Harga</td>
                        <td class="p-2">Tanggal</td>
                        <td class="p-2">Status</td>
                        <td class="p-2">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orderList as $order)
                    <tr class="border-b-2 p-2">
                        <td class="p-2">1</td>
                        <td class="p-2">{{$order->product->name}}</td>
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
                        <td class="p-2 flex gap-2">
                            <button data-id="{{$order->id}}" class="btn-delete-order-user bg-red-500 py-1 px-4 rounded text-white">
                                Hapus
                            </button>
                            <button data-token="{{$order->snap_token}}" class="bg-yellow-400 py-1 px-4 rounded text-white btn-pay">
                                Bayar
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </main>

    <script src="{{ asset('js/index.js') }}"></script>
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        const payButtons = document.querySelectorAll('.btn-pay');
        payButtons.forEach(payButton => {
            payButton.addEventListener('click',(event)=>{
                snap.pay(payButton.dataset.token, {
                // Optional
                onSuccess: async function(result) {
                   const csrf = document.head.querySelector("meta[name=csrf-token]").content;
                   const response = await fetch('/payment',{
                            method:"POST",
                            headers: {
                            "X-CSRF-TOKEN": csrf,
                            "Content-Type": "application/json",
                            },
                            body: JSON.stringify({token:payButton.dataset.token}),
                       })

                    const resultResponse = await response.json();

                    console.log('success...');
                    console.log(resultResponse);
                },
                // Optional
                onPending: async function(result) {
                   const csrf = document.head.querySelector("meta[name=csrf-token]").content;
                   const response = await fetch('/payment',{
                            method:"POST",
                            headers: {
                            "X-CSRF-TOKEN": csrf,
                            body: JSON.stringify(result),
                        },
                    })

                    console.log('pending...');
                    console.log(response);
                },
                // Optional
                onError: function(result) {
                    /* You may add your own js here, this is just example */
                    // document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                    console.log(result)
                }
            });
            })
        });
            
    </script>

</body>
</html>