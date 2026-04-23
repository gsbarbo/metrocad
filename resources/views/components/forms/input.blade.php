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
    $inputClass = $mdt ? 'mdt-text-input' : 'form-text-input';
@endphp

<div class="space-y-1">
    @if ($label)
        <label for="{{ $id }}" class="label">
            {{ $label }}
            @if ($required)
                <span class="form-error-text">*</span>
            @endif
        </label>
    @endif

    @if ($help)
        <p class="form-help-text">{{ $help }}</p>
    @endif

    <input id="{{ $id }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}"
        @required($required) {{ $attributes->merge(['class' => $inputClass]) }}>

    @error($name)
        <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
