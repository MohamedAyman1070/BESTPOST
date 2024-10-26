<div class="fixed right-5 sm:top-20  top-48    w-fit  ">
    <div class="w-full">
        @if ($err)
            @include('components.toast', ['text' => $err, 'color' => 'bg-red-500', 'wire' => 'closeToast'])
        @endif
    </div>
</div>
