<div class="fixed right-3 sm:right-5 top-20      w-fit z-30  ">
    <div class="w-full">
        @if ($err)
            @include('components.toast', ['text' => $err, 'color' => 'bg-red-500', 'wire' => 'closeToast'])
        @endif
    </div>
</div>
