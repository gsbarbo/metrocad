@php
    $classes = "flex items-center p-2 text-white rounded-lg transition-colors duration-150 ease-in-out focus:outline-none focus:shadow-outline";

    if (isset($active) && $active) {
        $classes .= " bg-[#222423]";
    }

    if (!isset($noHover)) {
        $classes .= " hover:bg-[#222423]";
    }

@endphp

<a
    {{ $attributes->merge(
        ['class' => $classes]
    ) }}
    href="{{ $href }}">
    {{ $icon }}
    <span class="text-nowrap overflow-hidden ml-2 duration-300 ease-in-out">
        {{ $slot }}
    </span>
</a>
