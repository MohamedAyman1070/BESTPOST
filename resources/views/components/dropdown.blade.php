<div class=' flex items-center justify-center w-full sm:w-fit   z-50'>
    <nav class="space-x-10 md:flex w-full sm:w-fit">

        <div class="relative w-full sm:w-fit flex flex-col " x-data="{ open: false }" @click.outside="open=false">
            <button @click="open = ! open" type="button"
                class="text-gray-500  rounded-md text-base place-self-center font-medium hover:text-gray-900"
                aria-expanded="false">
                <svg :class="{ 'rotate-180 duration-300 animate-none': open, 'duration-300': !open }"
                    class="text-gray-400 ml-2 h-8  w-8 group-hover:text-gray-500 animate-pulse"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </button>

            <div x-show="open" x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90" class=" absolute right-0 top-6 w-60 ">

                <div class="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 mt-0 sm:-mt-2">

                    <div class=" grid gap-6 px-5 py-6 sm:gap-8 sm:p-8 bg-custom-black1">


                        @guest
                            <div class="hover:text-blue-600 transition-color duration-300 ">
                                <a href="/login">Login</a>
                            </div>
                            <div class="hover:text-blue-600 transition-color duration-300 ">
                                <a href="/register">Register</a>
                            </div>
                        @endguest


                        @auth
                            @if (!str_contains(url()->current(), 'post-create'))
                                {{-- http://127.0.0.1:8000/post-create --}}
                                <div
                                    class="-m-3 flex items-start rounded-lg text-white hover:text-[#34639a] hover:bg-[#111315]">
                                    <div class="ml-4 flex items-center p-2 ">

                                        <a href="/post-create" class="text-base font-medium">Add Post</a>
                                    </div>
                                </div>
                            @endif
                            <form action="/signout" method="POST"
                                class="-m-3 flex items-start rounded-lg text-white hover:text-[#34639a] hover:bg-[#111315]">
                                @csrf
                                <div class="ml-4 flex items-center p-2 ">
                                    <button class="text-base font-medium ">logout</button>

                                </div>
                            </form>
                        @endauth



                    </div>

                </div>

            </div>


        </div>
    </nav>
</div>
