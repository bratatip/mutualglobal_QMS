@props([
    'type' => 'text',
    'name',
    'placeholder',
])

<div>
    <label for="{{ $name }}"
        class="text-[#0F628B] text-sm">{{ $label }}
        @if ($required)
            <span class="text-red-600"><strong>*</strong></span>
        @endif
    </label>
</div>

<div>
    <input type="{{ $type }}"
        {{ $attributes->merge(["class =>'h-8 p-1 w-11/12 border-[#CCCCCC] border-1 border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1 bg-white overflow-hidden text-gray-500 text-xs @error($name) border-red-500 @enderror"]) }}
        name="{{ $name }}"
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        @if ($disabled) disabled @endif
        @if ($readonly) readonly @endif
        @if ($type === 'number') inputmode="decimal" step="any" @endif>
</div>
