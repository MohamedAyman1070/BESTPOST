@extends('layouts.master')


@section('content')
    <div class="bg-[#111315] h-auto ">
        <div class="w-full h-fit sm:h-full flex relative ">

            <div x-data="{ show: false }" class="  z-50  h-full absolute   ">
                <template x-if="!show">
                    <button @click="show = true" class="p-2 m-2 bg-blue-500 rounded"><i class="fa-solid fa-bars"></i></button>
                </template>


                <div x-show="show" x-transition @click.outside="show = false" class="h-full ">
                    @include('components.sidebar')
                </div>
            </div>

            {{-- <livewire:profile.post > --}}
                <div class="w-full sm:w-4/5   h-fit m-auto ">
                    <div class="w-full sm:w-4/5   h-full m-auto border-2 border-black">
                        <div class="flex w-full justify-center sm:justify-start  p-2 gap-2 border-b-2 border-custom-black1 text-white">
                            <div class="p-2 hover:text-blue-500 transition rounded  bg-custom-black2">
                                <a href="/profile/posts">Latest</a> 
                            </div>
                            <div class="p-2 hover:text-blue-500 transition rounded  bg-custom-black2">
                                <a href="/profile/posts-oldest">Oldest</a> 
                            </div>
                            <div class="p-2 hover:text-blue-500 transition rounded  bg-custom-black2">
                                <a href="/">Popular</a>
                            </div>
                        </div>
                        
                        @foreach ($posts as $post)
                            <livewire:post.PostComponent :$post>
                        @endforeach
                    </div>
                </div>

        </div>
    </div>
@endsection
