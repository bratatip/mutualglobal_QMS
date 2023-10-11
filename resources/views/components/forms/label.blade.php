@props([
    'text' => '',
    'required' => false,
    'class' => '',
])

<label {{ $attributes->merge(['class' => 'text-[#0F628B] text-sm ' . $class]) }}>
    {{ $text }}
    @if ($required)
        <span class="text-red-600"><strong>*</strong></span>
    @endif
</label>
