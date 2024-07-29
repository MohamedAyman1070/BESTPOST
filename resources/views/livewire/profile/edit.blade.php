<div class="  w-full  sm:col-span-4 h-full text-white ">
    <livewire:err-toast />


    <div class="m-auto w-4/5 h-full   border-b-2 border-black flex flex-col items-center justify-start">
        @if ($path)
        
        <span class="h-fit rounded-full w-fit mt-14">
            <img class="w-60 h-60 rounded-full" src="{{ asset($path) }}" alt="profile">
        </span>
        @else
            <span class="h-fit rounded-full w-fit mt-14"
                style=" background-color: rgb({{ auth()->user()->background_color }});">
                <img class="w-60 h-60 rounded-full" src="{{ auth()->user()->photos->path ?? asset('images/profile.png') }}" alt="profile">
            </span>
        @endif

        @if ($photo)
            <button class="p-1  mt-2 rounded bg-blue-500" wire:click="save_photo">confirm photo</button>
        @else
            <label for="upload" class=" mt-2 cursor-pointer">
                Change Profile Photo
                <i class="fa-solid fa-upload"></i>
                <input id="upload" hidden type="file" hidden accept="png,jpg" wire:model="photo">
            </label>
            {{-- @dd(auth()->user()->photo) --}}
            @if(auth()->user()->photo)
                <button wire:click="removePhoto">remove photo</button>
            @endif
        @endif

        <div class=" w-full h-full  p-2 flex justify-center items-start">
            <div class="h-fit w-full sm:w-3/5  grid grid-cols-1  gap-4 ">

                <div class=" p-6 text-xl rounded relative text-black flex flex-col">
                    <label class="text-white ">Username</label>
                    <input class="rounded outline-none text-black p-2" type="text" wire:model="name">
                </div>


                <div class=" p-6 text-xl flex justify-center rounded relative  ">
                    <button class="bg-blue-500 p-2 text-xl w-full sm:w-fit rounded" wire:click="Edit">Edit</button>
                </div>



            </div>
        </div>
    </div>

</div>
