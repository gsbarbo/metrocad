<?php

use Livewire\Volt\Component;
use App\Models\Vehicle;
use App\Models\Report;

new class extends Component {
    public int $reportId;
    public Report $report;
    public string $search = '';
    public array $searchResults = [];
    public array $selectedVehicles = [];

    public function mount($reportId, $report): void
    {
        $this->reportId = $reportId;
        $this->report = $report;
    }

    // Live search for vehicles by plate
    public function updatedSearch(): void
    {
        $this->searchResults = Vehicle::where('plate', 'like', "%{$this->search}%")
            ->limit(10)
            ->get()
            ->toArray();
    }

    // Add vehicle from search results
    public function selectVehicle($vehicleId): void
    {
        $vehicle = Vehicle::find($vehicleId);
        if (!$vehicle) return;

        $this->selectedVehicles[] = [
            'id' => $vehicle->id,
            'plate' => $vehicle->plate,
            'type' => '', // Owned, Stolen, Impounded
        ];

        $this->search = '';
        $this->searchResults = [];
    }

    // Remove from pending list before saving
    public function removeSelected($index): void
    {
        unset($this->selectedVehicles[$index]);
        $this->selectedVehicles = array_values($this->selectedVehicles);
    }

    // Save all selected vehicles to pivot
    public function save(): void
    {
        foreach ($this->selectedVehicles as $vehicle) {
            $this->report->vehicles()->syncWithoutDetaching([
                $vehicle['id'] => [
                    'type' => $vehicle['type'],
                ]
            ]);
        }

        $this->report = $this->report->fresh('vehicles'); // refresh relation
        $this->dispatch('close-modal');
        $this->selectedVehicles = [];
    }

    // Remove a vehicle from the report
    public function removePivotVehicle($vehicleId): void
    {
        $this->report->vehicles()->detach($vehicleId);
        $this->report = $this->report->fresh('vehicles');
    }
};
?>

<div x-data="{ showModal: false }" x-on:close-modal.window="showModal = false">

    <!-- Vehicles / Plates Block -->
    <div class="bg-slate-700 rounded-lg text-white">
        <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
            <h1 class="px-5">Vehicles / Plates</h1>
        </div>
        <div class="px-5 py-2 space-y-2">
            @if (!in_array($report->status, [\App\Enum\ReportStatus::PENDING, \App\Enum\ReportStatus::COMPLETED]) && auth()->user()->active_unit->officer->id == $report->officer_id && request()->is('mdt/reports/*/edit'))
                <button class="btn btn-green btn-sm btn-rounded" @click="showModal = true">Add Vehicle</button>
            @endif
            <!-- Existing Vehicles Table -->
            <table class="w-full mt-2">
                <tr class="border-b-2">
                    <th>Plate</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
                @foreach($report->vehicles as $vehicle)
                    <tr class="border-b">
                        <td>{{ $vehicle->plate }}</td>
                        <td>{{ $vehicle->pivot->type ?? '—' }}</td>
                        <td>
                            @if (!in_array($report->status, [\App\Enum\ReportStatus::PENDING, \App\Enum\ReportStatus::COMPLETED]) && auth()->user()->active_unit->officer->id == $report->officer_id && request()->is('mdt/reports/*/edit'))
                                <button wire:click="removePivotVehicle({{ $vehicle->id }})"
                                        class="btn btn-red btn-sm btn-rounded">
                                    Remove
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center z-50"
         x-show="showModal" x-transition>
        <div class="bg-gray-700 rounded-lg shadow-xl w-full max-w-3xl p-6 text-white">
            <h2 class="text-lg font-bold mb-4">Add Vehicles / Plates</h2>

            <form wire:submit.prevent="save" class="space-y-4">

                <!-- Search -->
                <div>
                    <x-forms.input name="" label="Search Plate" mdt
                                   wire:model.live.debounce.300ms="search"/>
                    @if(!empty($searchResults))
                        <div class="border rounded mt-2 bg-gray-500 shadow">
                            @foreach($searchResults as $result)
                                <div class="px-3 py-2 hover:bg-gray-400 cursor-pointer"
                                     wire:click="selectVehicle({{ $result['id'] }})">
                                    {{ $result['plate'] }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Selected Vehicles -->
                @foreach($selectedVehicles as $index => $vehicle)
                    <div class="border p-3 rounded-md space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">{{ $vehicle['plate'] }}</span>
                            <button type="button"
                                    class="btn btn-red btn-sm btn-rounded"
                                    wire:click="removeSelected({{ $index }})">
                                Remove
                            </button>
                        </div>

                        <x-forms.select label="Vehicle Type" mdt required name=""
                                        wire:model="selectedVehicles.{{ $index }}.type">
                            <option value="">Select Type</option>
                            <option value="Owned">Owned</option>
                            <option value="Stolen">Stolen</option>
                            <option value="Impounded">Impounded</option>
                        </x-forms.select>
                    </div>
                @endforeach

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" class="btn btn-gray btn-sm btn-rounded" @click="showModal = false">Cancel
                    </button>
                    <button type="submit" class="btn btn-green btn-sm btn-rounded">Save Vehicles</button>
                </div>
            </form>
        </div>
    </div>
</div>
