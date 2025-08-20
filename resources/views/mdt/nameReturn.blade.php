@extends('layouts.mdt')

@section('content')
    <div class="!max-w-6xl mx-auto bg-[#0C1011] rounded-lg p-5 text-white">
        <div class="flex justify-between items-center">
            <h2 class="text-2xl flex items-center">
                <svg class="w-10 h-10" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                        stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <span class="ml-3">Name: {{ $civilian->last_name }}, {{ $civilian->first_name }}</span>
            </h2>

            <div class="flex space-x-2">
                @if ($civilian->status == \App\Enum\CivilianStatus::Wanted)
                    <span
                        class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">Active Warrant</span>
                @endif
                @if ($civilian->status == 4)
                    <span
                        class="text-xs font-medium px-2.5 py-0.5 rounded-sm bg-red-900 text-red-300">Deceased</span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-4 gap-2 border-2 mt-3">
            <div class="col-span-2 border-r-2 p-2">
                <div class="">
                    <p class="font-bold">Address:
                        <span class="font-normal text-sm block ml-2">{{ $civilian->address->full_address }}</span>
                    </p>
                    <p class="font-bold">Driver License:
                        <span
                            class="font-normal text-sm block ml-2">
                                @if($civilian->drivers_license)
                                {{$civilian->drivers_license->number}}
                            @else
                                <span class='text-red-700'>No Drivers License</span>
                            @endif
                            </span>
                    </p>
                    <p class="font-bold">Social Security:
                        <span class="font-normal text-sm block ml-2">{{ $civilian->s_n_n }}</span>
                    </p>
                    <p class="font-bold">Phone:
                        <span
                            class="font-normal text-sm block ml-2">{{ $civilian->phone ?? "No Phone Number Listed" }}</span>
                    </p>
                    <p class="font-bold">Type:
                        <span class="font-normal text-sm block ml-2">Indiv - Individual</span>
                    </p>
                    <p class="font-bold">Occupation:
                        <span
                            class="font-normal text-sm block ml-2">{{ $civilian->occupation ?? "No Occupation Listed" }}</span>
                    </p>
                </div>
            </div>

            <div class="border-r-2 p-2">
                <div class="">
                    <p class="font-bold">Age:
                        <span class="font-normal text-sm block ml-2">{{ $civilian->age }}</span>
                    </p>
                    <p class="font-bold">Date of Birth:
                        <span
                            class="font-normal text-sm block ml-2">
                                {{ $civilian->date_of_birth->format('m/d/Y') }}
                            </span>
                    </p>
                    <p class="font-bold">Race:
                        <span class="font-normal text-sm block ml-2">{{ $civilian->race }}</span>
                    </p>
                    <p class="font-bold">Sex:
                        <span
                            class="font-normal text-sm block ml-2">{{ $civilian->gender }}</span>
                    </p>
                    <p class="font-bold">Height:
                        <span class="font-normal text-sm block ml-2">{{ $civilian->height }}</span>
                    </p>
                    <p class="font-bold">Weight:
                        <span
                            class="font-normal text-sm block ml-2">{{ $civilian->weight }}</span>
                    </p>
                </div>
            </div>
            <div class="p-2">
                <img alt="" src="{{ $civilian->picture }}">
            </div>
        </div>

        {{--            <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">--}}
        {{--                <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">--}}
        {{--                    <span>Alerts--}}
        {{--                        <div class="space-x-2 inline-block">--}}
        {{--                            @if ($civilian->status == 2)--}}
        {{--                                <span class="text-red-700">Active Warrent</span>--}}
        {{--                            @endif--}}
        {{--                            @if ($civilian->is_violent)--}}
        {{--                                <span class="text-red-700">History of Violence</span>--}}
        {{--                            @endif--}}
        {{--                            @if ($civilian->is_weapon)--}}
        {{--                                <span class="text-red-700">History of Weapons</span>--}}
        {{--                            @endif--}}
        {{--                            @if ($civilian->is_ill)--}}
        {{--                                <span class="text-red-700">History of Mental Illness</span>--}}
        {{--                            @endif--}}
        {{--                        </div>--}}
        {{--                    </span>--}}
        {{--                    <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"--}}
        {{--                         x-show="isOpen == false" xmlns="http://www.w3.org/2000/svg">--}}
        {{--                        <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
        {{--                    </svg>--}}
        {{--                    <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"--}}
        {{--                         x-show="isOpen == true" xmlns="http://www.w3.org/2000/svg">--}}
        {{--                        <path d="M4.5 15.75l7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
        {{--                    </svg>--}}
        {{--                </h3>--}}
        {{--                <div class="" x-show="isOpen">--}}
        {{--                    <div class="ml-3 text-red-700">--}}
        {{--                        @if ($civilian->status == 2)--}}
        {{--                            <p class="text-red-700">Active Warrent</p>--}}
        {{--                        @endif--}}
        {{--                        @if ($civilian->is_violent)--}}
        {{--                            <p class="text-red-700">History of Violence</p>--}}
        {{--                        @endif--}}
        {{--                        @if ($civilian->is_weapon)--}}
        {{--                            <p class="text-red-700">History of Weapons</p>--}}
        {{--                        @endif--}}
        {{--                        @if ($civilian->is_ill)--}}
        {{--                            <p class="text-red-700">History of Mental Illness</p>--}}
        {{--                        @endif--}}
        {{--                    </div>--}}
        {{--                    <div class="mt-3 border-t">--}}
        {{--                        <form action="{{ route('cad.name.update_alerts', $civilian->id) }}" method="POST">--}}
        {{--                            @csrf--}}
        {{--                            <label for="is_violent"><input @checked($civilian->is_violent) id="is_violent"--}}
        {{--                                                           name="is_violent"--}}
        {{--                                                           type="checkbox"> Flag for--}}
        {{--                                Violence</label>--}}
        {{--                            <label for="is_weapon"><input @checked($civilian->is_weapon) id="is_weapon" name="is_weapon"--}}
        {{--                                                          type="checkbox"> Flag for--}}
        {{--                                Weapons</label>--}}
        {{--                            <label for="is_ill"><input @checked($civilian->is_ill) id="is_ill" name="is_ill"--}}
        {{--                                                       type="checkbox"> Flag for Mental--}}
        {{--                                Illness</label>--}}
        {{--                            <button class="button-sm bg-blue-700 hover:bg-blue-600" type="submit" value="">Save--}}
        {{--                                Alerts--}}
        {{--                            </button>--}}
        {{--                        </form>--}}

        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}

        <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">
            <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">
                            <span>Licenses
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
                                <span class="text-green-700">{{ $active }} Current</span>
                                <span class="text-yellow-700">{{ $suspended }} Suspended</span>
                                <span class="text-red-700">{{ $expired }} Expired</span>
                            </span>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == false" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == true" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.5 15.75l7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </h3>
            <div class="" x-show="isOpen">
                <div class="ml-3">
                    @foreach ($civilian->licenses as $license)
                            <?php
                            $status = $license->status->name;
                            $status_color = 'text-green-700';

                            if ($license->is_expired) {
                                $status = 'Expired';
                                $status_color = 'text-yellow-700';
                            }

                            if ($license->status == \App\Enum\LicenseStatus::Suspended || $license->status == \App\Enum\LicenseStatus::Revoked) {
                                $status = $license->status->name;
                                $status_color = 'text-red-700';
                            }
                            ?>
                        <p class="{{ $status_color }}">{{ $license->license_type->name }} | {{ $license->number }} |
                            {{ $status }} | Expires: {{ $license->expires_at->format('m/d/Y') }}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">
            <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">
                            <span>Vehicles
                                @php
                                    $active = 0;
                                    $expired = 0;
                                    $impounded = 0;
                                    $stolen = 0;
                                @endphp
                                @foreach ($civilian->vehicles as $vehicle)
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
                                @endforeach
                                <span class="text-green-700">{{ $active }} Current</span>
                                <span class="text-yellow-700">{{ $impounded }} Suspended</span>
                                <span class="text-yellow-700">{{ $stolen }} Stolen</span>
                                <span class="text-red-700">{{ $expired }} Expired</span>
                            </span>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == false" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == true" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.5 15.75l7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </h3>
            <div class="mt-3" x-show="isOpen">
                <div class="ml-3">
                    @foreach ($civilian->vehicles as $vehicle)
                            <?php
                            $status = $vehicle->status->name;
                            $status_color = 'text-green-700';

                            if ($vehicle->is_expired) {
                                $status = 'Expired';
                                $status_color = 'text-yellow-700';
                            }

                            if ($vehicle->status == \App\Enum\VehicleStatus::Booted || $vehicle->status == \App\Enum\VehicleStatus::Impounded) {
                                $status = $vehicle->status->name;
                                $status_color = 'text-red-700';
                            }
                            ?>
                        <p>
                            <a class="{{ $status_color }} inline-flex items-center"
                               href="#" target="_blank">
                                {{ $vehicle->plate }} | {{ $vehicle->color }} {{ $vehicle->vehicle_type->name }} |
                                {{ $status }} | Expires:
                                {{ $vehicle->expires_at->format('m/d/Y') }}
                                <svg class="w-4 h-4 text-blue-700 ml-2" fill="none" stroke-width="1.5"
                                     stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                                        stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </a>
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">
            <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">
                            <span>Medical
                                @php
                                    $allergies = 0;
                                    $conditions = 0;
                                    $other = 0;
                                @endphp
                                @foreach ($civilian->medical_records as $record)
                                        <?php
                                        if ($record->name == 'Allergy') {
                                            $allergies++;
                                        } elseif ($record->name == 'Health Conditions') {
                                            $conditions++;
                                        } else {
                                            $other++;
                                        }
                                        ?>
                                @endforeach
                                <span class="text-yellow-700">
                                    {{ $allergies }}
                                    @if ($allergies == 1)
                                        Allergy
                                    @else
                                        Allergies
                                    @endif
                                </span>
                                <span class="text-yellow-700">{{ $conditions }} Health Conditions</span>
                                <span class="text-yellow-700">{{ $other }} Other</span>
                            </span>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == false" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == true" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.5 15.75l7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </h3>
            <div class="mt-3" x-show="isOpen">
                <div class="grid grid-cols-2 gap-x-3 gap-y-1">
                    @foreach ($civilian->medical_records as $record)
                        <p class="text-yellow-700" href="#">
                            <span class="font-bold">{{ $record->name }}:</span>
                            {{ $record->value }}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">
            <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">
                <span>Firearms
                    @php
                        $active = 0;
                        $stolen = 0;
                        $impounded = 0;
                    @endphp

                    @foreach ($civilian->firearms as $firearm)
                        @php
                            if ($firearm->status == \App\Enum\FirearmStatus::Impounded) {
                                $impounded++;
                            } elseif ($firearm->status == \App\Enum\FirearmStatus::Stolen) {
                                $stolen++;
                            } else {
                                $active++;
                            }
                        @endphp
                    @endforeach
                            <span class="text-yellow-700">{{ $active }} Owned</span>
                            <span class="text-red-700">{{ $impounded }} Impounded</span>
                            <span class="text-red-700">{{ $stolen }} Stolen</span>
                </span>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == false" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == true" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.5 15.75l7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </h3>
            <div class="mt-3" x-show="isOpen">
                <div class="ml-3">
                    @foreach ($civilian->firearms as $firearm)
                        @php
                            $status = $firearm->status->name;
                            $status_color = 'text-yellow-700';

                            if ($firearm->status == \App\Enum\FirearmStatus::Impounded) {
                                $status_color = 'text-red-700';
                            } elseif ($firearm->status == \App\Enum\FirearmStatus::Stolen) {
                                $status_color = 'text-red-700';
                            }
                        @endphp

                        <p class="{{ $status_color }}" href="#">
                            <span class="font-bold">{{ $firearm->model }}:</span>
                            {{ $firearm->serial_number }} - {{ $status }}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">
            <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">
                <span>Link to Call</span>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == false" xmlns="http://www.w3.org/2000/svg">
                    <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     x-show="isOpen == true" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4.5 15.75l7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </h3>
            <div class="mt-3" x-show="isOpen">
                <div class="ml-3">
                    <form action="{{route('mdt.civilianReturn.linkCivilianToCall', $civilian->id)}}" method="POST"
                          class="grid grid-cols-6 gap-2">
                        @csrf

                        <select name="call_id" id="call_id" class="mdt-select-input col-span-3">
                            <option value="0">Call ID</option>
                            @foreach($recentCalls as $call)
                                <option value="{{$call->id}}">{{$call->id}} - {{$call->nature->code()}}
                                    - {{$call->nature->label()}}</option>
                            @endforeach
                        </select>

                        <select name="type" id="type" class="mdt-select-input col-span-2">
                            <option value="0">Type</option>
                            @foreach(\App\Enum\CallCivilianTypes::options() as $id => $name)
                                <option value="{{$id}}">{{$name}}</option>
                            @endforeach
                        </select>

                        <input type="submit" value="LINK TO CALL" class="btn btn-green btm-sm btn-rounded">

                    </form>
                </div>
            </div>
        </div>

        {{--            <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">--}}
        {{--                <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">--}}
        {{--                    <span>Involvements--}}
        {{--                        @php--}}
        {{--                            $warning = 0;--}}
        {{--                            $tickets = 0;--}}
        {{--                            $arrests = 0;--}}

        {{--                            $rp = 0;--}}
        {{--                            $witness = 0;--}}
        {{--                            $suspect = 0;--}}
        {{--                        @endphp--}}
        {{--                        @foreach ($civilian->tickets as $ticket)--}}
        {{--                                <?php--}}
        {{--                                if ($ticket->type_id == 1) {--}}
        {{--                                    $warning++;--}}
        {{--                                } elseif ($ticket->type_id == 2) {--}}
        {{--                                    $tickets++;--}}
        {{--                                } elseif ($ticket->type_id == 3) {--}}
        {{--                                    $arrests++;--}}
        {{--                                }--}}
        {{--                                ?>--}}
        {{--                        @endforeach--}}
        {{--                        <span class="text-green-700">{{ $warning }} Warnings</span>--}}
        {{--                        <span class="text-yellow-700">{{ $tickets }} Tickets</span>--}}
        {{--                        <span class="text-red-700">{{ $arrests }} Arrests</span>--}}
        {{--                    </span>--}}
        {{--                    <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"--}}
        {{--                         x-show="isOpen == false" xmlns="http://www.w3.org/2000/svg">--}}
        {{--                        <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
        {{--                    </svg>--}}
        {{--                    <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"--}}
        {{--                         x-show="isOpen == true" xmlns="http://www.w3.org/2000/svg">--}}
        {{--                        <path d="M4.5 15.75l7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
        {{--                    </svg>--}}
        {{--                </h3>--}}
        {{--                <div class="mt-3" x-show="isOpen">--}}
        {{--                    <div class="ml-3">--}}
        {{--                        @forelse($civilian->tickets as $ticket)--}}
        {{--                            <div class="flex items-center p-2 space-x-2">--}}
        {{--                                @php--}}
        {{--                                    if ($ticket->type_id == 1) {--}}
        {{--                                        $type = 'Warning';--}}
        {{--                                        $text_color = 'text-yellow-500';--}}
        {{--                                    } elseif ($ticket->type_id == 2) {--}}
        {{--                                        $type = 'Ticket';--}}
        {{--                                        $text_color = 'text-orange-500';--}}
        {{--                                    } elseif ($ticket->type_id == 3) {--}}
        {{--                                        $type = 'Arrest';--}}
        {{--                                        $text_color = 'text-red-500';--}}
        {{--                                    }--}}
        {{--                                @endphp--}}

        {{--                                <a class="block {{ $text_color }}" href="#"--}}
        {{--                                   onclick="openExternalWindow('{{ route('cad.ticket.show', $ticket->id) }}')">({{ $ticket->id }}--}}
        {{--                                    )--}}
        {{--                                    {{ $type }} on {{ $ticket->offense_occured_at->format('m/d/Y H:i') }} at--}}
        {{--                                    {{ $ticket->location_of_offense }} <span class="block ml-5">Offense(s)--}}
        {{--                                        @foreach ($ticket->charges as $charge)--}}
        {{--                                            @if (!$loop->last)--}}
        {{--                                                {{ $charge->penal_code->name }} (x{{ $charge->counts }}),--}}
        {{--                                            @else--}}
        {{--                                                {{ $charge->penal_code->name }} (x{{ $charge->counts }})--}}
        {{--                                            @endif--}}
        {{--                                        @endforeach--}}

        {{--                                    </span>--}}
        {{--                                </a>--}}
        {{--                            </div>--}}
        {{--                            <hr>--}}
        {{--                        @empty--}}
        {{--                            <p class="">No Involvements</p>--}}
        {{--                        @endforelse--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}

        {{--            <div class="border-b-2 border-x-2 w-full p-2">--}}
        {{--                <h3 class="text-lg flex justify-between items-center">--}}
        {{--                    <span>Notes</span>--}}
        {{--                    <svg class="w-6 h-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"--}}
        {{--                         xmlns="http://www.w3.org/2000/svg">--}}
        {{--                        <path d="M19.5 8.25l-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round"/>--}}
        {{--                    </svg>--}}
        {{--                </h3>--}}
        {{--            </div>--}}
        <div class="mt-3 flex justify-between">
            <div class="flex flex-col">
                <div>
                    <a class="btn btn-md btn-green btn-rounded" href="{{ route('mdt.civilianSearch') }}">Search More</a>
                    <a class="btn btn-md btn-blue btn-rounded" href="{{ route('mdt.civilianReturn', $civilian->id) }}">Refresh
                        Data</a>
                </div>
            </div>
        </div>
        {{--                    @if (auth()->user()->active_unit->department_type == 1)--}}
        {{--                        <div class="mt-3">--}}
        {{--                            <a class="secondary-button-md" href="#"--}}
        {{--                               onclick="openExternalWindow('{{ route('cad.ticket.create', $civilian->id) }}')">New--}}
        {{--                                Ticket/Arrest</a>--}}
        {{--                        </div>--}}
        {{--                    @elseif (auth()->user()->active_unit->department_type == 2)--}}
        {{--                        <p></p>--}}
        {{--                    @elseif (auth()->user()->active_unit->department_type == 4)--}}
        {{--                        <a class="secondary-button-md" href="#" onclick="openExternalWindow('#')">New--}}
        {{--                            Medical History</a>--}}
        {{--                    @endif--}}

        {{--                </div>--}}
        {{--                <div>--}}
        {{--                    <form action="{{ route('cad.name.link_to_call', $civilian->id) }}" class="space-y-2" method="POST">--}}
        {{--                        @csrf--}}
        {{--                        <select class="select-input w-full" id="call_id" name="call_id">--}}
        {{--                            <option value="">Link Civilian to Call</option>--}}
        {{--                            @foreach ($calls as $call)--}}
        {{--                                <option value="{{ $call->id }}">{{ $call->id }} - {{ $call->nature }}</option>--}}
        {{--                            @endforeach--}}
        {{--                        </select>--}}

        {{--                        <select class="select-input" id="type" name="type">--}}
        {{--                            <option value="">TYPE</option>--}}
        {{--                            <option value="RP">REPORTING PARTY</option>--}}
        {{--                            <option value="SUSPECT">SUSPECT</option>--}}
        {{--                            <option value="VICTIM">VICTIM</option>--}}
        {{--                            <option value="WITNESS">WITNESS</option>--}}
        {{--                            <option value="OTHER">OTHER</option>--}}
        {{--                        </select>--}}

        {{--                        <button--}}
        {{--                            class="px-4 py-2 text-center text-white bg-gray-700 rounded-lg cursor-pointer hover:bg-gray-600"--}}
        {{--                            type="submit">LINK--}}
        {{--                        </button>--}}
        {{--                    </form>--}}
        {{--                </div>--}}
        {{--            </div>--}}
    </div>
@endsection
