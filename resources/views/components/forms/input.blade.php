@props([
    'name',
    'label' => null,
    'type' => 'text',
    'help' => null,
    'required' => null,
    'mdt' => null,

])

@php
    if(!$label){
        $label = ucwords(str_replace('_', ' ', $name));
    }
@endphp

<div class="space-y-1">
    @if($label)
        <label for="{{ $name }}" class="label">
            {{ $label }}
            @if($required)
                <span class="form-error-text">*</span>
            @endif
        </label>
    @endif
    @if($help)
        <p class="form-help-text">{!! $help !!}</p>
    @endif

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $slot->isEmpty() ? '' : $slot) }}"
        @if($mdt)
            {{ $attributes->merge(['class' =>
                'mdt-text-input'
            ]) }}
        @else
            {{ $attributes->merge(['class' =>
            'form-text-input'
        ]) }}
        @endif
        @if($required) required @endif
    >

    @error($name)
    <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
