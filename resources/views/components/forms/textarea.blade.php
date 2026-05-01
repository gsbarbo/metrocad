@props([
    'name',
    'id' => null,
    'label' => null,
    'rows' => 4,
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

    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        @required($required)
        {{ $attributes->merge(['class' => $inputClass]) }}
    >{{ old($name, $slot->isEmpty() ? '' : $slot) }}</textarea>

    @if ($help)
        <p class="form-help-text">{{ $help }}</p>
    @endif

    @error($name)
        <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
