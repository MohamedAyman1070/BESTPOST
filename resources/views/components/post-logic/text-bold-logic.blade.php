<div class="font-bold">
    @if (str_contains($element, '/red/'))
        <p class="text-red-600">
            {{ str_replace('/red/', '', str_replace('/bold/', '', $element)) }}</p>
    @elseif(str_contains($element, '/green/'))
        <p class="text-green-600">
            {{ str_replace('/green/', '', str_replace('/bold/', '', $element)) }}</p>
    @elseif(str_contains($element, '/blue/'))
        <p class="text-blue-600">
            {{ str_replace('/blue/', '', str_replace('/bold/', '', $element)) }}</p>
    @else
        <p>{{ str_replace('/bold/', '', $element) }}</p>
    @endif
</div>