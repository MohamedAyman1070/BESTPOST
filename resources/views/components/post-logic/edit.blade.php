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


    {{-- <template x-if="photo == null">
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
    </template> --}}

    <label for="upload-input" class="absolute right-24  -top-2  rounded  cursor-pointer  ">
        <i class="fa-regular fa-image"></i>
    </label>
    <input id="upload-input" type="file" hidden accept="png,jpg">
    <button hidden id="submit-btn"></button>
    @script
        <script>
            const btn = document.getElementById('submit-btn');
            const upload = document.getElementById('upload-input');
            var img = null
            const formData = new FormData();
            upload.onchange = () => {
                img = upload.files[0];
                if (img.size > 1024 * 1024) {
                    Livewire.dispatch('show-toast', {
                        err: "image is too large"
                    })
                } else {
                    formData.append('file', img);
                    formData.append('upload_preset', 'bestpost-test-preset')
                    btn.click();
                }
            }
            btn.onclick = async function() {
                try {
                    const response = await fetch('https://api.cloudinary.com/v1_1/drm3bzgpi/image/upload', {
                        method: 'POST',
                        body: formData
                    });
                    const data = await response.json();
                    const info = {
                        img_info: [
                            data.secure_url,
                            data.public_id
                        ],
                        element: "{{ $element }}",
                        pos: {{ $posNumber }}

                    };
                    Livewire.dispatch('info-uploaded', info);
                } catch (e) {
                    console.log(e)
                }
            }
        </script>
    @endscript


    <button class=" text-white text-sm  rounded-md  absolute -top-2  right-12   "
        @click="{{ $posName }} = false , photo=null   "
        wire:click="saveRow('{{ $element }}'  , {{ $posNumber }} )">save</button>

    <button x-on:click="{{ $posName }} = false , input=null ,photo=null "
        class="w-4 h-4 absolute right-5  -top-2  rounded-full bg-red-600 flex justify-center items-center">
        <p class="-mt-1">x</p>
    </button>

</div>
