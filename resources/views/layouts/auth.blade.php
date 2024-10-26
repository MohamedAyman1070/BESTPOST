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

<body class="  m-0 p-0 overflow-hidden">

    <div class="grid gird-cols-1 sm:grid-cols-2 h-screen ">
        <div class=" bg-cover bg-center hidden sm:flex justify-center gap-80   flex-col items-center"
            style="background-image: url('{{ 'https://th.bing.com/th/id/R.0f9a5b95063c7b60c0626f2a0d1e8a19?rik=6rEFw346sPVQMg&pid=ImgRaw&r=0' }}')">

            {{-- style="background-image: url('{{ 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728698153/graph_vcnzme.webp' }}')"> --}}
            <div class="">
                <span class="text-white text-5xl flex items-center gap-2">
                    <span class=" border-r-4 border-white">
                        <img class="w-36 h-36"
                            src="{{ 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697453/logo-Cwhite_mt3sjn.png' }}"
                            alt="logo.png">
                    </span>
                    <h1 class="h-fit ">Welcome To BestPost</h1>
                </span>
            </div>
        </div>
        <div class="bg-red-500 ">
            @yield('wire')
        </div>
    </div>
    @livewireScripts
</body>

</html>
