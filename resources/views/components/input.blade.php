<div class=" text-[#2f3367] mb-2 w-full">
    <label class="text-xl" for={{ $forWhat }}>{{ $forWhat }}</label>
    <input wire:model="{{$forName}}" class="w-full text-[#2f3367] p-2  outline-none bg-slate-200 rounded" type={{ $forType }}
        name={{ $forName }} placeholder="Enter your {{ $forPlace }}" value="{{$value ?? ''}}">
    @error("{{ $forName }}")
        <span class="text-red-600">{{ $message }}</span>
    @enderror
</div>
