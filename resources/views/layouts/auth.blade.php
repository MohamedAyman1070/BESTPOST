<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @livewireStyles
    <title>BestPost</title>
</head>

<body class="">

    <div class="h-screen grid grid-cols-1 sm:grid-cols-2">
        <div class=" bg-cover bg-center h-screen flex justify-center gap-80   flex-col items-center"
            style="background-image: url('{{ asset('images/graph.png') }}')">
            <div class="">
                <span class="text-white text-5xl flex items-center gap-2">
                    <span class=" border-r-4 border-white">
                        <img class="w-36 h-36" src="{{ asset('images/logo-Cwhite.png') }}" alt="logo.png">
                    </span>
                    <h1 class="h-fit ">Welcome To BestPost</h1>
                </span>
            </div>
            <div class="block sm:hidden">
                <div
                    class="h-0 w-0 border-x-[40px]  border-x-transparent border-t-[40px] border-t-grey animate-pulse  ">
                </div>
                <div
                    class="h-0 w-0 border-x-[40px]  border-x-transparent border-t-[40px] border-t-grey animate-pulse mt-[-22px]  ">
                </div>
            </div>
        </div>
        <div class="bg-red-500">
            @yield('wire')
        </div>
    </div>
    @livewireScripts
</body>

</html>
