@extends('layouts.master')


@section('content')
    <div class="bg-[#111315]   h-full   ">
        <div class="w-full h-fit sm:h-full flex relative">


            {{-- <livewire:profile.post > --}}
            <div class="w-full sm:w-4/5    m-auto  ">
                <div class="w-full sm:w-4/5   h-full m-auto ">
                    <div
                        class="flex w-full justify-center sm:justify-start  p-2 gap-2 border-b-2 border-custom-black1 text-white">
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

                    <livewire:base.container :$posts>

                </div>
            </div>

        </div>
    </div>
@endsection
