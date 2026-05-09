<?php

use App\Enums\Civilian\VehicleStatus;
use App\Models\Civilian;
use App\Models\Vehicle;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

new class extends Component
{
    public Civilian $civilian;

    // Create vehicle modal
    public bool $showCreateModal = false;
    public string $licensePlate = '';
    public string $make = '';
    public string $vehicleModel = '';
    public string $color = '';
    public string $year = '';

    // Actions modal (per vehicle)
    public bool $showActionsModal = false;
    public ?int $actionsVehicleId = null;

    // Theft management modal
    public bool $showTheftModal = false;
    public string $theftVehicleId = '';

    #[Computed]
    public function actionsVehicle(): ?Vehicle
    {
        return $this->actionsVehicleId
            ? $this->civilian->vehicles->find($this->actionsVehicleId)
            : null;
    }

    public function openActionsModal(int $vehicleId): void
    {
        $vehicle = $this->civilian->vehicles->find($vehicleId);
        abort_unless($vehicle, 403);

        $this->actionsVehicleId = $vehicleId;
        $this->showActionsModal = true;
    }

    public function addVehicle(): void
    {
        $this->validate([
            'licensePlate' => ['required', 'string', 'max:10', 'unique:vehicles,license_plate'],
            'make' => ['required', 'string', 'max:50'],
            'vehicleModel' => ['required', 'string', 'max:50'],
            'color' => ['required', 'string', 'max:30'],
            'year' => ['required', 'integer', 'min:1900', 'max:'.((int) date('Y') + 1)],
        ]);

        if ($this->civilian->balance < 100) {
            $this->addError('licensePlate', 'Insufficient balance. Registration fee is $100.');

            return;
        }

        DB::transaction(function () {
            $this->civilian->decrement('balance', 100);
            Vehicle::create([
                'civilian_id' => $this->civilian->id,
                'license_plate' => strtoupper($this->licensePlate),
                'make' => $this->make,
                'model' => $this->vehicleModel,
                'color' => $this->color,
                'year' => (int) $this->year,
                'is_registered' => true,
            ]);
        });

        $this->reset('licensePlate', 'make', 'vehicleModel', 'color', 'year', 'showCreateModal');
        $this->civilian->refresh();
    }

    public function payInsurance(): void
    {
        $vehicle = $this->civilian->vehicles->find($this->actionsVehicleId);
        abort_unless($vehicle, 403);

        if ($this->civilian->balance < 200) {
            $this->addError('insurance', 'Insufficient balance. Insurance costs $200.');

            return;
        }

        DB::transaction(function () use ($vehicle) {
            $this->civilian->decrement('balance', 200);
            $vehicle->update(['is_insured' => true]);
        });

        $this->civilian->refresh();
        $this->showActionsModal = false;
    }

    public function payRegistration(): void
    {
        $vehicle = $this->civilian->vehicles->find($this->actionsVehicleId);
        abort_unless($vehicle, 403);

        if ($this->civilian->balance < 100) {
            $this->addError('registration', 'Insufficient balance. Registration costs $100.');

            return;
        }

        DB::transaction(function () use ($vehicle) {
            $this->civilian->decrement('balance', 100);
            $vehicle->update(['is_registered' => true]);
        });

        $this->civilian->refresh();
        $this->showActionsModal = false;
    }

    public function updateTheftStatus(string $status): void
    {
        if (! $this->theftVehicleId) {
            return;
        }

        $vehicle = $this->civilian->vehicles->find((int) $this->theftVehicleId);
        abort_unless($vehicle, 403);

        $vehicle->update(['status' => VehicleStatus::from($status)]);
        $this->civilian->refresh();
        $this->reset('showTheftModal', 'theftVehicleId');
    }
};
?>

