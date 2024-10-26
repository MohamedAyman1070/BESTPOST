<div class="p-[3px] bg-custom-black1 text-4xl text-white flex justify-between flex-wrap  fixed z-50  w-full ">
    <div class="flex items-center gap-4  ">

        <span class="w-14 h-14 border-r-2 border-white ">
            {{-- <img src="{{ asset('/logo-Cwhite.png') }}" alt="logo"> --}}
            <img src="https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697453/logo-Cwhite_mt3sjn.png"
                alt="logo">
        </span>

        <span>
            {{ 'BestPost' }}
            {{-- @for ($i = 0; $i < count(str_split($title ?? ($title = 'BestPost'))); $i++)
                <label class=" ml-[-10px] hover:text-[#34639a] ">{{ $title[$i] }}</label>
            @endfor --}}
        </span>

        {{-- <span class="bg-red-500">
        <img class="w-auto h-50" src="https://res.cloudinary.com/drm3bzgpi/image/upload/v1728790357/Untitled_2_moz8nt.png"
            alt="logo">
        </span> --}}

    </div>

    <div class="flex  justify-end items-center gap-2 flex-wrap text-2xl mr-4">

        @guest
            <div class="sm:flex justify-between gap-4 hidden ">
                <div>
                    <a href="/login">Login</a>
                </div>
                <div>
                    <a href="/register">Register</a>
                </div>
            </div>
            <div class="sm:hidden block">
                @include('components.dropdown')
            </div>
        @endguest

        @auth

            {{-- <livewire:topbar.avatar />
               --}}
            {{-- <!-- todo: put sidebar here> --}}
            <x-sidebar-btn />
            {{-- @include('components.sidebar-btn') --}}

        @endauth


    </div>

</div>
