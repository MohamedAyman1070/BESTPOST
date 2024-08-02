@extends('layouts.wire-form')


@section('inputs')
    <h1 class="text-[#2f3367] text-4xl mb-4">Sign up</h1>


    @include('components.input', [
        'forWhat' => 'Name',
        'forType' => 'text',
        'forName' => 'name',
        'forPlace' => 'Name',
    ])

    @error('name')
        <span class="text-red-600">{{ $message }}</span>
    @enderror


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

    @include('components.input', [
        'forWhat' => 'Confirm Password',
        'forType' => 'password',
        'forName' => 'password_confirmation',
        'forPlace' => 'Password again',
    ])

    @error('password_confirmation')
        <span class="text-red-600">{{ $message }}</span>
    @enderror


    <button class="p-2 w-full  text-white rounded bg-[#007dfa] text-xl" wire:click.prevent="register" type="submit"
        wire:loading.remove>Sign up</button>

    @include('components.spinner-btn', ['target' => 'register', 'width' => 'w-full'])
@endsection


@section('links')
    <div class="text-[#2f3367] font-bold place-self-start ">
        <a href="/login">Already have an account?</a>
    </div>
@endsection
