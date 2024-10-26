@extends('layouts.wire-form')

@section('inputs')
    <h1 class=" text-custom-text text-4xl mb-4">Sign in</h1>


    @include('components.input', [
        'forWhat' => 'Email',
        'forType' => 'email',
        'forName' => 'email',
        'forPlace' => 'Email',
    ])

    @error('email')
        <span class="text-red-600">{{ $message }}</span>
    @enderror


    @include('components.input', [
        'forWhat' => 'Password',
        'forType' => 'password',
        'forName' => 'password',
        'forPlace' => 'Password',
    ])

    @error('password')
        <span class="text-red-600">{{ $message }}</span>
    @enderror


    <button wire:click.prevent="login" class="p-2 w-full  bg-custom-black2 rounded text-white text-xl" type="submit"
        wire:loading.remove>Login</button>

    @include('components.spinner-btn', ['target' => 'login', 'width' => 'w-full'])
@endsection


@section('links')
    <div class=" text-custom-text  font-bold  ">
        <a href="/register">New to BestPost ?</a>
    </div>
@endsection
