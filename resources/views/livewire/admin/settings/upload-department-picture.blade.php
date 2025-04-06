<div class="mb-3">
    <div class="flex justify-between">
        <label class="label-dark" for="initials">
            {{ $title }}
        </label>
        @if ($photo)
            <div class="my-2">
                <p>Preview</p>
                <img alt="" class="w-16 h-16 border border-red-500" src="{{ $photo->temporaryUrl() }}">
            </div>
        @elseif($default_image)
            <div class="my-2">
                <p>Current</p>
                <img alt="" class="w-16 h-16" src="{{ $default_image }}">
            </div>
        @endif
    </div>

    <input accept="image/png, image/jpeg, image/gif" class="form-text-input-dark mt-3" name="logo" type="file"
        wire:model="photo">

    @error('photo')
        <span class="error">{{ $message }}</span>
    @enderror
</div>
