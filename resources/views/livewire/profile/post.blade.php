
<div class="w-4/5   h-fit m-auto ">
    <div class="w-4/5   h-full m-auto border-2 border-black">
        <div class="flex w-full p-2 gap-2 border-b-2 border-custom-black1 text-white">
            <div class="p-2 hover:text-blue-500 transition rounded  bg-custom-black2">
               <button wire:click="latest"> Latest</button>
            </div>
            <div class="p-2 hover:text-blue-500 transition rounded  bg-custom-black2">
               <button wire:click="oldest"> Oldest</button>
            </div>
            <div class="p-2 hover:text-blue-500 transition rounded  bg-custom-black2">
                <button wire:click="popular">Popular</button>
            </div>
        </div>
        @dd($posts)
        @foreach ($posts as $post)
            <livewire:post.PostComponent :$post>
        @endforeach
    </div>
</div>