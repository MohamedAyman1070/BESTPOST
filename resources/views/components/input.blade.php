<div class=" text-custom-text mb-2 w-full">
    <label class="text-xl" for={{ $forWhat }}>{{ $forWhat }}</label>
    <input wire:model="{{ $forName }}" class="w-full  text-custom-text p-2  outline-none  bg-slate-400  rounded"
        type={{ $forType }} name={{ $forName }} placeholder="Enter your {{ $forPlace }}"
        value="{{ $value ?? '' }}">
    @error("{{ $forName }}")
        <span class="text-red-600">{{ $message }}</span>
    @enderror
</div>
