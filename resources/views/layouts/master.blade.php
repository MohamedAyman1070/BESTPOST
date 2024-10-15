<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://kit.fontawesome.com/14987f190e.js" crossorigin="anonymous"></script>
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
    <title>BestPost</title>
</head>

<body class="bg-custom-black2 m-0 p-0  ">
    {{-- <div class="  flex flex-col h-full w-full "> --}}
    @include('components.topbar')
    <livewire:err-toast />
    <div class="pt-20 ">
        @yield('content')
    </div>
    {{-- </div> --}}
    @livewireScripts
</body>

</html>
