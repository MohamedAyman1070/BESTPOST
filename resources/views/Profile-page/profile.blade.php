@extends('layouts.master')


@section('content')
    <div class="bg-[#111315] h-full ">
        <div class="w-full h-fit sm:h-full flex relative  ">
            {{-- @include('components.sidebar') --}}

            {{-- <x-sidebar-btn /> --}}

            <livewire:profile.profile-info />
        </div>
    </div>
@endsection
