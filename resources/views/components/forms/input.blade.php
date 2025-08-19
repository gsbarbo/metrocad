@props([
    'name',
    'label' => null,
    'type' => 'text',
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

    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $slot->isEmpty() ? '' : $slot) }}"
        {{ $attributes->merge(['class' =>
            'form-text-input'
        ]) }}
        @if($required) required @endif
    >

    @error($name)
    <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
