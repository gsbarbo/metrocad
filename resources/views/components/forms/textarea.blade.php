@props([
    'name',
    'label' => null,
    'rows' => 4,
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

    <textarea
        id="{{ $name }}"
        name="{{ $name }}"
        rows="{{ $rows }}"
        {{ $attributes->merge([
            'class' =>
                'form-textarea'
        ]) }}
        @if($required) required @endif
    >{{ old($name, $slot->isEmpty() ? '' : $slot) }}</textarea>

    @error($name)
    <p class="form-error-text">{{ $message }}</p>
    @enderror
</div>
