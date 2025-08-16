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
            <th class="border border-slate-400">Agency</th>
            <th class="border border-slate-400">Unit #</th>
            <th class="border border-slate-400">Status</th>
            <th class="border border-slate-400">Time</th>
            <th class="border border-slate-400">Call #</th>
            <th class="border border-slate-400">Description</th>
        </tr>
        @foreach ($activeUnits as $activeUnit)
            @if ($activeUnit['department_type_id'] != 2)
                <tr class="{{$activeUnit['status']['color-text']}}">
                    <td class="p-1 border border-slate-400">
                        {{$activeUnit['user_department']['department']['initials']}}
                    </td>
                    <td class="p-1 border border-slate-400">
                        {{$activeUnit['officer']['badge_number']}}
                        ({{$activeUnit['officer']['name']}})
                    </td>
                    <td class="relative p-1 border border-slate-400" x-data="{ statusOpen: false }">
                        <div class="flex justify-between">
                            <span>{{$activeUnit['status']['code']}}</span>
                            <a @click="statusOpen = !statusOpen" class="underline cursor-pointer">
                                <svg class="w-6 h-6 text-white" stroke-width="1.5" stroke="currentColor"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </div>
                        <div @click.outside="statusOpen = false"
                             class="absolute right-0 w-32 z-50 p-3 space-y-3 text-white bg-gray-800 rounded block"
                             x-show="statusOpen">
                            @foreach(ActiveUnitStatus::options() as $id => $status)
                                <a @click="statusOpen = false" class="block hover:bg-gray-500" href="#"
                                   wire:click="setStatus({{ $activeUnit['id'] }}, '{{ $id }}')">{{ $id }}</a>
                            @endforeach
                        </div>
                    </td>
                    <td class="p-1 border border-slate-400">
                        {{ $activeUnit['time'] }}m
                    </td>
                    <td class="relative p-1 border border-slate-400" x-data="{ callsOpen: false }">
                        <div class="flex justify-between">
                            <div class="">
                                {{--                            @if ($active_unit->calls->count() > 0)--}}
                                {{--                                <span class="text-white
                                {{--                            @foreach ($active_unit->calls as $call)--}}
                                {{--                                <a class="hover:underline" href="{{ route('cad.call.show', $call->id) }}">--}}
                                {{--                                    {{ $call->id }}--}}
                                {{--                                    @if (!$loop->last)--}}
                                {{--                                        ,--}}
                                {{--                                    @endif--}}
                                {{--                                </a>--}}
                                {{--                            @endforeach--}}
                            </div>
                            {{-- @if ($active_unit->user_department->department->type != 2) --}}
                            <a @click="callsOpen = !callsOpen" class="underline cursor-pointer">
                                <svg class="w-6 h-6 text-white" stroke-width="1.5" stroke="currentColor"
                                     viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 6.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 12.75a.75.75 0 110-1.5.75.75 0 010 1.5zM12 18.75a.75.75 0 110-1.5.75.75 0 010 1.5z"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                            {{-- @endif --}}
                        </div>
                        <div @click.outside="callsOpen = false"
                             class="absolute right-0 w-32 p-3 z-50 space-y-3 text-white bg-gray-800 rounded"
                             x-show="callsOpen">
                            {{--                        @foreach ($calls as $call)--}}
                            {{--                            @if ($call->attached_units->contains('id', $active_unit->id))--}}
                            {{--                                <a @click="callsOpen = false" class="block bg-gray-500" href="#"--}}
                            {{--                                   wire:click="remove_unit_from_call({{ $active_unit->id }}, {{ $call->id }})">Remove--}}
                            {{--                                    From Call {{ $call->id }}</a>--}}
                            {{--                            @else--}}
                            {{--                                <a @click="callsOpen = false" class="block hover:bg-gray-500" href="#"--}}
                            {{--                                   wire:click="add_unit_to_call({{ $active_unit->id }}, {{ $call->id }})">Add--}}
                            {{--                                    To Call {{ $call->id }}</a>--}}
                            {{--                            @endif--}}
                            {{--                        @endforeach--}}
                        </div>

                    </td>
                    <td class="p-1 border border-slate-400">
                        {{$activeUnit['description']}}
                    </td>
                </tr>
            @endif
        @endforeach
    </table>
</div>
