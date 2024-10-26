<div class="rounded bg-custom-black2  grid grid-cols-2 gap-2 sm:gap-0 sm:grid-cols-3   p-2">

    <div class="flex gap-2  ">
        <div class="bg-blue-400 p-2 rounded">
            <button wire:click="bold">
                <i class="fa-solid fa-bold"></i>
            </button>
        </div>

        <div class="flex gap-2 ">
            <div class="bg-blue-400 p-2 rounded">
                <button wire:click="$dispatch('text-start')">
                    <i class="fa-solid fa-align-left"></i>
                </button>
            </div>
            <div class="bg-blue-400 p-2 rounded">
                <button wire:click="$dispatch('text-mid')">
                    <i class="fa-solid fa-align-center"></i>
                </button>
            </div>
            <div class="bg-blue-400 p-2 rounded">
                <button wire:click="$dispatch('text-end')">
                    <i class="fa-solid fa-align-right"></i>
                </button>
            </div>
        </div>
    </div>


    <div class=" inline-flex items-center justify-end sm:justify-center gap-2 text-white  ">
        <p></p>
        <div class="flex gap-2 h-fit items-center ">
            <button class="h-5  w-5 rounded  " style="background-color: red" wire:click="red"></button>
            <button class="h-5 w-5 rounded " style="background-color: blue" wire:click="blue"></button>
            <button class="h-5 w-5 rounded  " style="background-color: green" wire:click="green"></button>
            <button class="h-5 w-5 rounded " style="background-color: white" wire:click="white"></button>
        </div>
    </div>


    <div class="flex justify-center sm:justify-end sm:col-span-1 col-span-2 gap-2">
        <div class="bg-blue-400 p-2 rounded">
            <button wire:click="back">
                <i class="fa-solid fa-rotate-left"></i>
            </button>
        </div>
        <div class="bg-blue-400 p-2 rounded">
            <button wire:click="forward">
                <i class="fa-solid fa-rotate-right"></i>
            </button>
        </div>
    </div>
</div>
