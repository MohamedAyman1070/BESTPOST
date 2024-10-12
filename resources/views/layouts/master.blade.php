<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @livewireStyles
    <script src="https://kit.fontawesome.com/14987f190e.js" crossorigin="anonymous"></script>
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <title>BestPost</title>
</head>

<body class="bg-custom-black2 flex">
    <div class=" h-fit  sm:h-screen flex flex-col">
        @include('components.topbar')
        <livewire:err-toast />
        @yield('content')
    </div>
    @livewireScripts
</body>

</html>
