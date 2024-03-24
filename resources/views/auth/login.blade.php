<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Login</title>
</head>
<body>
    <div class=" bg-slate-700 h-[100vh]">
      <div class="container w-full relative flex justify-center">
        <div class="bg-white p-6 rounded-lg mx-auto w-96 md:w-1/4 absolute top-20">
          <div class="text-center">
            <img
              src="https://placehold.co/32x32"
              alt="logo"
              class="w-10 h-10 rounded mx-auto block object-cover"
            />
            <p class="text-sm text-slate-400 mt-2 font-semibold">
              Dashboard
            </p>
            <p class="font-bold text-xl mt-5">Log in</p>
            <p class="text-slate-400 text-xs mt-2">
              Masukan email dan password anda
            </p>
          </div>
          <div class="mt-10">
            @if (session()->has('error'))
             <div class="bg-red-500 p-2">
                <p class="text-xs text-center text-white">{{session()->get('error')}}</p>
            </div>
            @endif
            <form action="{{route('login')}}" method="post">
                @csrf
              <label
                class="text-sm text-slate-400 font-semibold uppercase mt-5 inline-block"
                for="email"
              >
                Email
              </label>
              <div class="border @error('email') border-red-500 @enderror mt-2 p-2"
              >
                <input
                  id="email"
                  class="w-full h-full text-sm focus:outline-none"
                  type="email"
                  name="email"
                  value="{{old('email')}}"
                  placeholder="Email"
                />
               
              </div>
               @error('email') <p class="italic mt-1 text-red-500 text-xs">{{$message}}</p> @enderror
              <div class="flex justify-between mt-5">
                <label
                  class="text-sm text-slate-400 font-semibold uppercase"
                  for="password"
                >
                  Password
                </label>
              </div>
              <div
              class="border mt-2 p-2 @error('password') border-red-500 @enderror"
              >
                <input
                  id="password"
                  class="w-full h-full text-sm focus:outline-none"
                  type="password"
                  name="password"
                  placeholder="Password"
                />
              </div>
               @error('password') <p class="italic text-red-500 text-xs">{{$message}}</p> @enderror
               <p class="text-xs text-slate-400 mt-2">Belum punya akun? <a class="text-blue-700 font-bold" href="/register">register</a></p>
              <button
                class="bg-blue-700 text-white text-center w-full mt-5 rounded-lg py-2 text-sm"
              >
                Log in
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
</body>
</html>