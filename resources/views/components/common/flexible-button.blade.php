@props([
    'type' => 'button',
    'text' => 'Button Text',
    'classes' => '',
    'href' => '',
    'target' => '',
])

@if($href)
    <a href="{{ $href }}" target="{{ $target }}" {{ $attributes->merge(['class' => 'inline px-6 py-2 mt-3 border border-solid rounded-2xl border-dark bg-gradient-to-r from-[#ef4444] to-[#15803d] bg-clip-text text-transparent text-xs ml-2 font-bold ' . $classes]) }}>
        {{ $text }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'logout_button block px-6 py-2 mt-3 border border-solid border-dark rounded-2xl bg-white text-xs text-[#0F628B] hover:bg-gray-100 ml-2 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white font-bold ' . $classes]) }}>
        {{ $text }}
    </button>
@endif
