<div x-data="{ show: false }" class="relative">
    {{-- <template x-if="!show"> --}}
    <button @click="show = true" class=""><i class="fa-solid fa-bars text-blue-500"></i></button>
    {{-- </template> --}}


    <div x-show="show" x-transition @click.outside="show = false" class="h-full ">
        @include('components.sidebar')
    </div>
</div>
