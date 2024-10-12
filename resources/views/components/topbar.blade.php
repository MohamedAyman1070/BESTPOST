<div class="p-2 bg-[#1a1d1f] text-4xl text-white sm:grid sm:grid-cols-2 flex flex-col  w-full ">

    <div class="flex items-center gap-4 ">

        <span class="w-14 h-14 border-r-2 border-white ">
            <img src="{{ asset('/logo-Cwhite.png') }}" alt="logo">
        </span>

        <span>
            @for ($i = 0; $i < count(str_split($title ?? ($title = 'BestPost')));
                $i++)
                <label class=" ml-[-10px] hover:text-[#34639a] ">{{ $title[$i] }}</label>
            @endfor
        </span>

    </div>

    <div class="flex justify-between sm:justify-end items-center gap-2 flex-wrap text-2xl ">

        @guest
            <div>
                <a href="/login">Login</a>
            </div>
            <div>
                <a href="/register">Register</a>
            </div>
        @endguest

        @auth
            <div class="flex gap-2 items-center sm:flex-row flex-col w-full sm:w-fit">

                <livewire:topbar.avatar />





                @include('components.dropdown')


            </div>
        @endauth

    </div>

</div>
