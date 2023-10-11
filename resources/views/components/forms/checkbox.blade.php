@props([
    'id',
    'name',
    'checked' => false,
    'value' => '1',
    'class' => 'form-checkbox w-3 h-3 cursor-pointer focus:ring-transparent',
    'disabled' => false,
    'readonly' => false,
])

<input type="checkbox"
    id="{{ $id }}"
    name="{{ $name }}"
    value="{{ $value }}"
    @if($checked) checked @endif
    {!! $attributes->merge(['class' => $class]) !!}
    @if($disabled) disabled @endif
    @if($readonly) readonly @endif>
