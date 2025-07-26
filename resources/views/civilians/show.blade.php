@extends('layouts.civilian')

@section('main')
    <x-breadcrumb pageTitle="{{ $civilian->name }}" route="{{ route('portal.dashboard') }}">
        <x-breadcrumb-link route="{{ route('civilians.index') }}">Your Civilians</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('civilians.show', $civilian->id) }}">{{ $civilian->name }}</x-breadcrumb-link>
    </x-breadcrumb>
    <div>
        @if ($civilian->is_active)
            <span
                class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Current
                Active Civilian</span>
        @else
            <span
                class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">Activate
                Civilian</span>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="divide-y space-y-2">
            @if (is_null($civilian->picture))
                <svg class="h-48 w-48 mx-auto rounded-full" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            @else
                <img alt="picture" class="h-48 w-48 mx-auto rounded-full" src="{{ $civilian->picture }}">
            @endif

            <p class="">SNN: {{ $civilian->s_n_n }}</p>
            <p class="">DOB: {{ $civilian->date_of_birth->format(get_setting('date_format', 'm/d/Y')) }}</p>
            <p class="">Race: {{ $civilian->race }}</p>
            <p class="">Gender: {{ $civilian->gender }}</p>

            <p class="">Age: {{ $civilian->age }}</p>
            <p class="">Height: {{ $civilian->height }}</p>
            <p class="">Weight: {{ $civilian->weight }}</p>
            <p class="">Home Address: {{ $civilian->address->full_address }}</p>
            <p class="">Occupation: {{ $civilian->occupation }}</p>
        </div>
        <div class="md:col-span-3 divide-y space-y-2">

            <div class="" x-data="{ open: false }">
                <div @click="open = !open" class="flex justify-between items-center cursor-pointer select-none">
                    <h2 class="text-2xl font-semibold">Licenses
                        <span class="text-sm">({{ $civilian->licenses->count() }})</span>
                    </h2>
                    <div>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m4.5 15.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2" x-show="open">
                    @if (count($available_licenses) !== 0)
                        <div class="col-span-2" x-data="{ openSub: false }">
                            <div @click="openSub = !openSub"
                                class="bg-green-400 p-1 select-none cursor-pointer flex justify-between items-center">
                                <h2 class="text-lg text-green-900">New License</h2>
                                <p class="text-sm text-green-800 ml-3">Click to open</p>
                            </div>
                            <div class="border border-green-400" x-show="openSub">
                                <form action=" {{ route('civilians.license.store', $civilian->id) }}"
                                    class="grid gap-3 p-3 grid-cols-1 md:grid-cols-3" method="POST">
                                    @csrf
                                    <div class="">
                                        <label class="label-dark" for="license_type_id">
                                            Type
                                        </label>
                                        <select class="form-select-input-dark" id="license_type_id" name="license_type_id">
                                            <option value="">License Type</option>
                                            @foreach ($available_licenses as $license)
                                                <option value="{{ $license->id }}">{{ $license->name }}</option>
                                            @endforeach
                                        </select>

                                        @error('license_type_id')
                                            <p class="text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <label class="label-dark" for="status">
                                            Initial Status
                                        </label>
                                        <select class="form-select-input-dark" id="status" name="status">
                                            <option value="">Status</option>
                                            @foreach (App\Enum\LicenseStatuses::cases() as $status)
                                                <option value="{{ $status->value }}">{{ $status->name() }}</option>
                                            @endforeach
                                        </select>

                                        @error('status')
                                            <p class="text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="">
                                        <p class="form-help-text-dark">Status can not be changed without an officer after
                                            this.
                                        </p>
                                        <button class="btn-default" type="submit">Get License</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                    @forelse ($civilian->licenses as $license)
                        <div>
                            <x-civilian.license-card :civilian="$civilian" :license="$license"></x-civilian.license-card>
                        </div>
                    @empty
                        <p>You have no licenses.</p>
                    @endforelse
                </div>
            </div>

            <div class="" x-data="{ open: false }">
                <div @click="open = !open" class="flex justify-between items-center cursor-pointer select-none">
                    <h2 class="text-2xl font-semibold">Vehicles
                        <span class="text-sm">({{ $civilian->vehicles->count() }})</span>
                    </h2>
                    <div>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m4.5 15.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2" x-show="open">
                    <div class="col-span-2" x-data="{ openSub: false }">
                        <div @click="openSub = !openSub"
                            class="bg-green-400 p-1 select-none cursor-pointer flex justify-between items-center">
                            <h2 class="text-lg text-green-900">New Vehicle</h2>
                            <p class="text-sm text-green-800 ml-3">Click to open</p>
                        </div>
                        <div class="border border-green-400" x-show="openSub">
                            <form action=" {{ route('civilians.vehicle.store', $civilian->id) }}"
                                class="grid gap-3 p-3 grid-cols-1 md:grid-cols-3" method="POST">
                                @csrf
                                <div class="">
                                    <label class="label-dark" for="vehicle_type_id">
                                        Vehicle<span class="text-red-600">*</span>
                                    </label>
                                    <select class="form-select-input-dark" id="vehicle_type_id" name="vehicle_type_id">
                                        <option value="">Vehicles</option>
                                        @foreach ($vehicleOptions as $vehicle)
                                            <option value="{{ $vehicle->id }}">
                                                {{ $vehicle->make }} {{ $vehicle->model }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('vehicle_type_id')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <label class="label-dark" for="status">
                                        Initial Status<span class="text-red-600">*</span>
                                    </label>
                                    <select class="form-select-input-dark" id="status" name="status">
                                        <option value="">Status</option>
                                        @foreach (App\Enum\VehicleStatus::cases() as $status)
                                            <option value="{{ $status->value }}">{{ $status->name() }}</option>
                                        @endforeach
                                    </select>

                                    @error('status')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <label class="label-dark" for="color">
                                        Color<span class="text-red-600">*</span>
                                    </label>
                                    <input class="form-text-input-dark" id="color" name="color" type="text">

                                    @error('Color')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <label class="label-dark" for="plate">
                                        Plate<span class="text-red-600">*</span>
                                    </label>
                                    <input class="form-text-input-dark" id="plate" name="plate" type="text">

                                    @error('plate')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <p class="form-help-text-dark">Status can not be changed without an officer after
                                        this.
                                    </p>
                                    <button class="btn-default" type="submit">Register Vehicle</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @forelse ($civilian->vehicles as $vehicle)
                        <div>
                            <div class="bg-gray-200 rounded-lg p-2 text-black text-sm">
                                <div class="">
                                    <p class="text-lg text-center">{{ strtoupper(get_setting('state')) }}</p>
                                </div>
                                <div class="mt-1">
                                    <p class="text-3xl text-center">{{ $vehicle->plate }}</p>
                                </div>
                                <div class="mt-1 flex space-x-2">
                                    <p class=""><span class="text-blue-500 text-xs">MK</span>
                                        {{ $vehicle->vehicle_type->make }}
                                    </p>
                                    <p class=""><span class="text-blue-500 text-xs">MD</span>
                                        {{ $vehicle->vehicle_type->model }}
                                    </p>
                                    <p class="ml-3"><span class="text-blue-500 text-xs">CL</span>
                                        {{ $vehicle->color }}
                                    </p>
                                    <p class="ml-3">
                                        <span class="text-blue-500 text-xs">RO</span> {{ $civilian->last_name }},
                                        {{ $civilian->first_name }}
                                    </p>
                                </div>
                                <div class="border-t-2 border-black flex justify-between">

                                </div>
                            </div>
                        </div>
                    @empty
                        <p>You have no vehicles.</p>
                    @endforelse
                </div>
            </div>

            <div class="" x-data="{ open: false }">
                <div @click="open = !open" class="flex justify-between items-center cursor-pointer select-none">
                    <h2 class="text-2xl font-semibold">Firearms
                        <span class="text-sm">({{ $civilian->firearms->count() }})</span>
                    </h2>
                    <div>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="!open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m19.5 8.25-7.5 7.5-7.5-7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <svg class="size-6" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            x-show="open" xmlns="http://www.w3.org/2000/svg">
                            <path d="m4.5 15.75 7.5-7.5 7.5 7.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2" x-show="open">
                    <div class="col-span-2" x-data="{ openSub: false }">
                        <div @click="openSub = !openSub"
                            class="bg-green-400 p-1 select-none cursor-pointer flex justify-between items-center">
                            <h2 class="text-lg text-green-900">New Firearm</h2>
                            <p class="text-sm text-green-800 ml-3">Click to open</p>
                        </div>
                        <div class="border border-green-400" x-show="openSub">
                            <form action=" {{ route('civilians.firearm.store', $civilian->id) }}"
                                class="grid gap-3 p-3 grid-cols-1 md:grid-cols-3" method="POST">
                                @csrf
                                <div class="">
                                    <label class="label-dark" for="model">
                                        Model<span class="text-red-600">*</span>
                                    </label>
                                    <input class="form-text-input-dark" id="model" name="model" type="text">

                                    @error('model')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <label class="label-dark" for="status">
                                        Initial Status<span class="text-red-600">*</span>
                                    </label>
                                    <select class="form-select-input-dark" id="status" name="status">
                                        <option value="">Status</option>
                                        @foreach (App\Enum\FirearmStatus::cases() as $status)
                                            <option value="{{ $status->value }}">{{ $status->name() }}</option>
                                        @endforeach
                                    </select>

                                    @error('status')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <label class="label-dark" for="serial_number">
                                        Serial Number
                                    </label>

                                    <input class="form-text-input-dark" id="serial_number" name="serial_number"
                                        placeholder="Leave empty for default" type="text">
                                    @error('serial_number')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <p class="form-help-text-dark">Status can not be changed without an officer after
                                        this.
                                    </p>
                                    <button class="btn-default" type="submit">Register Firearm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @forelse ($civilian->firearms as $firearm)
                        <div class="bg-gray-200 rounded-lg p-2 text-black text-sm">
                            <div class="">
                                <p class="text-lg text-center">Serial Number</p>
                            </div>
                            <div class="mt-1 flex items-center justify-around">
                                <p class="text-3xl text-center">{{ $firearm->serial_number }}</p>
                            </div>
                            <div class="mt-1 flex ">
                                <p class=""><span class="text-blue-500 text-xs">MK</span>
                                    {{ $firearm->model }}
                                </p>
                                <p class="ml-3">
                                    <span class="text-blue-500 text-xs">RO</span> {{ $civilian->last_name }},
                                    {{ $civilian->first_name }}
                                </p>
                            </div>
                            <div class="border-t-2 border-black flex justify-between">
                                @if ($firearm->status == App\Enum\FirearmStatus::VALID->value)
                                    <span class="text-green-500">VALID</span>
                                @elseif($firearm->status == App\Enum\FirearmStatus::STOLEN->value)
                                    <span class="text-red-500">Stolen</span>
                                @elseif($firearm->status == App\Enum\FirearmStatus::FORSALE->value)
                                    <span class="text-red-500">For Sale</span>
                                @elseif($firearm->status == App\Enum\FirearmStatus::IMPOUNDED->value)
                                    <span class="text-red-500">Impounded</span>
                                @elseif($firearm->status == App\Enum\FirearmStatus::PENDING->value)
                                    <span class="text-blue-500">Pending</span>
                                @endif
                            </div>
                        </div>

                    @empty
                        <p>You have no firearms.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

@endsection
