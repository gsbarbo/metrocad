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

        @foreach(\App\Enum\ActiveUnitStatus::options() as $status => $name)
            <button wire:click="setStatus({{ $activeUnit }}, '{{ $name }}')"
                    class="btn btn-lg btn-rounded
                    @if($activeUnit->status == $name) border-white border-4 @endif
                    @if($name == \App\Enum\ActiveUnitStatus::OffDuty->value) btn-red @else btn-blue @endif
                    ">
                {{ $name }}
            </button>
        @endforeach

    </div>
</div>
