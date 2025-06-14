@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Create Vehicle" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.vehicletype.index') }}">Values - Vehicles</x-breadcrumb-link>
        <x-breadcrumb-text>Create</x-breadcrumb-text>
    </x-breadcrumb>
    <div>
        <a class="flex text-sm items-center text-blue-600 underline" href="#">Learn
            More
            <svg class="w-4 h-4 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    </div>

    <div class="max-w-3xl mx-auto">
        <form action="{{ route('admin.settings.vehicletype.store') }}" class="space-y-3" method="POST">
            @csrf

            <div>
                <label class="label-dark" for="type">Type<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="type" required type="text" value="{{ old('type') }}">
                @error('type')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="make">Make<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" make="text" name="make" required value="{{ old('make') }}">
                @error('make')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="model">Model<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" model="text" name="model" required value="{{ old('model') }}">
                @error('model')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="price">Price</label>
                <input class="form-text-input-dark" name="price" type="number" value="{{ old('price', 0) }}">
                @error('price')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="is_emergency_vehicle">Is this an emergency vehicle?<span
                        class="text-red-600">*</span></label>
                <select class="form-select-input-dark" id="is_emergency_vehicle" name="is_emergency_vehicle">
                    <option @selected(old('is_emergency_vehicle') == 0) value="0">No</option>
                    <option @selected(old('is_emergency_vehicle') == 1) value="1">Yes</option>
                </select>
                @error('is_emergency_vehicle')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="spawn_code">Spawn code</label>
                <input class="form-text-input-dark" name="spawn_code" type="text" value="{{ old('spawn_code') }}">
                @error('spawn_code')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="notes">Notes</label>
                <p class="form-help-text-dark">This will show for civilians when creating a new vehicle.</p>
                <input class="form-text-input-dark" name="notes" type="text" value="{{ old('notes') }}">
                @error('notes')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input class="btn-default" type="submit" value="Create Vehicle">
            </div>
        </form>
    </div>
@endsection
