@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Create Address" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.addresses.index') }}">Values - Address</x-breadcrumb-link>
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
        <form action="{{ route('admin.settings.addresses.store') }}" class="space-y-3" method="POST">
            @csrf

            <div>
                <label class="label-dark" for="postal">Postal<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="postal" required type="number" value="{{ old('postal') }}">
                @error('postal')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="street">Street<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="street" required type="text" value="{{ old('street') }}">
                @error('street')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="city">City<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="city" required type="text" value="{{ old('city') }}">
                @error('city')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="name">Name</label>
                <p class="form-help-text-dark">If the address is associated with a name like 24/7, Flecca Bank etc.</p>
                <input class="form-text-input-dark" name="name" type="text" value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="is_home">Is this address a residence?<span
                        class="text-red-600">*</span></label>
                <p class="form-help-text-dark">Would this address be associated with a Civilian's place to live? This will
                    allow Civilians to select this as their home.</p>
                <select class="form-select-input-dark" id="is_home" name="is_home">
                    <option @selected(old('is_home', 1) == 1) value="1">Yes</option>
                    <option @selected(old('is_home', 1) == 0) value="0">No</option>
                </select>
                @error('is_home')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="is_business">Is this address a business?<span
                        class="text-red-600">*</span></label>
                <select class="form-select-input-dark" id="is_business" name="is_business">
                    <option @selected(old('is_business', 0) == 1) value="1">Yes</option>
                    <option @selected(old('is_business', 0) == 0) value="0">No</option>
                </select>
                @error('is_business')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="is_ownable">Can a Civilian own this address?<span
                        class="text-red-600">*</span></label>
                <p class="form-help-text-dark">If the address can owned by a civilian.</p>
                <select class="form-select-input-dark" id="is_ownable" name="is_ownable">
                    <option @selected(old('is_ownable', 1) == 0) value="1">Yes</option>
                    <option @selected(old('is_ownable', 1) == 1) value="0">No</option>
                </select>
                @error('is_ownable')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button class="btn-default" name="action" type="submit" value="create">Create</button>
                <button class="btn-alternative" name="action" type="submit" value="create_add_another">Create & Add
                    Another</button>
            </div>
        </form>
    </div>
@endsection
