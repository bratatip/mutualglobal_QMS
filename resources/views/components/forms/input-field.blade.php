@props([
    'type' => 'text',
    'name',
    'label' => '',
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'inputmode' => '',
    'step' => '',
])

<div>
    @if (!empty($label))
        <label for="{{ $name }}"
            class="text-[#0F628B] text-sm">
            {{ $label }}
            @if ($required)
                <span class="text-red-600"><strong>*</strong></span>
            @endif
        </label>
    @endif
</div>

<div class="w-full">
    @if (!empty($type) && $type === 'text')
        <input type="{{ $type }}"
            {{ $attributes->merge(['class' => 'h-8 p-1 w-11/12 border-[#CCCCCC] border-1 border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs', 'id' => $name]) }}
            name="{{ $name }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
            @if ($type === 'number') inputmode="decimal" step="any" @endif>
    @elseif (!empty($type) && $type === 'number')
        <input type="{{ $type }}"
            {{ $attributes->merge(['class' => 'h-8 p-1 w-11/12 border-[#CCCCCC] border-1 border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs', 'id' => $name]) }}
            name="{{ $name }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif
            @if ($inputmode) inputmode @endif>
            @if ($step) step @endif>
    @elseif (!empty($type) && $type === 'textarea')
        <textarea
            {{ $attributes->merge(['class' => 'p-1 w-11/12 border-[#CCCCCC] border-1 border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs', 'id' => $name]) }}
            name="{{ $name }}"
            id="{{ $name }}"
            placeholder="{{ $placeholder }}"
            @if ($disabled) disabled @endif
            @if ($readonly) readonly @endif></textarea>
    @endif
</div>