<div>
    <div class="flex justify-between items-center mb-3">
        <p class="text-lg text-accent">Registered Vehicles</p>
        <div class="flex gap-2">
            <button @click="$wire.showTheftModal = true"
                class="btn btn-sm btn-warning btn-pill pointer-cursor">
                <x-heroicon-o-shield-exclamation class="h-4 w-4 inline -mt-0.5" />
                Theft Management
            </button>
            <button @click="$wire.showCreateModal = true"
                class="btn btn-sm btn-green btn-pill pointer-cursor">
                <x-heroicon-o-plus class="h-4 w-4 inline -mt-0.5" />
                Add Vehicle
            </button>
        </div>
    </div>

    <table class="w-full text-sm border-collapse">
        <thead>
            <tr class="border-b border-accent/40">
                <th class="text-left py-1 pr-3 font-medium" style="color: var(--color-text-secondary);">Plate</th>
                <th class="text-left py-1 pr-3 font-medium" style="color: var(--color-text-secondary);">Vehicle</th>
                <th class="text-left py-1 pr-3 font-medium" style="color: var(--color-text-secondary);">Registration</th>
                <th class="text-left py-1 pr-3 font-medium" style="color: var(--color-text-secondary);">Insurance</th>
                <th class="text-left py-1 pr-3 font-medium" style="color: var(--color-text-secondary);">Status</th>
                <th class="py-1"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($civilian->vehicles as $vehicle)
                <tr class="border-b border-accent/20">
                    <td class="py-1.5 pr-3 font-semibold">{{ $vehicle->license_plate }}</td>
                    <td class="py-1.5 pr-3" style="color: var(--color-text-secondary);">
                        {{ $vehicle->year }} {{ $vehicle->color }} {{ $vehicle->make }} {{ $vehicle->model }}
                    </td>
                    <td class="py-1.5 pr-3">
                        @if ($vehicle->is_registered)
                            <span style="background: var(--color-background-success); color: var(--color-text-success); font-size: 11px; padding: 1px 8px; border-radius: 99px;">Valid</span>
                        @else
                            <span style="background: var(--color-background-error); color: var(--color-text-error); font-size: 11px; padding: 1px 8px; border-radius: 99px;">Expired</span>
                        @endif
                    </td>
                    <td class="py-1.5 pr-3">
                        @if ($vehicle->is_insured)
                            <span style="background: var(--color-background-success); color: var(--color-text-success); font-size: 11px; padding: 1px 8px; border-radius: 99px;">Insured</span>
                        @else
                            <span style="color: var(--color-text-secondary); font-size: 12px;">None</span>
                        @endif
                    </td>
                    <td class="py-1.5 pr-3">
                        @if ($vehicle->status->is(VehicleStatus::Active))
                            <span style="color: var(--color-text-success); font-size: 12px;">Active</span>
                        @elseif ($vehicle->status->is(VehicleStatus::Stolen))
                            <span style="color: var(--color-text-error); font-size: 12px;">Stolen</span>
                        @else
                            <span style="color: var(--color-text-warning); font-size: 12px;">Impounded</span>
                        @endif
                    </td>
                    <td class="py-1.5">
                        <button wire:click="openActionsModal({{ $vehicle->id }})"
                            style="font-size: 11px; padding: 2px 10px;"
                            class="btn btn-sm btn-pill pointer-cursor">
                            Actions
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="py-3 text-sm text-center" style="color: var(--color-text-secondary);">
                        No vehicles registered.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @teleport('body')
        {{-- Add Vehicle Modal --}}
        <div x-show="$wire.showCreateModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/60" @click="$wire.showCreateModal = false"></div>
            <div class="relative bg-navigation border-2 border-accent rounded-lg p-6 w-full max-w-md shadow-xl">
                <div class="flex justify-between items-center mb-1">
                    <p class="text-lg text-accent">Register Vehicle</p>
                    <button @click="$wire.showCreateModal = false" class="text-gray-400 hover:text-white pointer-cursor">
                        <x-heroicon-o-x-mark class="h-5 w-5" />
                    </button>
                </div>
                <p class="text-sm mb-4" style="color: var(--color-text-secondary);">
                    Registration fee: <span class="text-white font-semibold">$100</span>
                    &bull; Balance: <span class="text-white font-semibold">${{ number_format($civilian->balance) }}</span>
                </p>

                <form wire:submit="addVehicle" class="flex flex-col gap-3">
                    <x-forms.input name="licensePlate" label="License Plate" wire:model="licensePlate" required />
                    <x-forms.input name="make" label="Make" wire:model="make" required />
                    <x-forms.input name="vehicleModel" label="Model" wire:model="vehicleModel" required />
                    <x-forms.input name="color" label="Color" wire:model="color" required />
                    <x-forms.input name="year" label="Year" type="number" wire:model="year" required />

                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button" @click="$wire.showCreateModal = false"
                            class="btn btn-sm btn-pill pointer-cursor">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-sm btn-green btn-pill pointer-cursor">
                            Register ($100)
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Vehicle Actions Modal --}}
        <div x-show="$wire.showActionsModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/60" @click="$wire.showActionsModal = false"></div>
            <div class="relative bg-navigation border-2 border-accent rounded-lg p-6 w-full max-w-md shadow-xl">
                <div class="flex justify-between items-center mb-1">
                    <p class="text-lg text-accent">Vehicle Actions</p>
                    <button @click="$wire.showActionsModal = false"
                        class="text-gray-400 hover:text-white pointer-cursor">
                        <x-heroicon-o-x-mark class="h-5 w-5" />
                    </button>
                </div>
                <p class="text-sm mb-1" style="color: var(--color-text-secondary);">
                    {{ $this->actionsVehicle?->license_plate }}
                    @if ($this->actionsVehicle)
                        &bull; {{ $this->actionsVehicle->year }} {{ $this->actionsVehicle->color }}
                        {{ $this->actionsVehicle->make }} {{ $this->actionsVehicle->model }}
                    @endif
                </p>
                <p class="text-sm mb-4" style="color: var(--color-text-secondary);">
                    Balance: <span class="text-white font-semibold">${{ number_format($civilian->balance) }}</span>
                </p>

                <div class="flex flex-col gap-3">
                    <div class="flex items-center justify-between p-3 rounded-lg border border-accent/30">
                        <div>
                            <p class="font-medium text-sm">Insurance</p>
                            <p class="text-xs" style="color: var(--color-text-secondary);">$200 flat fee</p>
                        </div>
                        @if ($this->actionsVehicle?->is_insured)
                            <span style="background: var(--color-background-success); color: var(--color-text-success); font-size: 11px; padding: 2px 10px; border-radius: 99px;">
                                Insured ✓
                            </span>
                        @else
                            <button wire:click="payInsurance"
                                class="btn btn-sm btn-green btn-pill pointer-cursor">
                                Pay $200
                            </button>
                        @endif
                    </div>
                    @error('insurance')
                        <p class="text-xs text-red-400 -mt-2">{{ $message }}</p>
                    @enderror

                    <div class="flex items-center justify-between p-3 rounded-lg border border-accent/30">
                        <div>
                            <p class="font-medium text-sm">Registration</p>
                            <p class="text-xs" style="color: var(--color-text-secondary);">$100 flat fee</p>
                        </div>
                        @if ($this->actionsVehicle?->is_registered)
                            <span style="background: var(--color-background-success); color: var(--color-text-success); font-size: 11px; padding: 2px 10px; border-radius: 99px;">
                                Registered ✓
                            </span>
                        @else
                            <button wire:click="payRegistration"
                                class="btn btn-sm btn-blue btn-pill pointer-cursor">
                                Pay $100
                            </button>
                        @endif
                    </div>
                    @error('registration')
                        <p class="text-xs text-red-400 -mt-2">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Theft Management Modal --}}
        <div x-show="$wire.showTheftModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/60" @click="$wire.showTheftModal = false"></div>
            <div class="relative bg-navigation border-2 border-accent rounded-lg p-6 w-full max-w-md shadow-xl">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg text-accent">Theft Management</p>
                    <button @click="$wire.showTheftModal = false"
                        class="text-gray-400 hover:text-white pointer-cursor">
                        <x-heroicon-o-x-mark class="h-5 w-5" />
                    </button>
                </div>

                <x-forms.select name="theftVehicleId" label="Select Vehicle" wire:model="theftVehicleId">
                    <option value="">Select a vehicle...</option>
                    @foreach ($civilian->vehicles as $vehicle)
                        <option value="{{ $vehicle->id }}">
                            {{ $vehicle->license_plate }} &ndash;
                            {{ $vehicle->year }} {{ $vehicle->make }} {{ $vehicle->model }}
                        </option>
                    @endforeach
                </x-forms.select>

                <div class="flex gap-3 mt-4">
                    <button wire:click="updateTheftStatus('stolen')"
                        @disabled(! $theftVehicleId)
                        class="btn btn-sm btn-red btn-pill pointer-cursor flex-1 disabled:opacity-40">
                        Mark as Stolen
                    </button>
                    <button wire:click="updateTheftStatus('active')"
                        @disabled(! $theftVehicleId)
                        class="btn btn-sm btn-green btn-pill pointer-cursor flex-1 disabled:opacity-40">
                        Mark as Recovered
                    </button>
                </div>
            </div>
        </div>
    @endteleport
</div>
