@extends('layouts.master')

@section('content')
    <div class="h-screen">
        {{-- @include('components.topbar') --}}
        <div class="bg-[#111315] h-full ">
            <livewire:post.create />
        </div>
    </div>
@endsection
