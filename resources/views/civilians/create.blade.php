@extends('layouts.civilian')

@section('main')
    <x-breadcrumb pageTitle="Create Civilian" route="{{ route('portal.dashboard') }}">
        <x-breadcrumb-link route="{{ route('civilians.index') }}">Your Civilians</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('civilians.create') }}">Create Civilian</x-breadcrumb-link>
    </x-breadcrumb>

    <div class="mt-4">
        <form action="{{ route('civilians.store') }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-6 md:gap-5 gap-3">
                <div class="md:col-span-3">
                    <label class="label-dark" for="first_name">First Name <span class="text-red-600">*</span></label>
                    <input autofocus class="form-text-input-dark" name="first_name" type="text"
                        value="{{ old('first_name') }}">
                    @error('first_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-3">
                    <label class="label-dark" for="last_name">Last Name <span class="text-red-600">*</span></label>
                    <input class="form-text-input-dark" name="last_name" type="text" value="{{ old('last_name') }}">
                    @error('last_name')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark" for="date_of_birth">Date of Birth <span class="text-red-600">*</span></label>
                    <input class="form-text-input-dark" name="date_of_birth" type="date"
                        value="{{ old('date_of_birth') }}">
                    @error('date_of_birth')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark" for="gender">Gender <span class="text-red-600">*</span></label>
                    <select class="form-select-input-dark" id="gender" name="gender">
                        @foreach (App\Support\Civilian\GenderOptions::getList() as $value => $name)
                            <option @selected(old('gender') == $value) value="{{ $value }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('gender')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark" for="race">Race <span class="text-red-600">*</span></label>
                    <select class="form-select-input-dark" id="race" name="race">
                        @foreach (App\Support\Civilian\RaceOptions::getList() as $value => $name)
                            <option @selected(old('race') == $value) value="{{ $value }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('race')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark" for="height">Height <span class="text-red-600">*</span></label>
                    <select class="form-select-input-dark" id="height" name="height">
                        @foreach (App\Support\Civilian\HeightOptions::getList() as $value => $name)
                            <option @selected(old('height') == $value) value="{{ $value }}">{{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('height')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark" for="weight">Weight <span class="text-red-600">*</span></label>
                    <select class="form-select-input-dark" id="weight" name="weight">
                        @foreach (App\Support\Civilian\WeightOptions::getList() as $value => $name)
                            <option @selected(old('weight') == $value) value="{{ $value }}">{{ $name }}
                            </option>
                        @endforeach
                    </select>
                    @error('weight')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark" for="phone_number">Phone Number</label>
                    <input class="form-text-input-dark" name="phone_number" type="text"
                        value="{{ old('phone_number') }}">
                    @error('phone_number')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- <div class="space-y-2">
                    <label class="label-dark" for="postal">Postal <span class="text-red-600">*</span></label>
                    <input class="form-text-input-dark" name="postal" type="number" value="{{ old('postal') }}">
                    @error('postal')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-3">
                    <label class="label-dark" for="street">Street <span class="text-red-600">*</span></label>
                    <input class="form-text-input-dark" name="street" type="text" value="{{ old('street') }}">
                    @error('street')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark" for="city">City <span class="text-red-600">*</span></label>
                    <input class="form-text-input-dark" name="city" type="text" value="{{ old('city') }}">
                    @error('city')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div> --}}
                <div class="md:col-span-6">
                    @livewire('civilian.address-selection')
                </div>
                <div class="md:col-span-2">
                    <label class="label-dark" for="occupation">Occupation</label>
                    <input class="form-text-input-dark" name="occupation" type="text" value="{{ old('occupation') }}">
                    @error('occupation')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <input class="btn-default" type="submit" value="Create">
            </div>
        </form>
    </div>
@endsection
