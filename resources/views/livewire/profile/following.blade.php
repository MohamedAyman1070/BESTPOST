<div class=" sm:w-4/5 w-full m-auto">
    <h3 class="text-3xl text-white border-b-2 p-2 border-custom-black1">Following</h3>
    <div class=" flex flex-col mt-2">
        @foreach ($following as $user)
            <div class="p-2 flex justify-between bg-custom-black1 mb-2 rounded" wire:key={{ $user->id }}>
                <div class="flex gap-2">
                    @include('components.user-avatar', ['user' => $user, 'size' => 14])
                    <div class="flex flex-col">
                        <span class="text-blue-500 text-2xl">
                            {{ $user->name }}
                        </span>
                        <span class="text-gray-400 text-sm">
                            {{ $user->email }}
                        </span>
                    </div>
                </div>
                <button class="text-blue-700 text-xl" wire:click="unfollow({{ $user }})">Unfollow</button>
            </div>
        @endforeach
        @empty($following->count())
            <p class="m-auto text-white text-xl">⚠️ You are not following anyone</p>
        @endempty
    </div>
</div>
