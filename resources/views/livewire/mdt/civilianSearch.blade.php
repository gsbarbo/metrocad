<?php

use App\Enum\CivilianStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;
use Livewire\Attributes\On;


new class extends Component {

    public string $firstName = '';
    public string $lastName = '';

    #[\Livewire\Attributes\Url]
    public string $ssn = '';

    public string $dateOfBirth = '';
    public string $gender = '';
    public string $race = '';
    public string $driversLicense = '';

    public Collection $results;
    public bool $error = false;
    public string $searchText = 'No Search Ran';

    public bool $searchLocalDeceased = false;
    public bool $searchWantedPersons = true;
    public bool $searchLocalInmates = true;


    public function mount(): void
    {
        $this->results = collect();

        if ($this->hasValidSearch()) {
            $this->search();
        }
    }

    private function hasValidSearch(): bool
    {
        return (
            (strlen($this->firstName) > 2 && strlen($this->lastName) > 2) ||
            $this->ssn ||
            ($this->dateOfBirth && $this->gender && $this->race)
        );
    }

    public function search(): void
    {
        $this->error = false;

        if (!$this->hasValidSearch()) {
            $this->error = true;
            $this->results = collect();
            $this->searchText = 'No valid search provided.';
            return;
        }
        $query = \App\Models\Civilian::query();

        // Apply filters
        $query->where(function (Builder $q) {
            if ($this->firstName && $this->lastName) {
                $this->applyNameSearch($q);
            }

            if ($this->ssn) {
                $this->applySSNSearch($q);
            }

            if ($this->dateOfBirth && $this->gender && $this->race) {
                $this->applyDemographicSearch($q);
            }
        });

        $query->where(function (Builder $q) {
            if ($this->searchLocalDeceased) {
                $q->orWhere('status', CivilianStatus::Dead->value);
            }
            if ($this->searchWantedPersons) {
                $q->orWhere('status', CivilianStatus::Wanted->value);
            }
            if ($this->searchLocalInmates) {
                $q->orWhere('status', CivilianStatus::Jailed->value);
            }

            $q->orWhere('status', CivilianStatus::Alive->value);

        });

        if ($this->searchLocalDeceased) {
            $query->onlyTrashed();
        }

        $results = $query->get();

        $this->handleSingleResult($results);

        $this->results = $results;
        $this->searchText = "Your search returned: {$results->count()} civilians.";
    }

    private function applyNameSearch(Builder $query): void
    {
        $query->orWhere(function (Builder $q) {
            $q->where('first_name', 'like', '%'.$this->firstName.'%')
                ->where('last_name', 'like', '%'.$this->lastName.'%');
        });
    }

    private function applySSNSearch(Builder $query): void
    {
        $query->orWhere('id', 'like', '%'.$this->ssn.'%');
    }

    private function applyDemographicSearch(Builder $query): void
    {
        $query->orWhere(function (Builder $q) {
            $q->whereDate('date_of_birth', $this->dateOfBirth)
                ->where('gender', $this->gender)
                ->where('race', $this->race);
        });
    }

    private function handleSingleResult(Collection $results): void
    {
        if ($results->count() === 1) {
            redirect()->route('mdt.civilianReturn', $results->first()->id);
        }
    }

}
?>

