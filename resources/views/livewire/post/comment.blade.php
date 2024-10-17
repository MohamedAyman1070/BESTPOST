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


        <div class="flex flex-col gap-2 items-end">
            <span class="text-gray-400 text-sm"> {{ $this->since }}</span>
            @can('update-delete-comment', $comment['user_id'])
                <div x-data="{ open: false }" class="relative ">
                    <Button @click="open = ! open" class="rounded-full w-6  h-6 bg-custom-black2"><i
                            class="fa-solid fa-ellipsis-vertical text-gray-400"></i></Button>

                    <div x-show="open" @click.outside="open = false">
                        <div
                            class="flex flex-col bg-custom-black2 p-2 w-40 justify-center items-start absolute right-0  text-white rounded">
                            {{-- <div class="p-2 hover:text-blue-600 hover:bg-custom-black1 transition w-full rounded ">
                                Edit
                            </div> --}}
                            <div class=" w-full rounded p-2 hover:text-blue-600 hover:bg-custom-black1 transition">
                                <button wire:loading.attr="disabled" wire:loading.class="opacity-50"
                                    wire:click="delete()">Delete</button>
                            </div>

                        </div>
                    </div>
                </div>
            @endcan



        </div>
    </div>

    <div class=" rounded ml-14">
        <p class="text-white ">{{ $comment['body'] }}</p>
    </div>

    {{-- comments form and reactions --}}
    <div x-data="{ showForm: false }" class=" flex flex-col  gap-2 ml-16 ">

        <div class="flex  gap-2">
            <div x-data="{ open: false }" class="relative  text-nowrap w-fit  ">
                <button @click="open = !open">
                    <i class="fa-solid fa-heart" style="color: red"></i>
                    <span class="text-gray-500 text-sm">{{ $react_counter['all'] }}</span>
                </button>
                <div x-show="open" @click.outside="open = false"
                    class="rounded bg-custom-black1 absolute inline-flex  top-4">
                    <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                            wire:click="react('love')"><span class="">❤️</span> <span
                                class="text-gray-400   text-sm">{{ $react_counter['love'] }}</span> </button></li>
                    <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                            wire:click="react('lough')"><span class="">😂</span> <span
                                class="text-gray-400   text-sm">{{ $react_counter['lough'] }}</span> </button></li>
                    <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                            wire:click="react('sad')"><span class="">😢</span> <span
                                class="text-gray-400   text-sm">{{ $react_counter['sad'] }}</span> </button></li>
                    <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                            wire:click="react('wonder')"><span class="">😲</span> <span
                                class="text-gray-400   text-sm">{{ $react_counter['wow'] }}</span> </button></li>
                    <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                            wire:click="react('anger')"><span class="">😡</span> <span
                                class="text-gray-400   text-sm">{{ $react_counter['anger'] }}</span> </button></li>
                </div>
            </div>

            <div class="text-gray-500 w-full ">
                <button @click="showForm= !showForm">Reply</button>

            </div>
        </div>
        <div x-show="showForm" @click.outside="showForm=false" class="">
            @include('components.comment-form')
        </div>

    </div>

    <div class="text-white ml-14 ">
        <button class=" text-blue-500 ">replies</button>
    </div>



</div>
