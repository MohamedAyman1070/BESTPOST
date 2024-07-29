@if (str_contains($element, '/red/'))
<p class="text-red-600">{{ str_replace('/red/', '', $element) }}</p>
@elseif(str_contains($element, '/green/'))
<p class="text-green-600">{{ str_replace('/green/', '', $element) }}</p>
@elseif(str_contains($element, '/blue/'))
<p class="text-blue-600">{{ str_replace('/blue/', '', $element) }}</p>
@else
<p>{{ $element }}</p>
@endif