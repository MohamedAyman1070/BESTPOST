<div class="flex flex-col  w-full items-center gap-2 place-self-start p-2  ">

    @if (auth()->user()->photos)
        <span class=" rounded-full">
            <a href="/profile">
                {{-- <img class="w-14 h-14 rounded-full"
                    src="{{ '/'.auth()->user()->photos->path ?? asset('images/profile.png') }}" alt="profile"> --}}
                <img class="w-20 h-20 rounded-full"
                    src="{{ auth()->user()->photos->url ?? 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
                    alt="profile">
            </a>
        </span>
    @else
        <span class=" rounded-full" style="background-color: rgb({{ auth()->user()->background_color }});">
            <a href="/profile">
                <img class="w-20 h-20 rounded-full"
                    src="{{ auth()->user()->photos->url ?? 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
                    alt="profile">
            </a>
        </span>
    @endif

    <span class="text-white text-xl">
        <h1>{{ auth()->user()->name }}</h1>
    </span>
</div>
