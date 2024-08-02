@extends('layouts.wire-form')

@section('inputs')
    <h1 class="text-[#2f3367] text-4xl mb-4">Sign in</h1>


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


    <button wire:click.prevent="login" class="p-2 w-full bg-[#007dfa] rounded text-white text-xl" type="submit" wire:loading.remove>Login</button>

    @include('components.spinner-btn',['target'=>'login' ,'width'=>'w-full'])
  
@endsection


@section('links')
    <div class="text-[#2f3367]  font-bold  ">
        <a href="/register">New to BestPost ?</a>
    </div>
    {{-- <div class="flex flex-col  items-center">
        <h1 class="text-center block text-xl text-[rgb(47,51,103)] ">Or</h1>
        <div class="p-2 mt-2 rounded  w-fit bg-[#007dfa] flex gap-2 text-white">
            <div><i class="fa-brands fa-google"></i></div>
            <a href="{{route('google-auth')}}">Continue With Google</a>
        </div>
    </div> --}}
@endsection
