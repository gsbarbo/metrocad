<?php

use App\Models\Address;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;

new class extends Component {

    public string $addressSearch;

    public Collection $addresses;

    public function with(): array
    {
        $this->addresses = collect();
        if (!empty($this->addressSearch)) {
            $this->addresses = Address::query()
                ->whereAny(['postal', 'street', 'city', 'name'], 'like', '%'.$this->addressSearch.'%')
                ->get();
        }

        return ['addresses' => $this->addresses];
    }
}
?>

<div>
    <div>
        <label class="label-dark font-bold text-lg" for="address">Address Search<span
                class="text-red-600">*</span></label>
        <input class="mdt-text-input" type="text" value="{{ old('address') }}"
               wire:model.live.debounce.500ms="addressSearch">
    </div>

    <div class="mt-2">
        <select class="mdt-select-input" id="address_id" name="address_id" wire:model.live='addressesSelected'>
            @forelse ($addresses as $address)
                <option
                    @selected(old('address_id') == $address->id) value="{{ $address->id }}">{{ $address->full_address }}
                    {{ $address->name ? '(' . $address->name . ')' : '' }}
                </option>
            @empty
                @if ($addressSearch)
                    <option value="">No address matching search of {{ $addressSearch }}.</option>
                @else
                    <option value="">Need to search above for an address.</option>
                @endif
            @endforelse
        </select>
        @error('address_id')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>