<div>
    <h2 class="text-2xl flex items-center">
        <svg class="w-10 h-10" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
             xmlns="http://www.w3.org/2000/svg">
            <path
                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <span class="ml-3">Name Search</span>
    </h2>
    <div class="grid grid-cols-12 gap-4 mt-4">
        <div class="p-2 col-span-10">
            <div class="grid grid-cols-6 gap-4 border-2 p-2">
                <div class="col-span-4">
                    <label class="label-dark font-bold text-lg">Requesting Unit:</label>
                    <input class="mdt-select-input" type="text"
                           value="{{auth()->user()->active_unit->civilian->name}}"
                           disabled>
                </div>
                <div class="col-span-2"></div>
                @if($error)
                    <div class="col-span-6">
                        <div
                            class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
                            role="alert">
                            <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Error:</span> You must search by one of the following methods
                                <div class="ml-3 grid grid-cols-4 gap-x-6 text-white">
                                    <p>First Name & Last Name</p>
                                    <p>Social Security Number</p>
                                    <p>Birth Day & Gender & Race</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-span-2">
                    <label class="label-dark font-bold text-lg">First:</label>
                    <input class="mdt-text-input" placeholder="First Name" autofocus type="text"
                           wire:model='firstName'>
                </div>
                <div class="col-span-2">
                    <label class="label-dark font-bold text-lg">Last:</label>
                    <input class="mdt-text-input" placeholder="Last Name" type="text" wire:model='lastName'>
                </div>
                <div class="col-span-2">
                    <label class="label-dark font-bold text-lg">Social Security:</label>
                    <input class="mdt-text-input" placeholder="Social Security Number" type="number" wire:model='ssn'>
                </div>
                <div class="col-span-2">
                    <label class="label-dark font-bold text-lg">Birth Date:</label>
                    <input class="mdt-text-input" type="date" wire:model='dateOfBirth'>
                </div>
                <div class="col-span-1">
                    <label class="label-dark font-bold text-lg">Gender:</label>
                    <select name="" id="" class="mdt-select-input" wire:model='gender'>
                        <option value=""></option>
                        @foreach(\App\Support\Civilian\GenderOptions::getList() as $id => $name)
                            <option value="{{ $id }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-2">
                    <label class="label-dark font-bold text-lg">Race:</label>
                    <select name="" id="" class="mdt-select-input" wire:model='race'>
                        <option value=""></option>
                        @foreach(\App\Support\Civilian\RaceOptions::getList() as $id => $name)
                            <option value="{{ $id }}">
                                {{ $name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                {{--                <div class="col-span-4">--}}
                {{--                    <label class="label-dark font-bold text-lg">Driver License:</label>--}}
                {{--                    <input class="mdt-select-input" type="text" wire:model='driversLicense'>--}}
                {{--                </div>--}}
                {{--                <div class="col-span-2">--}}
                {{--                    <label class="label-dark font-bold text-lg">Driver License State:</label>--}}
                {{--                    <input class="mdt-select-input uppercase" type="text" value="{{get_setting('state')}}"--}}
                {{--                           disabled>--}}
                {{--                </div>--}}
            </div>
        </div>
        <div class="p-2 col-span-2">
            <div>
                <input class="" type="checkbox" id="localInmates" wire:model="searchLocalInmates">
                <label class="label-dark inline-block underline cursor-pointer" for="localInmates">Local Inmates</label>
            </div>
            <div>
                <input class="" type="checkbox" id="wantedPersons" wire:model="searchWantedPersons">
                <label class="label-dark inline-block underline cursor-pointer" for="wantedPersons">Wanted
                    Persons</label>
            </div>
            <div>
                <input class="" type="checkbox" id="localDeceased" wire:model="searchLocalDeceased">
                <label class="label-dark inline-block underline cursor-pointer" for="localDeceased">Local
                    Deceased</label>
            </div>
            <div class="">
                <button class="btn btn-gray btn-md btn-rounded" wire:click="search">Search</button>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-2 mt-3">
        <div class="col-span-2">
            <p>{{$searchText}}</p>
        </div>
        @foreach ($results as $civilian)
            <a class="" href="{{route('mdt.civilianReturn', $civilian->id)}}">
                <div class="bg-[#222423] rounded-lg p-4 text-white hover:bg-[#0C1011] transition-colors">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-bold">{{ $civilian->last_name }}, {{ $civilian->first_name }}</h2>
                        <div>
                            @if($civilian->status == CivilianStatus::Wanted)
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">WANTED</span>
                            @endif
                            @if($civilian->status == CivilianStatus::Jailed)
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">Jailed</span>
                            @endif
                            @if($civilian->status == CivilianStatus::Dead)
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">Deceased</span>
                            @endif
                            @if($civilian->status == CivilianStatus::Alive)
                                <span
                                    class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-green-900 text-green-300">Clear</span>
                            @endif
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
        @endforeach
    </div>

</div>
