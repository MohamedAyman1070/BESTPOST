<div class="flex p-2 gap-2 flex-col mt-2 border-custom-black2 ">

    <div class="flex justify-between w-full ">


        <div class="flex gap-2">
            <div class=" w-fit  rounded-full" style="background-color: rgb({{ $owner['background_color'] }});">
                <img class="w-12 h-12 object-cover rounded-full "
                    src="{{ $owner['photos']['url'] ?? 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
                    alt="profile">
            </div>
            <div class="text-white">
                <h1 class="text-blue-500"><b>{{ $owner['name'] }}</b></h1>
                <smal class=" text-sm text-gray-500">{{ $owner['email'] }}</small>
                    {{-- todo:Followers --}}
            </div>
        </div>


        <div class="text-gray-400   text-sm ">
            {{ $this->since }}
        </div>
    </div>

    <div class=" rounded ml-14">
        <p class="text-white ">{{ $comment['body'] }}</p>
    </div>


    <div class=" flex  gap-2 ml-16">

        <div x-data="{ open: false }" class="relative w-1/12 text-nowrap   ">
            <button @click="open = !open">
                <i class="fa-solid fa-heart" style="color: red"></i>
                <span class="text-gray-500 text-sm">{{ $react_counter['all'] }}</span>
            </button>
            <div x-show="open" @click.outside="open = false"
                class="rounded bg-custom-black1 absolute inline-flex  top-4">
                <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                        wire:click="react('love')"><span class="">❤️</span> <span
                            class="text-white  text-sm">{{ $react_counter['love'] }}</span> </button></li>
                <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                        wire:click="react('lough')"><span class="">😂</span> <span
                            class="text-white  text-sm">{{ $react_counter['lough'] }}</span> </button></li>
                <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                        wire:click="react('sad')"><span class="">😢</span> <span
                            class="text-white  text-sm">{{ $react_counter['sad'] }}</span> </button></li>
                <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                        wire:click="react('wonder')"><span class="">😲</span> <span
                            class="text-white  text-sm">{{ $react_counter['wow'] }}</span> </button></li>
                <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                        wire:click="react('anger')"><span class="">😡</span> <span
                            class="text-white  text-sm">{{ $react_counter['anger'] }}</span> </button></li>
            </div>
        </div>

        <div x-data="{ showForm: false }" class="text-gray-500 w-full ">
            <button @click="showForm= !showForm">Reply</button>
            <div x-show="showForm" @click.outside="showForm=false">
                @include('components.comment-form')
            </div>
        </div>


    </div>

    <div class="text-white ml-14 ">
        <button class=" text-blue-500 ">replies</button>
    </div>



</div>
