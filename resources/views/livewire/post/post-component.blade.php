<div class="m-2 ">

    <div x-data="{ comment_show: false }" class="flex flex-col  bg-custom-black1   rounded  " wire:loading.remove
        wire:target="delete">

        <div class="w-full border-b-2 border-custom-black2 p-2 grid grid-cols-4   ">

            <div class="flex  items-center gap-2     col-span-3">
                @if ($post)
                    @include('components.user-avatar', ['user' => $post['user'], 'size' => 12])
                    {{-- @if ($post['user']['photos'])
                        <div class=" w-fit  rounded-full">
                            <img class="w-12 h-12 rounded-full "
                                src="{{ $post['user']['photos']['url'] ?? 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
                                alt="profile">
                        </div> 
                    @else
                        <div class=" w-fit  rounded-full"
                            style="background-color: rgb({{ $post['user']['background_color'] }});">
                            <img class="w-12 h-12 rounded-full "
                                src="{{ $post['user']['photos']['url'] ?? 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
                                alt="profile">
                        </div>
                    @endif --}}

                    <div class="text-white">
                        <h1 class=" text-xl text-blue-500 "><b>{{ $post['user']['name'] }}</b></h1>
                        <smal class=" text-sm text-gray-500">{{ $post['user']['userTag'] }}</small>
                            {{-- todo:Followers --}}
                    </div>
                @endif
            </div>

            <div class=" text-white text-sm flex flex-col  items-end  gap-1      ">
                <span class="text-gray-400">{{ $since }}</span>
                <div class="">

                    {{-- edit --}}
                    @if ($post)
                        @can('update-delete-post', $post['user_id'])
                            <div x-data="{ open: false }" class="relative ">
                                <Button @click="open = ! open" class="rounded-full w-6  h-6 bg-custom-black2"><i
                                        class="fa-solid fa-ellipsis-vertical text-gray-400"></i></Button>

                                <div x-show="open" @click.outside="open = false">
                                    <div
                                        class="flex flex-col bg-custom-black2 p-2 w-40 justify-center items-start absolute right-0  text-white rounded">
                                        <div
                                            class="p-2 hover:text-blue-600 hover:bg-custom-black1 transition w-full rounded ">
                                            <a href="/post/edit/{{ $post['id'] }}">Edit</a>
                                        </div>
                                        <div
                                            class=" w-full rounded p-2 hover:text-blue-600 hover:bg-custom-black1 transition">
                                            <button wire:loading.attr="disabled" wire:loading.class="opacity-50"
                                                wire:click="delete()">Delete</button>
                                        </div>
                                        {{-- <div
                                            class=" w-full rounded p-2 hover:text-blue-600 hover:bg-custom-black1 transition">
                                            <a href="">Archieve</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endcan

                        @cannot('update-delete-post', $post['user_id'])
                            @if (!$is_follow)
                                <i class="fa-regular fa-plus" style="color: #2563eb;"></i>
                                <button class="text-xl  text-blue-600" wire:click="follow">Follow</button>
                            @else
                                <button class="text-xl  text-blue-600" wire:click="unfollow">Unfollow</button>
                            @endif
                        @endcannot
                    @endif


                </div>
            </div>

        </div>

        {{-- max-h-[30rem] --}}
        <div class="text-white p-2  overflow-auto">
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
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open">
                        <i class="fa-solid fa-heart" style="color: red"></i>
                        <span class="text-gray-500 text-sm">{{ $react_counter['all'] }}</span>
                    </button>
                    <div wire:loading.remove wire:target="react" x-show="open" @click.outside="open = false"
                        class="rounded bg-custom-black2 absolute inline-flex  top-4">
                        <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                                wire:click="react('love')"><span class="">❤️</span> <span
                                    class="text-gray-400  text-sm">{{ $react_counter['love'] }}</span> </button></li>
                        <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                                wire:click="react('lough')"><span class="">😂</span> <span
                                    class="text-gray-400  text-sm">{{ $react_counter['lough'] }}</span> </button></li>
                        <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                                wire:click="react('sad')"><span class="">😢</span> <span
                                    class="text-gray-400  text-sm">{{ $react_counter['sad'] }}</span> </button></li>
                        <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                                wire:click="react('wonder')"><span class="">😲</span> <span
                                    class="text-gray-400  text-sm">{{ $react_counter['wow'] }}</span> </button></li>
                        <li class="  list-none m-2"><button class="flex justify-between items-center gap-2"
                                wire:click="react('anger')"><span class="">😡</span> <span
                                    class="text-gray-400  text-sm">{{ $react_counter['anger'] }}</span> </button></li>
                    </div>
                    <x-placeholders.reactions />
                </div>
            </div>

            <div class="p-2  ">
                {{-- comments --}}

                <button @click="comment_show=!comment_show"><i class="fa-solid fa-comment" style="color: #2563eb"></i>
                    <span class="text-gray-500">{{ $comments_counter }}</span></button>

            </div>

        </div>
        {{-- Comments Conatiner --}}
        <div x-show="comment_show" class="">


            @include('components.comment-form', ['comment_function' => 'comment'])

            {{-- comment --}}
            <div>

                @foreach ($comments as $comment)
                    <livewire:post.comment :$comment :parent_id="$comment['id']" :key="$comment['id']">
                @endforeach
            </div>

        </div>


    </div>
    <x-placeholders.post />
</div>
