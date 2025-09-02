<?php

use App\Enum\ActiveUnitStatus;
use App\Http\Resources\Mdt\ActiveUnitResource;
use App\Models\ActiveUnit;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {
    public array $activeUnits;

    #[On('updated-page')]
    public function refreshComponentOnEvent(): void
    {
        $this->js('$refresh');
    }

    public function with(): array
    {
        $activeUnits = ActiveUnit::query()->with(['officer', 'user_department', 'user'])->get();

        $this->activeUnits = ActiveUnitResource::collection($activeUnits)->toArray(request());

        return [
            'activeUnits' => $this->activeUnits,
        ];
    }

    public function setStatus($activeUnitId, $status): void
    {
        $activeUnit = ActiveUnit::query()->findOrFail($activeUnitId);
        $activeUnit->update(['status' => $status, 'description' => 'Status Set To: '.$status]);
        $this->dispatch('updated-page');
    }
}

?>


<div wire:poll.5s>
    <h1 class="text-2xl font-bold text-white">Active Units</h1>
    <table class="w-full border border-collapse table-auto border-slate-400">
        <tr class="text-white">
            <th class="border border-slate-400 w-32">Unit Number</th>
            <th class="border border-slate-400">Name</th>
            <th class="border border-slate-400">Location</th>
            <th class="border border-slate-400 w-32">Department</th>
            <th class="border border-slate-400 w-12">Time</th>
            <th class="border border-slate-400">Status</th>
            <th class="border border-slate-400">Call</th>
            <th class="border border-slate-400">Description</th>
        </tr>
        @foreach ($activeUnits as $activeUnit)
            @if ($activeUnit['department_type_id'] != 2)
                <tr class="">
                    <td class="p-1 border border-slate-400"
                        x-data="{
                            statusOpen: false,
                            menuX: 0,
                            menuY: 0,
                            openMenu(event) {
                                const menuWidth = 300; // approximate width of menu
                                const menuHeight = {{ count(ActiveUnitStatus::toArray()) * 34 }}; // height per item * number of items
                                const viewportWidth = window.innerWidth;
                                const viewportHeight = window.innerHeight;

                                // Clamp X/Y so menu stays inside viewport
                                this.menuX = Math.min(event.pageX, viewportWidth - menuWidth - 10);
                                this.menuY = Math.min(event.pageY, viewportHeight - menuHeight - 10);
                                this.statusOpen = true;
                            },
                            closeMenu() {
                                this.statusOpen = false;
                            }
                        }"
                        @contextmenu.prevent="openMenu($event)">
                        <p class="btn btn-rounded btn-sm block text-center {{$activeUnit['status']['bg-color']}} cursor-alias">
                            {{$activeUnit['officer']['badge_number']}}
                        </p>
                        <div x-show="statusOpen"
                             @click.outside="closeMenu()"
                             style="display: none;"
                             class="z-50 p-2 bg-black text-white rounded shadow-lg w-80"
                             :style="`position: fixed; top: ${menuY}px; left: ${menuX}px; min-width: 150px;`">

                            @foreach(ActiveUnitStatus::toArray() as $id => $name)
                                <a href="#"
                                   class="block px-3 py-1 hover:bg-slate-900 rounded"
                                   @click="closeMenu()"
                                   wire:click="setStatus({{ $activeUnit['id'] }}, '{{ $id }}')">
                                    {{ $name }}
                                </a>
                            @endforeach
                        </div>
                    </td>
                    <td class="p-1 border border-slate-400">{{$activeUnit['officer']['formatted_name']}}</td>
                    <td class="p-1 border border-slate-400">{{$activeUnit['location']}}</td>
                    <td class="p-1 border border-slate-400">{{$activeUnit['user_department']['department']['initials']}}</td>
                    <td class="p-1 border border-slate-400">{{$activeUnit['time']}}m</td>
                    <td class="p-1 border border-slate-400 {{$activeUnit['status']['text-color']}}">{{$activeUnit['status']['label']}}</td>
                    <td class="p-1 border border-slate-400">Attached Call Numbers</td>
                    <td class="p-1 border border-slate-400">{{$activeUnit['description']}}</td>
                </tr>
            @endif
        @endforeach
    </table>
</div>
