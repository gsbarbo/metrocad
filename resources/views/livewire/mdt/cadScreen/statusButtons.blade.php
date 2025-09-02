<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {
    public \App\Models\ActiveUnit $activeUnit;

    #[On('updated-page')]
    public function refreshComponentOnEvent(): void
    {
        $this->js('$refresh');
    }

    public function mount(): void
    {
        $this->activeUnit = auth()->user()->active_unit;
    }


    public function setStatus(\App\Models\ActiveUnit $activeUnit, $status): void
    {
        $activeUnit->update(['status' => $status, 'description' => 'Status Set To: '.$status]);
        $this->dispatch('updated-page');
    }
}

?>

<div>
    <h1 class="text-2xl font-bold text-white">Set Status</h1>
    <div class="grid grid-cols-3 md:grid-cols-5 gap-4 items-center">
        @foreach(\App\Enum\ActiveUnitStatus::cases() as $unitStatus)
            <button wire:click="setStatus({{ $activeUnit }}, '{{ $unitStatus->value }}')"
                    class="btn btn-lg btn-rounded
                    @if($activeUnit->status->value == $unitStatus->value) border-white border-4 @endif
                    @if($unitStatus->value == \App\Enum\ActiveUnitStatus::OffDuty->value) btn-red @else {{$unitStatus->bgColor('background')}} @endif
                    ">
                {{ $unitStatus->label() }}
            </button>
        @endforeach
    </div>
</div>
