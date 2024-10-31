<div class="  w-full  sm:col-span-4 h-full text-white ">

    <div class="m-auto w-4/5 h-full   flex flex-col items-center justify-start">
        @if ($user->photos)
            <span class="h-fit rounded-full w-fit mt-14">
                <img class="w-60 h-60 rounded-full object-cover"
                    src="{{ $user->photos->url ?? 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
                    alt="profile">
            </span>
        @else
            <span class="h-fit rounded-full w-fit mt-14" style=" background-color: rgb({{ $background_color }});">
                <img class="w-60 h-60 rounded-full object-cover"
                    src="{{ $user->photos->url ?? 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
                    alt="profile">
            </span>
        @endif

        <b class="text-3xl">{{ $username }}</b>
        <small class="text-xl">{{ $userTag }}
            @if (auth()->user() === $user)
                <a href="/profile/update"><i class="fa-regular fa-pen-to-square"></i>
                </a>
            @endif
        </small>

        <div class=" w-full h-full  p-2 flex justify-center items-center">
            <div class="h-fit w-full sm:w-3/5  grid grid-cols-1 sm:grid-cols-2 gap-4 ">

                <div class="bg-custom-black1 p-6 text-xl rounded  flex justify-between">
                    <span class="font-bold rounded text-xl ">Posts</span>
                    <div>
                        {{ $postsCount }}
                    </div>
                </div>

                <div class="bg-custom-black1 p-6 text-xl rounded flex justify-between">
                    <span class="font-bold rounded text-xl">Followers</span>
                    {{ $followersCount }}
                </div>

                <div class="bg-custom-black1 p-6 text-xl rounded flex justify-between">
                    <span class="font-bold rounded text-xl">Following</span>
                    {{ $followingCount }}
                </div>

                <div class="bg-custom-black1 p-6 text-xl rounded flex justify-between">
                    <span class="font-bold rounded text-xl">Reacts Count</span>
                    {{ $reactCount }}
                </div>

                <div class="bg-custom-black1 p-6 text-xl rounded flex justify-between sm:col-span-2">
                    <span class="font-bold rounded text-xl ">Account create at</span>
                    {{ $created_at }}
                </div>

            </div>
        </div>
    </div>

</div>
