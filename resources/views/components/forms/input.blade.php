@props([
    'name',
    'id' => null,
    'label' => null,
    'type' => 'text',
    'value' => null,
    'help' => null,
    'required' => false,
    'mdt' => false,
])

@php
    $label = $label ?? ucwords(str_replace('_', ' ', $name));
    $id = $id ?? str_replace(['[', ']'], ['_', ''], $name);
    $inputClass = $mdt ? 'mdt-input' : 'form-input';
@endphp

<div class="space-y-1">
    @if ($label)
        <label for="{{ $id }}" class="label">
            {{ $label }}
            @if ($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif

    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}"
        @required($required) {{ $attributes->merge(['class' => $inputClass]) }}>

    @if ($help)
        <p class="form-help-text">{{ $help }}</p>
    @endif

    @error($name)
        <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
