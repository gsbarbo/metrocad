@extends('layouts.mdt')

@section('content')
    <div class="relative max-w-7xl mx-auto">
        <div class="card !max-w-7xl mx-auto">
            <div class="flex justify-between items-center">
                <h2 class="text-2xl flex items-center">
                    <svg class="w-10 h-10" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12"
                            stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <span class="ml-3">Plate: {{ $vehicle->plate }}</span>
                </h2>

                <div class="flex space-x-2">
                    @if ($vehicle->status == \App\Enum\VehicleStatus::Stolen)
                        <span class="text-red-600">Stolen VEHICLE</span>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-4 gap-2 border-2 mt-3">
                <div class="border-r-2 p-2">
                    <div class="flex">
                        <div class="">
                            <p class="font-bold">Plate:</p>
                            <p class="font-bold">Make:</p>
                            <p class="font-bold">Color:</p>
                        </div>
                        <div class="ml-3">
                            <p>{{ $vehicle->plate }}</p>
                            <p>{{ $vehicle->vehicle_type->name }}</p>
                            <p>{{ $vehicle->color }}</p>
                        </div>
                    </div>
                </div>
                <div class="border-r-2 p-2 col-span-2">
                    <div class="flex">
                        <div class="">
                            <p class="font-bold">Registration Expires:</p>
                            <p class="font-bold">Status:</p>
                            <p class="font-bold">Registered Owner:</p>

                        </div>
                        <div class="ml-3">
                            <p>{{ $vehicle->expires_at->format('m/d/Y') }}</p>
                            <p>{{ $vehicle->status->name }}</p>
                            @if ($vehicle->civilian)
                                {{ $vehicle->civilian->name }} ({{ $vehicle->civilian->s_n_n }})
                            @elseif (false)
                                {{--                                {{ $vehicle->business->name }} <span class="text-blue-600">(BUSSINESS VEHICLE)</span>--}}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="p-2">
                    {{--                    <img alt="" src="{{ $vehicle->picture }}">--}}
                </div>
            </div>
            <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">
                <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">
                    <span>Alerts
                        @if ($vehicle->status == \App\Enum\VehicleStatus::Stolen)
                            <span class="text-red-600">Stolen</span>
                        @endif
                        {{--                        @if ($vehicle->business)--}}
                        {{--                            <span class="ml-3 text-blue-600">--}}
                        {{--                                Advise--}}
                        {{--                            </span>--}}
                        {{--                        @endif--}}

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
                    @if ($vehicle->status == \App\Enum\VehicleStatus::Stolen)
                        <span class="text-red-600">Reported Stolen Vehicle</span>
                    @endif
                    {{--                    @if ($vehicle->business)--}}
                    {{--                        <div class="ml-3 text-blue-600">--}}
                    {{--                            <p>Registered to a Business</p>--}}
                    {{--                        </div>--}}
                    {{--                    @endif--}}

                </div>
            </div>
            @if ($vehicle->civilian)
                <div class="border-b-2 border-x-2 w-full p-2 select-none" x-data="{ isOpen: false }">
                    <h3 @click="isOpen = !isOpen" class="text-lg flex justify-between items-center cursor-pointer">
                        <span>Registered Owner
                            <div class="space-x-2 inline-block">
                                @if ($vehicle->civilian->status == \App\Enum\CivilianStatus::Wanted)
                                    <span class="text-red-700">Active Warrant</span>
                                @endif
                            </div>
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
                        <div class="ml-3 mb-4">

                            <div class="flex justify-between items-center">
                                <a class="text-2xl flex items-center"
                                   href="{{ route('mdt.civilianReturn', $vehicle->civilian->id) }}" target="_blank">
                                    <svg class="w-10 h-10" fill="none" stroke-width="1.5" stroke="currentColor"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>

                                    <span class="ml-3">Name: {{ $vehicle->civilian->last_name }},
                                        {{ $vehicle->civilian->first_name }}</span>

                                    <svg class="w-8 h-8 text-blue-700 ml-2" fill="none" stroke-width="1.5"
                                         stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                                            stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                            </div>

                            <div class="grid grid-cols-4 gap-2 border-2 mt-3">
                                <div class="col-span-2 border-r-2 p-2">
                                    <div class="flex">
                                        <div class="">
                                            <p class="font-bold">Address:</p>
                                            <p class="font-bold">Driver License:</p>
                                            <p class="font-bold">Social Security:</p>
                                            <p class="font-bold">Phone:</p>
                                            <p class="font-bold">Type:</p>
                                            <p class="font-bold">Occupation:</p>
                                        </div>
                                        <div class="ml-3">
                                            <p>{{ $vehicle->civilian->full_address }} </p>
                                            <p>{{$vehicle->civilian->drivers_license->number ?? 'No drivers license'}}</p>
                                            <p>{{ $vehicle->civilian->s_n_n }}</p>
                                            <p>{{$vehicle->civilian->phone_number}}</p>
                                            <p>INDIV - Individual</p>
                                            <p>{{ $vehicle->civilian->occupation }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-r-2 p-2">
                                    <div class="flex">
                                        <div class="">
                                            <p class="font-bold">Age:</p>
                                            <p class="font-bold">Birth:</p>
                                            <p class="font-bold">Race:</p>
                                            <p class="font-bold">Sex:</p>
                                            <p class="font-bold">Height:</p>
                                            <p class="font-bold">Weight:</p>
                                        </div>
                                        <div class="ml-3">
                                            <p>{{ $vehicle->civilian->age }}</p>
                                            <p>{{ $vehicle->civilian->date_of_birth->format('m/d/Y') }}</p>
                                            <p>{{ $vehicle->civilian->race }}</p>
                                            <p>{{ $vehicle->civilian->gender }}</p>
                                            <p>{{ $vehicle->civilian->height }}</p>
                                            <p>{{ $vehicle->civilian->weight }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2">
                                    @if (is_null($vehicle->civilian->picture))
                                        <svg class="w-20 h-20 mx-auto" fill="none" stroke-width="1.5"
                                             stroke="currentColor" viewBox="0 0 24 24"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                                                stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @else
                                        <img alt="" src="{{ $vehicle->civilian->picture }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
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
                        <form action="{{route('mdt.vehicleReturn.linkVehicleToCall', $vehicle->id)}}" method="POST"
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
            <div class="mt-3 flex justify-between">
                <div class="flex flex-col">
                    <div>
                        <a class="btn btn-md btn-green btn-rounded" href="{{ route('mdt.vehicleSearch') }}">Search
                            More</a>
                        <a class="btn btn-md btn-blue btn-rounded"
                           href="{{ route('mdt.vehicleReturn', $vehicle->plate) }}">Refresh
                            Data</a>
                    </div>
                    {{--                    @if (auth()->user()->active_unit->user_department->department->type == 1)--}}
                    {{--                        <div class="mt-3">--}}
                    {{--                            <a class="secondary-button-md" href="#" onclick="openExternalWindow('#')">New--}}
                    {{--                                Warning</a>--}}
                    {{--                            <a class="secondary-button-md" href="#" onclick="openExternalWindow('#')">New--}}
                    {{--                                Ticket</a>--}}
                    {{--                            <a class="secondary-button-md" href="#" onclick="openExternalWindow('#')">New--}}
                    {{--                                Arrest</a>--}}
                    {{--                        </div>--}}
                    {{--                    @elseif (auth()->user()->active_unit->user_department->department->type == 2)--}}
                    {{--                        <p>Dispatch doesn't have options yet.</p>--}}
                    {{--                    @elseif (auth()->user()->active_unit->user_department->department->type == 4)--}}
                    {{--                        <a class="secondary-button-md" href="#" onclick="openExternalWindow('#')">New--}}
                    {{--                            Medical History</a>--}}
                    {{--                    @endif--}}

                </div>
                <div>
                    {{--                    <form action="#" class="space-y-2"--}}
                    {{--                          method="POST">--}}
                    {{--                        @csrf--}}
                    {{--                        <select class="select-input w-full" id="call_id" name="call_id">--}}
                    {{--                            <option value="">Link Vehicle to Call</option>--}}
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
                </div>
            </div>
        </div>
    </div>
@endsection
