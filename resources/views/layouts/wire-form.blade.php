<div class="h-full bg-white flex flex-col justify-center items-center ">

    <script src="https://kit.fontawesome.com/14987f190e.js" crossorigin="anonymous"></script>
    <div class=" p-2   w-full sm:w-96   ">
        <form>


            @yield('inputs')



        </form>
        @yield('links')
        <div class="flex flex-col  items-center">
            <h1 class="text-center block text-xl text-[rgb(47,51,103)] ">Or</h1>
            <div class="p-2 mt-2 rounded  w-fit bg-[#007dfa] flex gap-2 text-white">
                <div><i class="fa-brands fa-google"></i></div>
                <a href="{{ route('google-auth') }}">Continue With Google</a>
            </div>
        </div>
    </div>

</div>
