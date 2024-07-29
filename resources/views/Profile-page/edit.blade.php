@extends('layouts.master')


@section('content')
    <div class="bg-[#111315] h-full ">
        <div class="w-full h-fit sm:h-full flex relative  ">
            {{-- @include('components.sidebar') --}}

            <div x-data="{ show: false }" class="  z-50  h-full absolute   ">
                <template x-if="!show">
                    <button @click="show = true" class="p-2 m-2 bg-blue-500 rounded"><i class="fa-solid fa-bars"></i></button>
                </template>
              
                
                <div x-show="show" x-transition @click.outside="show = false" class="h-full ">
                    @include('components.sidebar')
                </div>
            </div> 

            <livewire:profile.edit />
        </div>
    </div>
@endsection