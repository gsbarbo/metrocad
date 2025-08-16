<?php

use App\Enum\CivilianStatus;
use App\Enum\VehicleStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {

    #[\Livewire\Attributes\Url]
    public string $plate = '';

    public Collection $results;
    public bool $error = false;
    public string $searchText = 'No Search Ran';

    public bool $searchStolenVehicles = true;
    public bool $searchImpoundedVehicles = true;
    public bool $searchBootedVehicles = true;


    public function mount(): void
    {
        $this->results = collect();

        if ($this->hasValidSearch()) {
            $this->search();
        }
    }

    private function hasValidSearch(): bool
    {
        return (strlen($this->plate) > 2);
    }

    public function search(): void
    {
        $this->error = false;

        if (!$this->hasValidSearch()) {
            $this->error = true;
            $this->results = collect();
            $this->searchText = 'No valid search provided.';
            return;
        }
        $query = \App\Models\Vehicle::query();

        // Apply filters
        $query->where(function (Builder $q) {
            if ($this->plate) {
                $this->applyPlateSearch($q);
            }
        });

        $query->where(function (Builder $q) {
            if ($this->searchStolenVehicles) {
                $q->orWhere('status', VehicleStatus::Stolen->value);
            }
            if ($this->searchImpoundedVehicles) {
                $q->orWhere('status', VehicleStatus::Impounded->value);
            }
            if ($this->searchBootedVehicles) {
                $q->orWhere('status', VehicleStatus::Booted->value);
            }

            $q->orWhere('status', VehicleStatus::Valid->value);

        });

        $results = $query->get();

        $this->handleSingleResult($results);

        $this->results = $results;
        $this->searchText = "Your search returned: {$results->count()} vehicles.";
    }

    private function applyPlateSearch(Builder $query): void
    {
        $query->orWhere(function (Builder $q) {
            $q->where('plate', 'like', '%'.$this->plate.'%');
        });
    }

    private function handleSingleResult(Collection $results): void
    {
        if ($results->count() === 1) {
            redirect()->route('mdt.vehicleReturn', $results->first()->id);
        }
    }

}
?>

<div>
    <h2 class="text-2xl flex items-center">
        <svg class="w-10 h-10" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <span class="ml-3">Vehicle Search</span>
    </h2>
    <div class="grid grid-cols-12 gap-4 mt-4">
        <div class="p-2 col-span-10">
            <div class="grid grid-cols-6 gap-4 border-2 p-2">
                <div class="col-span-4">
                    <label class="label-dark font-bold text-lg">Requesting Unit:</label>
                    <input class="mdt-select-input" type="text"
                           value="{{auth()->user()->active_unit->officer->name}}"
                           disabled>
                </div>
                <div class="col-span-2"></div>
                @if($error)
                    <div class="col-span-6">
                        <div
                            class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                            role="alert">
                            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Error:</span> Please Try Again
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-span-2">
                    <label class="label-dark font-bold text-lg">License Plate:</label>
                    <input class="mdt-text-input text-3xl" placeholder="Plate" autofocus type="text"
                           wire:model='plate'>
                </div>
            </div>
        </div>

        <div class="p-2 col-span-2">
            <div>
                <input class="" type="checkbox" id="searchImpoundedVehicles" wire:model="searchImpoundedVehicles">
                <label class="label-dark inline-block underline cursor-pointer" for="searchImpoundedVehicles">Local
                    Impound</label>
            </div>
            <div>
                <input class="" type="checkbox" id="searchBootedVehicles" wire:model="searchBootedVehicles">
                <label class="label-dark inline-block underline cursor-pointer" for="searchBootedVehicles">Booted
                    Vehicles</label>
            </div>
            <div>
                <input class="" type="checkbox" id="searchStolenVehicles" wire:model="searchStolenVehicles">
                <label class="label-dark inline-block underline cursor-pointer" for="searchStolenVehicles">Local
                    Stolen</label>
            </div>
            <div class="">
                <button class="btn btn-gray btn-md btn-rounded" wire:click="search">Search</button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2 mt-3">
        <div class="col-span-2">
            <p>{{$searchText}}</p>
        </div>
        @foreach ($results as $vehicle)
            <a class="" href="{{ route('mdt.vehicleReturn', $vehicle->plate) }}">
                <div class="bg-[#222423] rounded-lg p-4 text-white hover:bg-[#0C1011] transition-colors">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">{{ $vehicle->plate }}</h2>
                        <div>
                            @if($vehicle->status == VehicleStatus::Valid)
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-green-900 text-green-300">Valid</span>
                            @endif
                            @if($vehicle->is_expired)
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">Expired</span>
                            @endif
                            @if($vehicle->status == VehicleStatus::Stolen)
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">Stolen</span>
                            @endif
                            @if($vehicle->status == VehicleStatus::Impounded || $vehicle->status == VehicleStatus::Booted)
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">{{$vehicle->staus->name}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-0.5 mt-3">
                        <p class="text-sm">Make: {{ $vehicle->vehicle_type->name }}</p>
                        <p class="text-sm">Color: {{$vehicle->color}}</p>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

</div>
