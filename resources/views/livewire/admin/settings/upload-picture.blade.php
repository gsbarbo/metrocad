<form wire:submit="save">
    <div class="p-3">
        <div class="flex justify-between">
            <div>
                <p class="text-lg font-semibold">{{ $title }}</p>
                <p>{{ $help_text }}</p>
            </div>
            @if ($photo)
                <div class="my-2">
                    <p>Preview</p>
                    <img alt="" class="w-16 h-16 border border-red-500" src="{{ $photo->temporaryUrl() }}">
                </div>
            @else
                <img alt="" class="w-16 h-16" src="{{ get_setting($setting_name) }}">
            @endif

        </div>

        <input accept="image/png, image/jpeg, image/gif" class="text-input mt-3" type="file" wire:model="photo">

        @error('photo')
            <span class="error">{{ $message }}</span>
        @enderror
    </div>
    @if ($photo)
        <button class="btn bg-navbar text-white hover:opacity-85" type="submit">Save {{ $title }} Image</button>
    @endif

</form>
