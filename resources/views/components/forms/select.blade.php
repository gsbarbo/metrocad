@props([
    'name',
    'label' => null,
    'help' => null,
    'required' => null,
    'mdt' => null,
])

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

    <select
        id="{{ $name }}"
        name="{{ $name }}"
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
        {{ $slot }}
    </select>

    @error($name)
    <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
