<?php

use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {

    #[\Livewire\Attributes\Url]
    public string $nameSearch = '';

    #[\Livewire\Attributes\Url]
    public string $ssnSearch = '';

    public Collection $civilians;

    public function with(): array
    {
        $results = [];
        if (strlen($this->nameSearch) > 3) {
            $results = \App\Models\Civilian::query()
                ->where('first_name', 'like', '%'.$this->nameSearch.'%')
                ->orWhere('last_name', 'like', '%'.$this->nameSearch.'%')
                ->without(['medical_records'])
                ->get();
        } elseif (!empty($this->ssnSearch)) {
            $results = \App\Models\Civilian::where('id', 'like', '%'.$this->ssnSearch.'%')->get();
        }

        return ['results' => $results];
    }
}
?>

<div>
    <h1 class="text-2xl font-bold text-white">Civilian Search</h1>
    <div class="grid grid-cols-2 gap-4 items-center">
        <div class="">
            <label class="label-dark">Name:</label>
            <input class="form-select-input-dark" type="text" wire:model.live.debounce.800ms='nameSearch'>
        </div>
        <div class="">
            <label class="label-dark">Social Security:</label>
            <input class="form-select-input-dark" type="number" wire:model.debounce.800ms='ssnSearch'>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2 mt-3">
        @forelse ($results as $civilian)
            <a class="" href="{{route('mdt.civilianReturn', $civilian->id)}}">
                <div class="bg-[#222423] rounded-lg p-4 text-white hover:bg-[#0C1011] transition-colors">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">{{ $civilian->last_name }}, {{ $civilian->first_name }}</h2>
                        <div>
                            <span
                                class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">WANTED</span>
                            <span class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-yellow-900 text-yellow-300">FLAGS</span>
                            <span
                                class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-green-900 text-green-300">CLEAR</span>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-0.5 mt-3">
                        <p class="text-sm">SSN: {{ $civilian->s_n_n }}</p>
                        <p class="text-sm">DOB: {{ $civilian->date_of_birth->format(get_setting('date_format')) }}
                            ({{$civilian->age}})</p>

                        @php
                            $active = 0;
                            $expired = 0;
                            $suspended = 0;
                        @endphp
                        @forelse ($civilian->licenses as $license)
                            @php
                                if ($license->expires_at < date('Y-m-d')) {
                                    $expired++;
                                } elseif ($license->status == \App\Enum\LicenseStatus::Suspended || $license->status == \App\Enum\LicenseStatus::Revoked) {
                                    $suspended++;
                                } else {
                                    $active++;
                                }
                            @endphp
                        @empty
                            @php
                                $active = 0;
                                $expired = 0;
                                $suspended = 0;
                            @endphp
                        @endforelse

                        <p class="text-sm">Licenses: {{$active}}CUR {{$suspended}}SUS {{$expired}}EXP</p>

                        @php
                            $active = 0;
                            $expired = 0;
                            $impounded = 0;
                            $stolen = 0;
                        @endphp
                        @forelse ($civilian->vehicles as $vehicle)
                            @php
                                if ($vehicle->is_expired) {
                                    $expired++;
                                } elseif ($vehicle->status == \App\Enum\VehicleStatus::Booted || $vehicle->status == \App\Enum\VehicleStatus::Impounded) {
                                    $impounded++;
                                } elseif ($vehicle->status == \App\Enum\VehicleStatus::Stolen) {
                                    $stolen++;
                                } else {
                                    $active++;
                                }
                            @endphp
                        @empty
                            @php
                                $active = 0;
                                $expired = 0;
                                $impounded = 0;
                                $stolen = 0;
                            @endphp
                        @endforelse
                        <p class="text-sm">Vehicles: {{$active}}CUR {{$stolen}}STO {{$impounded}}IMP {{$expired}}EXP</p>

                        @php
                            $active = 0;
                            $stolen = 0;
                            $impounded = 0;
                        @endphp
                        @forelse ($civilian->firearms as $firearm)
                            @php
                                if ($firearm->status == \App\Enum\FirearmStatus::Impounded) {
                                    $impounded++;
                                } elseif ($firearm->status == \App\Enum\FirearmStatus::Stolen) {
                                    $stolen++;
                                } else {
                                    $active++;
                                }
                            @endphp
                        @empty
                            @php
                                $active = 0;
                                $impounded = 0;
                                $stolen = 0;
                            @endphp
                        @endforelse
                        <p class="text-sm">Firearms: {{$active}}CUR {{$stolen}}STO</p>

                        <p class="text-sm">Involvements: XXXXWAR XXXXTIC XXXXARR</p>
                    </div>
                </div>
            </a>
        @empty
            <p class="text-white">No search ran</p>
        @endforelse
    </div>

</div>
