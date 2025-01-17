<!-- component -->

<aside
    class="w-screen sm:w-72 bg-custom-black1 flex flex-col items-center pt-5 pb-2 space-y-7 absolute -right-[19px] top-[46px]   h-screen">

    <!-- menu items -->
    <div class="w-full pr-3 flex flex-col gap-y-1  text-gray-500 fill-gray-500 text-sm  ml-2   ">


        <div class="border-b-2 border-custom-black2">
            <livewire:topbar.avatar />
        </div>

        <div class="font-QuicksandMedium pl-4 text-gray-400/60 text-xs text-[11px] uppercase pt-2 ">Menu</div>

        <a href="/">
            <div class="w-full flex items-center gap-x-1.5 group select-none">
                <div class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                    </div>
                </div>
                <div class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm"
                    href="#">

                    <i
                        class="fa-solid fa-house group-hover:text-blue-600 dark:fill-gray-600  transition-colors duration-200"></i>
                    <span class="font-QuicksandMedium">Home</span>

                </div>
            </div>
        </a>
        <a href="/post-create">
            <div class="w-full flex items-center gap-x-1.5 group select-none">
                <div class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                    </div>
                </div>
                <div class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm"
                    href="#">

                    <i
                        class="fa-solid fa-plus group-hover:text-blue-600 dark:fill-gray-600 transition-colors duration-200"></i>

                    <span class="font-QuicksandMedium">Add Post</span>
                </div>
            </div>
        </a>
        <a href="/profile/posts" class="w-full">
            <div class="w-full flex items-center gap-x-1.5 group select-none">
                <div class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                    </div>
                </div>
                <div class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm"
                    href="#">

                    <i
                        class="fa-regular fa-file-lines group-hover:text-blue-600 dark:fill-gray-600 transition-colors duration-200"></i>
                    <span class="font-QuicksandMedium">Posts</span>
                </div>
            </div>
        </a>

        {{-- <a href="/profile/draft" class="w-full">
            <div class="w-full flex items-center gap-x-1.5 group select-none">
                <div class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                    </div>
                </div>
                <div
                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm">

                    <i
                        class="fa-solid fa-box-archive group-hover:text-blue-600 dark:fill-gray-600 transition-colors duration-200"></i>
                    <span class="font-QuicksandMedium">Drafts</span>
                </div>
            </div>
        </a> --}}











    </div>

    <!-- menu items -->
    <div class="w-full pr-3 flex flex-col gap-y-1  text-gray-500 fill-gray-500 text-sm">

        <div class="font-QuicksandMedium pl-4 text-gray-400/60 text-xs text-[11px] uppercase">Profile</div>

        <a href="/profile/update">
            <div class="w-full flex items-center gap-x-1.5 group select-none">
                <div class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                    </div>
                </div>
                <div class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm"
                    href="#">
                    <i
                        class="fa-solid fa-pen-to-square group-hover:text-blue-600 dark:fill-gray-600  transition-colors duration-200"></i>
                    <span class="font-QuicksandMedium">edit profile</span>
                </div>
            </div>
        </a>
        <a href="/profile/{{ auth()->user()->userTag }}">
            <div class="w-full flex items-center gap-x-1.5 group select-none">
                <div class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                    </div>
                </div>
                <div class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm"
                    href="#">

                    <i
                        class="fa-solid fa-circle-info group-hover:text-blue-600 dark:fill-gray-600  transition-colors duration-200"></i>
                    <span class="font-QuicksandMedium">User Info</span>
                </div>
            </div>
        </a>



        <a href="/profile/followers" class="w-full">
            <div class="w-full flex items-center gap-x-1.5 group select-none">
                <div class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                    </div>
                </div>
                <div
                    class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm">

                    <i
                        class="fa-solid fa-users group-hover:text-blue-600 dark:fill-gray-600  transition-colors duration-200"></i>
                    <span class="font-QuicksandMedium">Followers</span>
                </div>

            </div>
        </a>


        <a href="/profile/following" class="w-full">
            <div class="w-full flex items-center gap-x-1.5 group select-none">
                <div class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                    <div
                        class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                    </div>
                </div>
                <div class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm"
                    href="#">

                    <i
                        class="fa-solid fa-user-group group-hover:text-blue-600 dark:fill-gray-600  transition-colors duration-200"></i>
                    <span class="font-QuicksandMedium">Following</span>
                </div>
            </div>
        </a>

        <form action="/signout" method="POST">
            <button class="w-full">
                <div class="w-full flex items-center gap-x-1.5 group select-none">
                    <div
                        class="w-1 rounded-xl h-8 bg-transparent transition-colors duration-200 relative overflow-hidden">
                        <div
                            class="absolute top-0 left-0 w-full h-[102%] translate-y-full group-hover:translate-y-0 bg-blue-600 transition-all duration-300">
                        </div>
                    </div>
                    <div class="group-hover:bg-white/10 w-full group-active:scale-95 self-stretch pl-2 rounded flex items-center space-x-2 transition-all duration-200 dark:group-hover:text-white dark:hover:text-white text-sm"
                        href="#">
                        <i
                            class="fa-solid fa-right-from-bracket group-hover:text-blue-600  transition-colors duration-200 "></i>

                        @csrf
                        <span class="font-QuicksandMedium">Logout</span>

                    </div>

                </div>
            </button>
        </form>

    </div>




</aside>
