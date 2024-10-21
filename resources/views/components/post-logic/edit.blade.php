<div x-show="{{ $posName }}" class="bg-custom-black2 p-2 rounded mb-2 mt-2 relative">

    <input
        class="w-full  outline-none border-none bg-transparent  
                        {{ $bold ? 'font-bold' : '' }}
            {{ $red ? 'text-red-600' : '' }}
            {{ $blue ? 'text-blue-600' : '' }}
            {{ $green ? 'text-green-600' : '' }}
             {{ $textMid ? 'text-center' : '' }}
            {{ $textStart ? 'text-start' : '' }}
            {{ $textEnd ? 'text-end' : '' }}"
        type="text" wire:model="input">


    <template x-if="photo == null">
        <label class="absolute right-24  -top-2  rounded  cursor-pointer  ">
            <i class="fa-regular fa-image"></i>
            <input id="upload" type="file" wire:model="photo" hidden accept="png,jpg">
        </label>
    </template>
    <template x-if="photo != null">
        <button class=" text-white text-sm  rounded-md  absolute -top-2  right-24   "
            @click="{{ $posName }} = false  "
            wire:click="savePhoto('{{ $element }}' , {{ $posNumber }})"><i
                class="fa-solid fa-upload"></i></button>
    </template>

    <button class=" text-white text-sm  rounded-md  absolute -top-2  right-12   "
        @click="{{ $posName }} = false , photo=null   "
        wire:click="saveRow('{{ $element }}'  , {{ $posNumber }} )">save</button>

    <button x-on:click="{{ $posName }} = false , input=null ,photo=null "
        class="w-4 h-4 absolute right-5  -top-2  rounded-full bg-red-600 flex justify-center items-center">
        <p class="-mt-1">x</p>
    </button>

</div>
