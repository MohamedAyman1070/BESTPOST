<div class=" sm:w-4/5 w-full m-auto">
    <h3 class="text-3xl text-white border-b-2 p-2 border-custom-black1">Followers</h3>
    <div class=" flex flex-col mt-2">
        @foreach ($followers as $follower)
            <div class="p-2 bg-custom-black1 mb-2 rounded" wire:key={{ $follower->id }}>
                <div class="flex gap-2">
                    @include('components.user-avatar', ['user' => $follower, 'size' => 14])
                    <div class="flex flex-col">
                        <span class="text-blue-500 text-2xl">
                            {{ $follower->name }}
                        </span>
                        <span class="text-gray-400 text-sm">
                            {{ $follower->email }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
        @empty($followers->count())
            <p class="m-auto text-white text-xl">⚠️ You have no followers yet</p>
        @endempty
    </div>
</div>
