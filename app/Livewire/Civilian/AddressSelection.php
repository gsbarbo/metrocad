<?php

namespace App\Livewire\Civilian;

use App\Models\Address;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class AddressSelection extends Component
{
    public $addressSearch;

    public $addresses;

    public $addressesSelected;

    public function render()
    {
        if (empty($this->addressSearch)) {
            $this->addresses = collect(); // empty collection
        } else {
            $this->addresses = Address::query()
                ->where(function (Builder $query) {
                    $query->where('postal', 'like', '%'.$this->addressSearch.'%')
                        ->orWhere('street', 'like', '%'.$this->addressSearch.'%')
                        ->orWhere('city', 'like', '%'.$this->addressSearch.'%');
                })
                ->get();
        }

        return view('livewire.civilian.address-selection');
    }
}
