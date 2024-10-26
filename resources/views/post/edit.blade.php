@extends('layouts.master')

@section('content')
    <div class="h-screen">
        {{-- @include('components.topbar') --}}
        <div class="bg-custom-black2  h-full ">
            <livewire:post.edit :$post />
        </div>
    </div>
@endsection
