@props(['name', 'label' => '', 'options' => [], 'selected' => null])

<div>
    <label for="{{ $name }}"
        class="text-[#0F628B] text-sm">
        {{ $label }}
        @if ($attributes->has('required'))
            <span class="text-red-600"><strong>*</strong></span>
        @endif
    </label>
</div>

<div>
    <select
        {{ $attributes->merge(['class' => 'w-11/12 border-[#CCCCCC] border-1 border-solid focus:ring-0 focus:border-[#FFC451] focus:border-1', 'id' => $name, 'name' => $name]) }}
        id="{{ $name }}"
        name="{{ $name }}">
        <option value=""
            disabled
            selected
            class="text-gray-500 text-xs">Select {{ $label }}</option>
        @foreach ($options as $value)
            <option value="{{ $value->uuid }}"
                {{ old($name) == $value || $selected == $value ? 'selected' : '' }}>
                {{ $value->risk_occupancy }}
            </option>
        @endforeach
    </select>
</div>
