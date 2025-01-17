<div class="  w-full  sm:col-span-4 h-full text-white ">


    <div class="m-auto w-4/5 h-full  flex flex-col items-center justify-start">

        @if ($img_url)
            <span class="h-fit rounded-full w-fit mt-14">
                <img class="object-cover w-60 h-60 rounded-full" src="{{ $img_url }}" alt="profile">
            </span>
        @else
            @if ($user_photo)
                <span class="h-fit rounded-full w-fit mt-14">
                    <img class="object-cover w-60 h-60 rounded-full" src="{{ $user_photo->url }}" alt="profile">
                </span>
            @else
                <span class="h-fit rounded-full w-fit mt-14"
                    style=" background-color: rgb({{ auth()->user()->background_color }});">
                    <img class="object-cover w-60 h-60 rounded-full"
                        src="{{ 'https://res.cloudinary.com/drm3bzgpi/image/upload/v1728697471/profile_nm1gkb.png' }}"
                        alt="profile">
                </span>
            @endif
        @endif

        {{-- @if ($photo)
            <button class="p-1  mt-2 rounded bg-blue-500" wire:click="save_photo">confirm photo</button>
        @else
            <label for="upload" class=" mt-2 cursor-pointer">
                Change Profile Photo
                <i class="fa-solid fa-upload"></i>
                <input id="upload" hidden type="file" hidden accept="png,jpg" wire:model="photo">
            </label>
            
            @if ($user_photo)
                <button wire:click.prevent="removePhoto">remove photo</button>
            @endif
        @endif --}}

        <label for="upload-input" class=" mt-2  cursor-pointer">
            Change Profile Photo
            {{-- <i class="fa-solid fa-upload"></i> --}}
        </label>
        <input id="upload-input" hidden type="file" hidden accept="png,jpg">
        <button hidden id="submit-btn"></button>
        <x-ImgUploadScript />
        @if ($user_photo)
            <button wire:click.prevent="removePhoto">remove photo</button>
        @endif


        <div class=" w-full h-full  p-2 flex justify-center items-start">
            <div class="h-fit w-full sm:w-3/5  grid grid-cols-1  gap-4 ">

                <div class=" p-6 text-xl rounded relative text-black flex flex-col">
                    <label class="text-white ">Username</label>
                    <input class="rounded outline-none text-black p-2" type="text" wire:model="name">
                </div>


                <div class=" p-6 text-xl flex justify-center rounded relative  ">
                    <button class="bg-custom-black1  p-2 text-xl w-full sm:w-fit rounded" wire:click="Edit"
                        wire:loading.remove>Edit</button>
                    @include('components.spinner-btn', ['target' => 'Edit'])
                </div>



            </div>
        </div>
    </div>

</div>
