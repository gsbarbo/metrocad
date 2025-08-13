<?php

use App\Models\Civilian;
use App\Models\Vehicle;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;

new class extends Component {
    public array $linkedVehicles = [];
    public Collection $vehicles;
    public string $vehicleSearch = '';

    public function with(): array
    {
        $this->vehicles = collect();
        if (strlen($this->vehicleSearch) > 3) {
            $this->vehicles = Vehicle::query()
                ->where('plate', 'like', '%'.$this->vehicleSearch.'%')
                ->get();
        }

        return [
            'vehicles' => $this->vehicles,
        ];
    }

    public function addVehicleToCall($vehicle_id, $vehiclePlate): void
    {
        if (!in_array($vehicle_id, array_keys($this->linkedVehicles))) {
            $this->linkedVehicles[$vehicle_id] = $vehiclePlate;
        }
        $this->vehicleSearch = '';
    }

    public function removeVehicleFromCall($vehicleId): void
    {
        unset($this->linkedCivilians[$vehicleId]);
    }

};
?>

<div>
    <div class="flex">
        <div class="w-full text-white space-y-2">
            @forelse ($linkedVehicles as $id => $plate)
                <div>
                    <input checked class="hidden" name="linked_vehicles[]" type="checkbox"
                           value="{{ $id }}">
                    <label for="">
                        {{ $plate }} |
                        <a class="text-red-600 hover:underline" href="#"
                           wire:click='removeVehicleFromCall("{{ $id }}")'>
                            Remove
                        </a>
                    </label>
                    <select class="mdt-select-input" id="" name="linked_vehicles_types[]">
                        @foreach(\App\Enum\CallCivilianTypes::options() as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            @empty
                <p></p>
            @endforelse
        </div>
    </div>
    <hr class="my-4">
    <div class="flex justify-between items-baseline">
        <div class="w-full">
            <label class="block mr-2">Search:</label>
            <input class="mdt-text-input" wire:model.live.debounce='vehicleSearch'>
        </div>
    </div>
    <div class="flex">
        <div class="w-full my-3 text-white flex flex-wrap gap-2">
            @forelse ($vehicles as $vehicle)
                <a class="flex py-2 px-4 shadow-md no-underline rounded-full bg-green-600 text-white font-sans font-semibold text-sm border-green-600 btn-primary hover:text-white hover:bg-green-500 focus:outline-none active:shadow-none mr-2"
                   href="#"
                   wire:click='addVehicleToCall("{{ $vehicle->id }}",
                    "{{ $vehicle->plate }}")'>
                    <svg class="w-4 h-4 mr-3" fill="none" stroke-width="1.5" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>

                    {{ $vehicle->plate }}
                </a>
            @empty
                <p></p>
            @endforelse
        </div>
    </div>
</div>
