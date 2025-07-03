<div>
    <div>
        <label class="label-dark" for="address">Address Search<span class="text-red-600">*</span></label>
        <input class="form-text-input-dark" type="text" value="{{ old('address') }}"
            wire:model.live.debounce.500ms="addressSearch">
    </div>

    <div class="mt-2">
        <select class="form-select-input-dark" id="address_values_id" name="address_values_id"
            wire:model.live='addressesSelected'>
            @forelse ($addresses as $address)
                <option @selected(old('address_values_id') == $address->id) value="{{ $address->id }}">{{ $address->full_address }}
                </option>
            @empty
                @if ($addressSearch)
                    <option value="0">No address matching search of {{ $addressSearch }}.</option>
                @else
                    <option value="0">Need to search above for an address.</option>
                @endif
            @endforelse
        </select>
        @error('address_values_id')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
