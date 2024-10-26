<form class="flex p-2 gap-2  border-custom-black2" wire:submit.prevent="{{ $comment_function }}">
    {{-- <div class="">
        <div class=" w-fit  rounded-full"
            style="background-color: rgb({{ auth()->user()->background_color }});">
            <img class="w-12 h-12 rounded-full object-cover "
                src="{{ auth()->user()->photos->url ?? asset('/images/profile.png') }}" alt="profile">
        </div>
    </div> --}}
    <div class="w-full flex flex-col items-end justify-items-center gap-2">
        <textarea wire:model.defer="comment_body" class="p-2 rounded w-full bg-custom-black2 outline-none text-white"
            placeholder="Add a comment..."></textarea>
        <button wire:loading.remove wire:target="{{ $comment_function }}"
            class="rounded   w-fit bg-custom-black2  text-white p-2 ">submit</button>
        @include('components.spinner-btn', ['target' => $comment_function, 'width' => 'w-fit'])
    </div>
</form>
