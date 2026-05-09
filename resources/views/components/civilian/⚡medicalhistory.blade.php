<?php

use App\Enums\Civilian\MedicalNoteType;
use App\Models\Civilian;
use App\Models\MedicalNote;
use Livewire\Component;

new class extends Component
{
    public Civilian $civilian;

    public bool $showModal = false;

    public string $type = '';

    public string $details = '';

    public function save(): void
    {
        $this->validate([
            'type' => ['required', 'in:'.implode(',', array_column(MedicalNoteType::cases(), 'value'))],
            'details' => ['required', 'string', 'max:255'],
        ]);

        MedicalNote::create([
            'civilian_id' => $this->civilian->id,
            'type' => $this->type,
            'details' => $this->details,
        ]);

        $this->reset('type', 'details', 'showModal');
        $this->civilian->refresh();
    }

    public function delete(MedicalNote $note): void
    {
        abort_unless($note->civilian_id === $this->civilian->id, 403);

        $note->delete();
        $this->civilian->refresh();
    }
};
?>

<div>
    <div class="flex justify-between items-center">
        <p class="text-lg text-accent mb-2">Medical Note</p>
        <button @click="$wire.showModal = true" class="btn btn-green btn-sm btn-rounded pointer-cursor">
            <x-heroicon-o-plus class="h-4 w-4" /> Medical Note
        </button>
    </div>

    <div class="grid grid-cols-[1fr_2fr_auto] text-sm">
        <div class="border-b-2 text-base">Type</div>
        <div class="border-b-2 text-base">Details</div>
        <div class="border-b-2"></div>

        @forelse ($civilian->medicalNotes as $note)
            <div class="py-0.5">{{ $note->type->label() }}</div>
            <div class="py-0.5">{{ $note->details }}</div>
            <div class="py-0.5 flex items-center">
                <button wire:click="delete({{ $note->id }})" wire:confirm="Delete this medical note?"
                    class="text-red-400 hover:text-red-400 transition-colors cursor-pointer">
                    <x-heroicon-o-trash class="h-4 w-4" />
                </button>
            </div>
        @empty
            <div class="col-span-3 text-sm text-gray-400 mt-1">No medical notes recorded.</div>
        @endforelse
    </div>

    @teleport('body')
        <div x-show="$wire.showModal" class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/60" @click="$wire.showModal = false"></div>

            <div class="relative bg-navigation border-2 border-accent rounded-lg p-6 w-full max-w-md shadow-xl">
                <div class="flex justify-between items-center mb-4">
                    <p class="text-lg text-accent">Add Medical Note</p>
                    <button @click="$wire.showModal = false" class="text-gray-400 hover:text-white pointer-cursor">
                        <x-heroicon-o-x-mark class="h-5 w-5" />
                    </button>
                </div>

                <form wire:submit="save" class="flex flex-col gap-4">
                    <x-forms.select name="type" wire:model="type" required>
                        <option value="">Select type...</option>
                        @foreach (MedicalNoteType::cases() as $case)
                            <option value="{{ $case->value }}">{{ $case->label() }}</option>
                        @endforeach
                    </x-forms.select>

                    <x-forms.textarea name="details" wire:model="details" :rows="3" required />

                    <div class="flex justify-end gap-2 mt-2">
                        <button type="button" @click="$wire.showModal = false"
                            class="btn btn-sm btn-pill pointer-cursor">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-sm btn-green btn-pill pointer-cursor">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endteleport
</div>
