@props([ 
    'icon', 
    'title', 
    'value', 
    'soles' => null, 
    'dolar' => null, 
    'pick' => null, 
    'color', 
    'linkText', 
    'linkUrl'
])

@php
    $colors = [
        'green' => 'border-green-200 border-b-green-500 text-green-600 dark:text-green-400',
        'red' => 'border-red-200 border-b-red-500 text-red-600 dark:text-red-400',
        'yellow' => 'border-yellow-200 border-b-yellow-500 text-yellow-600 dark:text-yellow-400',
        'purple' => 'border-purple-200 border-b-purple-500 text-purple-600 dark:text-purple-400',
        'blue' => 'border-blue-200 border-b-blue-500 text-blue-600 dark:text-blue-400',
        'sky' => 'border-sky-200 border-b-sky-500 text-sky-600 dark:text-sky-400',
        'rose' => 'border-rose-200 border-b-rose-500 text-rose-600 dark:text-rose-400',
        'stone' => 'border-stone-200 border-b-stone-500 text-stone-600 dark:text-stone-400',
        'cyan' => 'border-cyan-200 border-b-cyan-500 text-cyan-600 dark:text-cyan-400',
    ];

    $selectedColor = $colors[$color] ?? 'border-gray-300 text-gray-700';

    $valueClass = in_array($color, ['green', 'red', 'cyan']) 
        ? 'text-sm font-semibold ' . $selectedColor
        : 'text-2xl font-semibold mb-4 ' . $selectedColor;
@endphp

<div class="p-6 bg-white dark:bg-gray-900 border-4 {{ $selectedColor }} rounded-2xl shadow-md hover:shadow-lg transition-shadow duration-300 text-center min-h-[250px]">
    <div class="flex justify-center mb-4">
        <div class="bg-blue-100 dark:bg-blue-800 p-3 rounded-full">
            <x-dynamic-component :component="$icon" class="w-6 h-6 text-blue-600 dark:text-blue-300" />
        </div>
    </div>

    <h5 class="text-xs font-bold mb-2 {{ $selectedColor }}">{{ $title }}</h5>

    @if(in_array($color, ['green', 'red']))
        <p class="{{ $valueClass }}">Euros: {{ $value }}</p>
        @if($soles)
            <p class="{{ $valueClass }}">PEN: {{ $soles }}</p>
        @endif
        @if($dolar)
            <p class="{{ $valueClass }}">Dólar: {{ $dolar }}</p>
        @endif
    @elseif($color === 'cyan')
        <p class="{{ $valueClass }}">{{ $value }}</p>
        @if($pick)
            <p class="{{ $valueClass }}">{{ $pick }}</p>
        @endif
    @else
        <p class="{{ $valueClass }}">{{ $value }}</p>
    @endif

<a class="mt-4"  href="{{ $linkUrl }}" {!! $attributes->has('onclick') ? 'onclick="'.$attributes['onclick'].'"' : '' !!}>
        {{ $linkText }}
       
    </a>
</div>
