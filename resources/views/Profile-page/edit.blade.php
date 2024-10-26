@extends('layouts.master')


@section('content')
    <div class="bg-custom-black2 h-full ">
        <div class="w-full h-fit sm:h-full flex relative  ">
            {{-- @include('components.sidebar') --}}
            <livewire:profile.edit />
        </div>
    </div>
@endsection
