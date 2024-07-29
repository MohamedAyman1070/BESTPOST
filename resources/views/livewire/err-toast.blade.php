<div class="absolute right-5 top-2   w-fit ">
    <div class="w-full">
        @if ($err)
            @include('components.toast', ['text' => $err, 'color' => 'bg-red-500', 'wire' => 'closeToast'])
        @endif
    </div>
</div>
