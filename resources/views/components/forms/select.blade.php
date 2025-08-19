@props([
    'name',
    'label' => null,
    'help' => null,
    'required' => null,
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
        {{ $attributes->merge([
            'class' =>
                'form-select-input'
        ]) }}
        @if($required) required @endif
    >
        {{ $slot }}
    </select>

    @error($name)
    <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
