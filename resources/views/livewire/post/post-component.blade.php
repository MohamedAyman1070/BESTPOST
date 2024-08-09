<div class="m-2">
    <div class="flex flex-col border-2 bg-custom-black1  border-black rounded  ">

        <div class="w-full border-b-2 border-custom-black2 p-2 flex justify-between flex-wrap ">

            <div class="flex justify-center items-center gap-2">
                @if ($post)

                    @if ($post['user']['photos'])
                        <div class=" w-fit  rounded-full">
                            <img class="w-12 h-12 rounded-full "
                                src="{{ '/' . $post['user']['photos']['path'] ?? asset('/images/profile.png') }}"
                                alt="profile">
                        </div>
                    @else
                        <div class=" w-fit  rounded-full"
                            style="background-color: rgb({{ $post['user']['background_color'] }});">
                            <img class="w-12 h-12 rounded-full "
                                src="{{ $post['user']['photos']['path'] ?? asset('/images/profile.png') }}"
                                alt="profile">
                        </div>
                    @endif

                    <div class="text-white">
                        <h1 class=" text-xl  ">{{ $post['user']['name'] }}</h1>
                        <smal class=" text-sm">{{ $post['user']['email'] }}</small>
                            {{-- todo:Followers --}}
                    </div>
                @endif
            </div>

            <div class=" text-white text-sm flex flex-col  items-end  gap-1 sm:w-fit w-full ">
                {{ $since }}
                <div class="">

                    {{-- edit --}}
                    @if ($post)
                        @can('update-delete-post', $post['user_id'])
                            <div x-data="{ open: false }" class="relative ">
                                <Button @click="open = ! open" class="rounded-full w-6  h-6 bg-custom-black2"><i
                                        class="fa-solid fa-ellipsis-vertical"></i></Button>

                                <div x-show="open" @click.outside="open = false">
                                    <div
                                        class="flex flex-col bg-custom-black2 p-2 w-40 justify-center items-start absolute right-0  text-white rounded">
                                        <div
                                            class="p-2 hover:text-blue-600 hover:bg-custom-black1 transition w-full rounded ">
                                            <a href="/post/edit/{{ $post['id'] }}">Edit</a>
                                        </div>
                                        <div
                                            class=" w-full rounded p-2 hover:text-blue-600 hover:bg-custom-black1 transition">
                                            <button wire:click="delete({{ $post['id'] }})">Delete</button>
                                        </div>
                                        <div
                                            class=" w-full rounded p-2 hover:text-blue-600 hover:bg-custom-black1 transition">
                                            <a href="">To Draft</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endcan

                        @cannot('update-delete-post', $post['user_id'])
                            <i class="fa-regular fa-plus" style="color: #2563eb;"></i>
                            <button class="text-xl  text-blue-600" wire:click="follow">Follow</button>
                        @endcannot
                    @endif


                </div>
            </div>

        </div>

        <div class="text-white p-2">
            {{-- {{ $post->body }} --}}

            @if ($post)
                @foreach ($post['body'] as $element)
                    @include('components.post-logic.post-structure')
                @endforeach
            @endif

        </div>

        <div class="flex border-t-2 border-custom-black2 ">
            <div class="p-2 ">
                {{-- likes --}}
                <button>
                    <i class="fa-solid fa-heart" style="color: red"></i>
                </button>
            </div>
            <div class="p-2">
                {{-- comments --}}
                <button><i class="fa-solid fa-comment" style="color: #2563eb"></i></button>
            </div>

        </div>

    </div>

</div>
