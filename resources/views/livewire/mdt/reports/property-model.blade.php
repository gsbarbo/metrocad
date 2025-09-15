<?php

use Livewire\Volt\Component;
use App\Models\Report;

new class extends Component {
    public int $reportId;
    public Report $report;
    public string $propertyInput = '';
    public array $selectedProperties = [];

    public function mount($reportId, $report): void
    {
        $this->reportId = $reportId;
        $this->report = $report;
    }

    // Add property to pending list
    public function addProperty(): void
    {
        $property = trim($this->propertyInput);
        if ($property === '') return;

        $this->selectedProperties[] = [
            'name' => $property,
            'status' => '',   // Lost, Stolen, Impounded, Collected as Evidence
            'reason' => '',   // Reason for police custody
        ];

        $this->propertyInput = '';
    }

    // Remove from pending list
    public function removeSelected($index): void
    {
        unset($this->selectedProperties[$index]);
        $this->selectedProperties = array_values($this->selectedProperties);
    }

    // Save all properties to database
    public function save(): void
    {
        foreach ($this->selectedProperties as $property) {
            $this->report->properties()->create([
                'name' => $property['name'],
                'status' => $property['status'] ?? null,
                'reason' => $property['reason'] ?? null,
            ]);
        }

        $this->report = $this->report->fresh('properties');
        $this->dispatch('close-modal');
        $this->selectedProperties = [];
    }

    // Remove property from report
    public function removeProperty($propertyId): void
    {
        $this->report->properties()->where('id', $propertyId)->delete();
        $this->report = $this->report->fresh('properties');
    }
};
?>

<div x-data="{ showModal: false }" x-on:close-modal.window="showModal = false">

    <!-- Property Block -->
    <div class="bg-slate-700 rounded-lg text-white">
        <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
            <h1 class="px-5">Property</h1>
        </div>
        <div class="px-5 py-2 space-y-2">
            @if (!in_array($report->status, [\App\Enum\ReportStatus::PENDING, \App\Enum\ReportStatus::COMPLETED]) && auth()->user()->active_unit->officer->id == $report->officer_id && request()->is('mdt/reports/*/edit'))
                <button class="btn btn-green btn-sm btn-rounded" @click="showModal = true">Add Property</button>
            @endif
            <!-- Existing Properties Table -->
            <table class="w-full mt-2">
                <tr class="border-b-2">
                    <th>Property</th>
                    <th>Status</th>
                    <th>Reason for Police Custody</th>
                    <th>Action</th>
                </tr>
                @foreach($report->properties as $property)
                    <tr class="border-b">
                        <td>{{ $property->name }}</td>
                        <td>{{ $property->status ?? '—' }}</td>
                        <td>{{ $property->reason ?? '—' }}</td>
                        <td>
                            @if (!in_array($report->status, [\App\Enum\ReportStatus::PENDING, \App\Enum\ReportStatus::COMPLETED]) && auth()->user()->active_unit->officer->id == $report->officer_id && request()->is('mdt/reports/*/edit'))
                                <button wire:click="removeProperty({{ $property->id }})"
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
            <h2 class="text-lg font-bold mb-4">Add Property</h2>

            <form wire:submit.prevent="save" class="space-y-4">

                <!-- Input -->
                <div class="flex space-x-2">
                    <x-forms.input name="" label="Search" mdt class="w-full"
                                   wire:model.debounce.300ms="propertyInput"/>
                    <button type="button" class="btn btn-green btn-sm btn-rounded" wire:click="addProperty">
                        Add
                    </button>
                </div>

                <!-- Pending Properties -->
                @foreach($selectedProperties as $index => $property)
                    <div class="border p-3 rounded-md space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="font-semibold">{{ $property['name'] }}</span>
                            <button type="button"
                                    class="btn btn-red btn-sm btn-rounded"
                                    wire:click="removeSelected({{ $index }})">
                                Remove
                            </button>
                        </div>

                        <div class="space-y-2">
                            <x-forms.select label="Status" mdt required name=""
                                            wire:model="selectedProperties.{{ $index }}.status">
                                <option value="">Select Status</option>
                                <option value="Lost">Lost</option>
                                <option value="Stolen">Stolen</option>
                                <option value="Impounded">Impounded</option>
                                <option value="Collected as Evidence">Collected as Evidence</option>
                            </x-forms.select>

                            <x-forms.textarea name="" label="Reason for police custody" mdt
                                              wire:model="selectedProperties.{{ $index }}.reason"/>
                        </div>
                    </div>
                @endforeach

                <div class="flex justify-end mt-4 space-x-2">
                    <button type="button" class="btn btn-gray btn-sm btn-rounded" @click="showModal = false">Cancel
                    </button>
                    <button type="submit" class="btn btn-green btn-sm btn-rounded">Save Properties</button>
                </div>
            </form>
        </div>
    </div>
</div>
