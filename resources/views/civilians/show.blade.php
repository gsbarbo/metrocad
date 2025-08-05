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

        <div class="space-y-2">
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
            <div class="divide-y">
                <p class="">SNN: {{ $civilian->s_n_n }}</p>
                <p class="">DOB: {{ $civilian->date_of_birth->format(get_setting('date_format', 'm/d/Y')) }}</p>
                <p class="">Race: {{ $civilian->race }}</p>
                <p class="">Gender: {{ $civilian->gender }}</p>

                <p class="">Age: {{ $civilian->age }}</p>
                <p class="">Height: {{ $civilian->height }}</p>
                <p class="">Weight: {{ $civilian->weight }}</p>
                <p class="">Home Address: {{ $civilian->address->full_address }}</p>
                <p class="">Occupation: {{ $civilian->occupation }}</p>

                @if ($civilian->user_department)
                    <p class="">Department: {{ $civilian->user_department->department->name }}</p>
                @endif

                <p class="pt-2 flex justify-between">
                    <a class="" href="{{ route('civilians.edit', $civilian->id) }}">
                        <button class="btn btn-md btn-with-icon btn-blue btn-rounded">
                            <svg class="size-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Edit
                        </button>
                    </a>
                </p>
            </div>
            <div class="border-blue-600 border-2 p-3">
                <h3 class="text-blue-600 text-lg font-bold">Officer</h3>
                @if ($civilian->user_department)
                    <p class="">This civilian belongs to a department. You may remove them below.</p>
                    <form action="{{ route('civilians.userDepartment.destroy', $civilian->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-md btn-with-icon btn-red btn-rounded" type="submit">
                            <svg class="size-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Leave Department
                        </button>
                    </form>
                @else
                    <p class="">If this civilian is also a law enforcement officer or firefighter you need to add them
                        to
                        a department below.</p>
                    <form action="{{ route('civilians.userDepartment.update', $civilian->id) }}"
                        class="mt-5 block space-y-3" method="POST">
                        @csrf
                        @method('put')

                        <select class="form-select-input-dark" id="user_department_id" name="user_department_id">
                            @foreach ($userDepartments as $userDepartment)
                                <option value="{{ $userDepartment->id }}">{{ $userDepartment->department->name }}</option>
                            @endforeach

                        </select>

                        <button class="btn btn-md btn-blue btn-rounded" type="submit">
                            Save
                        </button>
                    </form>
                @endif

            </div>

            <div class="border-red-600 border-2 p-3">
                <h3 class="text-red-600 text-lg font-bold">Danger Zone</h3>
                <p class="">Deleting this civilian will delete the following information that can <span
                        class="font-bold text-red-600">NOT</span> be recovered:</p>
                <ul class="list-inside list-disc ml-5">
                    <li>All licenses, vehicles, firearms and medical records</li>
                    <li>Any tickets and calls associated with this civilian</li>
                </ul>
                <p>Are you sure you wish to continue?</p>
                <form action="{{ route('civilians.destroy', $civilian->id) }}" class="mt-5 block space-y-3" method="POST">
                    @csrf
                    @method('delete')

                    <div>
                        <label class="label-dark" for="confirm">Please type the full name
                            ({{ $civilian->name }}) to confirm</label>
                        <input class="form-text-input-dark" name="confirm" type="text" value="">
                        @error('confirm')
                            <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <button class="btn btn-md btn-with-icon btn-red btn-rounded" type="submit">
                        <svg class="size-4" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Delete
                    </button>
                </form>
            </div>

        </div>

        <div class="md:col-span-3 divide-y space-y-2">

            <div class="" x-data="{ open: true }">
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
                                        <select class="form-select-input-dark" id="license_type_id"
                                            name="license_type_id">
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
                                            @foreach (App\Enum\LicenseStatus::cases() as $status)
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
                                                {{ $vehicle->make }} {{ $vehicle->model }} ({{ $vehicle->type }}) -
                                                ${{ number_format($vehicle->price) }}
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
                                <div>
                                    @if ($firearm->status == App\Enum\FirearmStatus::Valid->value)
                                        <span class="text-green-500">VALID</span>
                                    @elseif($firearm->status == App\Enum\FirearmStatus::Stolen->value)
                                        <span class="text-red-500">Stolen</span>
                                    @elseif($firearm->status == App\Enum\FirearmStatus::ForSale->value)
                                        <span class="text-red-500">For Sale</span>
                                    @elseif($firearm->status == App\Enum\FirearmStatus::Impounded->value)
                                        <span class="text-red-500">Impounded</span>
                                    @elseif($firearm->status == App\Enum\FirearmStatus::Pending->value)
                                        <span class="text-blue-500">Pending</span>
                                    @endif
                                </div>
                                <form
                                    action="{{ route('civilians.firearm.destroy', ['civilian' => $civilian->id, 'firearm' => $firearm->id]) }}"
                                    method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">
                                        <svg class="size-4 text-red-700" fill="none" stroke-width="1.5"
                                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>

                            </div>
                        </div>

                    @empty
                        <p>You have no firearms.</p>
                    @endforelse
                </div>
            </div>

            <div class="" x-data="{ open: false }">
                <div @click="open = !open" class="flex justify-between items-center cursor-pointer select-none">
                    <h2 class="text-2xl font-semibold">Medical Records
                        <span class="text-sm">({{ $civilian->medical_records->count() }})</span>
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
                <div class="grid grid-cols-1 md:grid-cols-3 gap-2 mt-2" x-show="open">
                    <div class="col-span-3" x-data="{ openSub: false }">
                        <div @click="openSub = !openSub"
                            class="bg-green-400 p-1 select-none cursor-pointer flex justify-between items-center">
                            <h2 class="text-lg text-green-900">New Medical Record</h2>
                            <p class="text-sm text-green-800 ml-3">Click to open</p>
                        </div>
                        <div class="border border-green-400" x-show="openSub">
                            <form action=" {{ route('civilians.medicalRecords.store', $civilian->id) }}"
                                class="grid gap-3 p-3 grid-cols-1 md:grid-cols-3 items-baseline" method="POST">
                                @csrf
                                <div class="">
                                    <label class="label-dark" for="name">
                                        Name<span class="text-red-600">*</span>
                                    </label>
                                    <select class="form-select-input-dark" name="name">
                                        <option value="">Choose one</option>
                                        <option {{ old('name') == 'Allergy' ? 'selected' : '' }} value="Allergy">Allergy
                                        </option>
                                        <option {{ old('name') == 'Blood Type' ? 'selected' : '' }} value="Blood Type">
                                            Blood Type
                                        </option>
                                        <option {{ old('name') == 'Medications' ? 'selected' : '' }} value="Medications">
                                            Medications
                                        </option>
                                        <option {{ old('name') == 'Health Conditions' ? 'selected' : '' }}
                                            value="Health Conditions">
                                            Health
                                            Conditions</option>
                                        <option {{ old('name') == 'Other' ? 'selected' : '' }} value="Other">Other
                                        </option>
                                    </select>

                                    @error('name')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <label class="label-dark" for="value">
                                        Value<span class="text-red-600">*</span>
                                    </label>
                                    <input class="form-text-input-dark" id="value" name="value" type="text">

                                    @error('value')
                                        <p class="text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="">
                                    <button class="btn-default" type="submit">Register Record</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @forelse ($civilian->medical_records as $medical_record)
                        <div class="bg-gray-200 rounded-lg pt-2 text-black text-sm">
                            <div class="mt-1 flex">
                                {{-- <svg class="size-12 text-red-800" fill="none" stroke-width="1.5"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M12 10.5v6m3-3H9m4.06-7.19-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg> --}}

                                <svg class="size-14 text-red-800" fill="none" stroke-width="1.5"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 4.5v15m7.5-7.5h-15" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <div class="ml-4">
                                    <p class="text-xl font-thin">{{ $medical_record->name }}</p>
                                    <p class="text-2xl">{{ $medical_record->value }}</p>
                                </div>

                            </div>
                            <div class="mt-1 flex">

                            </div>
                            <div class="border-t-2 border-black flex justify-between mt-1">
                                <div class=""></div>
                                <div class="p-2">
                                    <form
                                        action="{{ route('civilians.medicalRecords.destroy', ['civilian' => $civilian->id, 'medicalRecord' => $medical_record->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('delete')
                                        <button type="submit">
                                            <svg class="size-4 text-red-700" fill="none" stroke-width="1.5"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p>You have no medical records.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </div>

@endsection
