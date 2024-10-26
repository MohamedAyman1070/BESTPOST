<div class="flex flex-col p-2 gap-2 mt-2 bg-custom-black1   rounded" wire:loading.flex wire:target="delete">

    <div class="flex gap-2 border-b-2 p-2 border-custom-black2 ">

        <span class="rounded-full  w-14 h-14 bg-custom-black2 animate-pulse"></span>

        <div class="flex justify-between   flex-grow ">
            <div class="flex  flex-col flex-grow gap-2 ">
                <span class="p-2 w-2/5 bg-blue-500 animate-pulse rounded-md"></span>
                <span class="p-2 w-1/5 bg-gray-600 animate-pulse rounded-md"></span>
            </div>
            <div class="flex flex-col items-end gap-2 w-2/5  ">
                <span class="p-2 w-1/5 bg-gray-400  h-4 animate-pulse rounded-md"></span>
                <span class="p-2 w-2/5  bg-blue-500 rounded animate-pulse"></span>
            </div>
        </div>

    </div>


    <div class="flex flex-col  gap-2 w-full">
        <span class="p-14  bg-gray-500 text-center w-full  text-gray-700 animate-pulse rounded-md "><b>Image</b></span>
        <div class="flex flex-col w-full">
            @for ($i = 0; $i < 8; $i++)
                <span class="p-2 rounded  animate-pulse bg-white mt-2  "></span>
            @endfor
        </div>
    </div>
</div>
