<div class="m-auto w-full sm:w-4/5  h-full flex justify-center gap-4 items-center flex-col mt-8 ">

    <div class="text-xl text-blue-500 font-bold text-center p-2 animate-pulse  " wire:loading>
        Loading...
    </div>

    <div class="rounded bg-[#1a1d1f]  w-full sm:w-3/5 h-fit p-2  ">
        <div class="text-white flex  font-bold text-start p-2 justify-between border-b-2 border-[#111315]">
            <h1 class="text-4xl">Create Post</h1>
            <div class="text-xl flex items-center  justify-end gap-4">
                <button class="text-blue-500" wire:click="draft">Draft</button>
                <button class="text-blue-500" wire:click="post">Post</button>
            </div>
        </div>
        <div>
            <livewire:live-toolbar />
        </div>
        <div class="text-white text-xl h-80  flex flex-col mt-2">
            <div placeholder="your creativity is located here . . ."
                class=" overflow-auto p-2 resize-none bg-transparent outline-none  flex-grow border-2 border-[#111315] rounded 
              ">



                @if (count($elements) === 0 || $elements === null)
                    <p class="text-[#9ca3af]">magic happens here...</p>
                @else
                    @foreach ($elements as $element)
                        @include('components.post-logic.post-structure')
                    @endforeach


                @endif

            </div>

            <div class="flex  justify-end gap-4 ">

                <label for="upload-input" wire:loading.attr="disabled"
                    class="block rounded p-2  text-white cursor-pointer">
                    <i class="fa-regular fa-image"></i>
                </label>
                <input type="file" id="upload-input" hidden accept="png,jpg">
                <button id="submit-btn" hidden>ok</button>
                <x-ImgUploadScript />

            </div>
        </div>

        <div class="w-full flex text-white text-xl ">

            <textarea placeholder="your creativity is located here . . ." wire:model.defer="input"
                class=" p-2 resize-none bg-transparent outline-none w-full flex-grow border-2 border-[#111315] rounded 
            {{ $bold ? 'font-bold' : '' }}
            {{ $red ? 'text-red-600' : '' }}
            {{ $blue ? 'text-blue-600' : '' }}
            {{ $green ? 'text-green-600' : '' }}">
         </textarea>
            <button class="p-2 rounded text-white text-xl bg-blue-500" wire:click="insert">insert</button>


        </div>

    </div>



</div>
