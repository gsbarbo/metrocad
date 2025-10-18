<?php

use App\Models\Address;
use App\Models\Call;
use App\Models\License;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;

new class extends Component {

    public Collection $licenses;

    public License|null $selectedLicense;
    public int|null $selectedLicenseId;

    public function with(): array
    {
        $this->selectedLicense = null;
        if (!empty($this->selectedLicenseId) && $this->selectedLicenseId > 0) {
            $this->selectedLicense = $this->licenses->where('id', $this->selectedLicenseId)->first();
        }

        return ['selectedLicense' => $this->selectedLicense];
    }
}

?>

<div class="col-span-6">
    <div class="grid grid-cols-6 gap-3">

        <div class="col-span-5">
            <x-forms.select name="license_id" label="License" mdt required wire:model.live="selectedLicenseId">
                <option value="">Choose License</option>
                @foreach($licenses as $license)
                    <option
                        value="{{$license->id}}">{{$license->number}} -
                        {{$license->license_type->name}}</option>
                @endforeach
            </x-forms.select>
        </div>


        <x-forms.select name="suspend_license" label="Suspend Lic." mdt required>
            <option value="0">No</option>
            <option value="1">Yes</option>
        </x-forms.select>

        @if($selectedLicense)

            <x-forms.input name="" label="License Number" mdt readonly>
                {{$selectedLicense->number}}
            </x-forms.input>
            <div class="col-span-2">
                <x-forms.input name="" label="License Type" mdt readonly>
                    {{$selectedLicense->license_type->name}}
                </x-forms.input>
            </div>
            <x-forms.input name="" label="Expires" mdt readonly>
                {{$selectedLicense->expires_at->format(get_setting('general.dateFormat'))}}
            </x-forms.input>

            <x-forms.input name="" label="Points" mdt readonly>
                {{$selectedLicense->points}}
            </x-forms.input>

        @endif

    </div>


</div>
