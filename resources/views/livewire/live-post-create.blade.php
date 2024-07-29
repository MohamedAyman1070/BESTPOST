<div class="m-auto w-full sm:w-4/5  h-full flex justify-center gap-4 items-center flex-col  ">



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
                        @if (str_contains($element, '/img/'))
                            <img class="w-full h-80" src="{{ str_replace('/img/', '', $element) }}" alt="photo">
                        @elseif (str_contains($element, '/mid/'))
                            @include('components.post-create.text-align-logic', [
                                'align_code' => '/mid/',
                                'align' => 'text-center',
                            ])
                        @elseif(str_contains($element, '/start/'))
                            @include('components.post-create.text-align-logic', [
                                'align_code' => '/start/',
                                'align' => 'text-start',
                            ])
                        @elseif(str_contains($element, '/end/'))
                            @include('components.post-create.text-align-logic', [
                                'align_code' => '/end/',
                                'align' => 'text-end',
                            ])
                        @else
                            @if (str_contains($element, '/bold/'))
                                @include('components.post-logic.text-bold-logic')
                            @else
                                @include('components.post-logic.text-color-logic')
                            @endif
                        @endif
                    @endforeach


                @endif

            </div>








            <div class="flex  justify-end gap-4 ">

                @if ($photo)
                    <div class="flex gap-2 m-2 items-center">
                        <button class="bg-blue-500 font-bold rounded p-2" wire:click="saveImg"><i
                                class="fa-solid fa-upload"></i></button>
                    </div>
                @else
                    <label for="upload" wire:loading.attr="disabled"
                        class="block rounded p-2  text-white cursor-pointer">
                        <i class="fa-regular fa-image"></i>
                        <input type="file" id="upload" wire:model="photo" hidden accept="png,jpg">
                    </label>
                @endif




            </div>
        </div>

        <div class="w-full flex text-white text-xl " >
           
            <textarea placeholder="your creativity is located here . . ." wire:model.defer="input"
                class=" p-2 resize-none bg-transparent outline-none w-full flex-grow border-2 border-[#111315] rounded 
            {{ $bold ? 'font-bold' : '' }}
            {{ $red ? 'text-red-600' : '' }}
            {{ $blue ? 'text-blue-600' : '' }}
            {{ $green ? 'text-green-600' : '' }}"
            >
         </textarea>
            <button class="p-2 rounded text-white text-xl bg-blue-500" wire:click="insert">insert</button>
        
          
        </div>

    </div>

    <livewire:err-toast />
    

</div>
