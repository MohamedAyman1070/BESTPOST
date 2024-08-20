@if (str_contains($element, '/img/'))
<img class="w-full h-80 object-cover  rounded mt-2" src="{{str_replace('/img/' , '' , stristr($element , '/img_id/' , true))}}"
    alt="photo">
    
@elseif (str_contains($element, '/mid/'))
@include('components.post-logic.text-align-logic', [
    'align_code' => '/mid/',
    'align' => 'text-center',
])
@elseif(str_contains($element, '/start/'))
@include('components.post-logic.text-align-logic', [
    'align_code' => '/start/',
    'align' => 'text-start',
])
@elseif(str_contains($element, '/end/'))
@include('components.post-logic.text-align-logic', [
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