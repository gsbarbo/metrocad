<?php

use Livewire\Volt\Component;
use App\Models\Civilian;
use App\Models\Report;

new class extends Component {
    public int $reportId;
    public Report $report;
    public string $search = '';
    public array $searchResults = [];
    public array $selectedCivilians = [];

    public function mount($reportId, $report): void
    {
        $this->reportId = $reportId;
        $this->report = $report;
    }

    // Live search for civilians
    public function updatedSearch(): void
    {
        $this->searchResults = Civilian::where('first_name', 'like', "%{$this->search}%")
            ->orWhere('last_name', 'like', "%{$this->search}%")
            ->without(['licenses', 'medical_records', 'vehicles', 'firearms'])
            ->limit(10)
            ->get()
            ->toArray();
    }

    // Add a civilian from search results
    public function selectCivilian($civilianId): void
    {
        $civilian = Civilian::find($civilianId);
        if (!$civilian) return;

        $this->selectedCivilians[] = [
            'id' => $civilian->id,
            'name' => $civilian->first_name.' '.$civilian->last_name,
            'type' => '',
            'arrested' => false,
            'cited' => false,
        ];

        $this->search = '';
        $this->searchResults = [];
    }

    // Remove from pending list before saving
    public function removeSelected($index): void
    {
        unset($this->selectedCivilians[$index]);
        $this->selectedCivilians = array_values($this->selectedCivilians);
    }

    // Save all selected civilians to pivot
    public function save(): void
    {
        foreach ($this->selectedCivilians as $civilian) {
            $this->report->civilians()->syncWithoutDetaching([
                $civilian['id'] => [
                    'role' => $civilian['type'],
                    'arrested' => $civilian['arrested'],
                    'cited' => $civilian['cited'],
                ]
            ]);
        }

        $this->report = $this->report->fresh('civilians'); // refresh relation
        $this->dispatch('close-modal');
        $this->selectedCivilians = [];
    }

    // Remove a civilian from the report
    public function removePivotCivilian($civilianId): void
    {
        $this->report->civilians()->detach($civilianId);
        $this->report = $this->report->fresh('civilians');
    }
};
?>

<div x-data="{ showModal: false }" x-on:close-modal.window="showModal = false">

    <!-- Persons Block -->
    <div class="bg-slate-700 rounded-lg text-white">
        <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
            <h1 class="px-5">Persons</h1>
        </div>
        <div class="px-5 py-2 space-y-2">
            <button class="btn btn-green btn-sm btn-rounded" @click="showModal = true">Add Person</button>

            <!-- Existing Civilians Table -->
            <table class="w-full mt-2">
                <tr class="border-b-2">
                    <th>Name</th>
                    <th>Type</th>
                    <th>Arrested / Cited</th>
                    <th>Action</th>
                </tr>
                @foreach($report->civilians as $civilian)
                    <tr class="border-b">
                        <td>{{ $civilian->first_name }} {{ $civilian->last_name }}</td>
                        <td>{{ $civilian->pivot->role ?? '—' }}</td>
                        <td>
                            @if($civilian->pivot->arrested)
                                Arrested
                            @endif
                            @if($civilian->pivot->cited)
                                Cited
                            @endif
                            @if(!$civilian->pivot->arrested && !$civilian->pivot->cited)
                                None
                            @endif
                        </td>
                        <td>
                            <button wire:click="removePivotCivilian({{ $civilian->id }})"
                                    class="btn btn-red btn-xs">
                                Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="fixed inset-0 bg-black/70 flex items-center justify-center z-50"
         x-show="showModal" x-transition>
        <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl p-6">
            <h2 class="text-lg font-bold mb-4">Add Civilians</h2>

            <form wire:submit.prevent="save" class="space-y-4">

                <!-- Search -->
                <div>
                    <input type="text"
                           wire:model.live.debounce.300ms="search"
                           placeholder="Search for a civilian..."
                           class="input input-bordered w-full">
                    @if(!empty($searchResults))
                        <div class="border rounded mt-2 bg-white shadow">
                            @foreach($searchResults as $result)
                                <div class="px-3 py-2 hover:bg-gray-100 cursor-pointer"
                                     wire:click="selectCivilian({{ $result['id'] }})">
                                    {{ $result['first_name'] }} {{ $result['last_name'] }}
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Selected Civilians -->
                @foreach($selectedCivilians as $index => $civilian)
                    <div class="border p-3 rounded-md space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">{{ $civilian['name'] }}</span>
                            <button type="button"
                                    class="btn btn-red btn-xs"
                                    wire:click="removeSelected({{ $index }})">
                                Remove
                            </button>
                        </div>

                        <select wire:model="selectedCivilians.{{ $index }}.type"
                                class="select select-bordered w-full">
                            <option value="">Select Type</option>
                            <option value="Witness">Witness</option>
                            <option value="Victim">Victim</option>
                            <option value="Suspect">Suspect</option>
                        </select>

                        <div class="flex items-center space-x-4">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" wire:model="selectedCivilians.{{ $index }}.arrested">
                                <span>Arrested</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" wire:model="selectedCivilians.{{ $index }}.cited">
                                <span>Cited</span>
                            </label>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" class="btn btn-gray btn-sm" @click="showModal = false">Cancel</button>
                    <button type="submit" class="btn btn-green btn-sm">Save Civilians</button>
                </div>
            </form>
        </div>
    </div>
</div>
