<div class=" w-full sm:w-3/5 p-2  h-full m-auto">
    <div class="text-xl text-blue-500 font-bold text-center p-2 animate-pulse  " wire:loading>
        Loading...
    </div>
    <div class="bg-green rounded bg-custom-black1 p-2">




        <div class="flex flex-col gap-2">
            <div class="flex justify-between">
                <h1 class="text-3xl text-white font-bold">Update Post</h1>
                <button wire:click="edit" class="text-2xl text-blue-500 font-bold">Edit</button>
            </div>
            <livewire:live-toolbar>
        </div>

        <div class=" bg-custom-black1 p-2 text-white  border-t-2 border-custom-black2 mt-2">

            @foreach ($clone as $element)
                <div
                    x-data = "{openUp :false , openDown:false  , input:$wire.entangle('input')  ,photo:$wire.entangle('photo')}">


                    @include('components.post-logic.edit', ['posName' => 'openUp', 'posNumber' => 1])

                    <div class="p-2 mb-2   rounded relative bg-custom-black2" contenteditable="false">

                        <button wire:click="deleteRow( '{{ $element }}' )"
                            class="w-4 h-4 absolute right-5 -top-1  rounded-full bg-red-600 flex justify-center items-center">
                            <p class="-mt-1">x</p>
                        </button>

                        <button @click="openDown = !openDown , openUp = false , input = '' "
                            class="w-4 h-4 absolute right-12 -top-1 rounded-full bg-green-500">
                            <p class="-mt-1"><i class="fa-solid fa-arrow-down"></i></p>
                        </button>

                        <button @click="openUp = !openUp , openDown = false  , input = ''  "
                            class="w-4 h-4 absolute right-20 -top-1 rounded-full bg-green-500">
                            <p class="-mt-1"><i class="fa-solid fa-arrow-up"></i></p>
                        </button>

                        @include('components.post-logic.post-structure')
                    </div>

                    @include('components.post-logic.edit', ['posName' => 'openDown', 'posNumber' => -1])


                </div>
            @endforeach


        </div>

    </div>
</div>
