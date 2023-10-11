@props(['name', 'label' => '', 'options' => [], 'selected' => null, 'required' => false, 'disabled' => false, 'readonly' => false])


@if (!empty($label))
    <label for="{{ $name }}"
        class="text-[#0F628B] text-sm">
        {{ $label }}
        @if ($required)
            <span class="text-red-600"><strong>*</strong></span>
        @endif
    </label>
@endif


<div class="w-full">
    <select
        {{ $attributes->merge([
            'class' =>
                'h-8 p-1 w-11/12 border-[#CCCCCC] text-gray-500 text-xs border-1 border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1',
            'id' => $name,
            'name' => $name,
            'disabled' => $disabled,
            'readonly' => $readonly,
        ]) }}>
        <option value=""
            disabled
            selected
            class="text-gray-500 text-xs">Select {{ $name }}</option>
        @foreach ($options as $value => $text)
            <option value="{{ $value }}"
                {{ old($name) == $value || $selected == $value ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>
</div>
