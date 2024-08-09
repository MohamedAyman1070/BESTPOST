<div class="flex items-center gap-2 place-self-start mt-2 ">

    @if (auth()->user()->photos)
        <span class="w-14  h-14 rounded-full">
            <a href="/profile">
                <img class="w-14 h-14 rounded-full"
                    src="{{ '/'.auth()->user()->photos->path ?? asset('images/profile.png') }}" alt="profile">
            </a>
        </span>
    @else
        <span class="w-14  h-14 rounded-full" style="background-color: rgb({{ auth()->user()->background_color }});">
            <a href="/profile">
                <img class="w-14 h-14 rounded-full"
                    src="{{ auth()->user()->photos->path ?? asset('images/profile.png') }}" alt="profile">
            </a>
        </span>
    @endif

    <span class="text-white text-xl">
        <h1>{{ auth()->user()->name }}</h1>
    </span>
</div>
