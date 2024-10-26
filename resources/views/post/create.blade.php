@extends('layouts.master')

@section('content')
    <div class="h-full row-span-8">
        {{-- @include('components.topbar') --}}
        <div class="bg-custom-black2  h-full ">
            <livewire:post.create />
        </div>
    </div>
@endsection
