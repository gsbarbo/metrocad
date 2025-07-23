@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Edit Address" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.addresses.index') }}">Values - Address</x-breadcrumb-link>
        <x-breadcrumb-text>Edit - {{ $address->full_address }}</x-breadcrumb-text>
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
        <form action="{{ route('admin.settings.addresses.update', $address->id) }}" class="space-y-3" method="POST">
            @csrf
            @method('PUT')

            <div>
                <label class="label-dark" for="postal">Postal<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="postal" required type="number"
                    value="{{ old('postal', $address->postal) }}">
                @error('postal')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="street">Street<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="street" required type="text"
                    value="{{ old('street', $address->street) }}">
                @error('street')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="city">City<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="city" required type="text"
                    value="{{ old('city', $address->city) }}">
                @error('city')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="name">Name</label>
                <p class="form-help-text-dark">If the address is associated with a name like 24/7, Flecca Bank etc.</p>
                <input class="form-text-input-dark" name="name" type="text"
                    value="{{ old('name', $address->name) }}">
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
                    <option @selected(old('is_home', $address->is_home) == 1) value="1">Yes</option>
                    <option @selected(old('is_home', $address->is_home) == 0) value="0">No</option>
                </select>
                @error('is_home')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="is_business">Is this address a business?<span
                        class="text-red-600">*</span></label>
                <select class="form-select-input-dark" id="is_business" name="is_business">
                    <option @selected(old('is_business', $address->is_business) == 1) value="1">Yes</option>
                    <option @selected(old('is_business', $address->is_business) == 0) value="0">No</option>
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
                    <option @selected(old('is_ownable', $address->is_ownable) == 0) value="1">Yes</option>
                    <option @selected(old('is_ownable', $address->is_ownable) == 1) value="0">No</option>
                </select>
                @error('is_ownable')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button class="btn-default" name="action" type="submit" value="save">Save</button>
            </div>
        </form>

        <div class="border-red-600 border-2 p-3">
            <h3 class="text-red-600 text-lg font-bold">Danger Zone</h3>
            <p class="">Deleting this address will delete the following information that can <span
                    class="font-bold text-red-600">NOT</span> be recovered:</p>
            <ul class="list-inside list-disc ml-5">
                <li>Civilians that owned this address will not be associated with an address anymore</li>
                <li>Any tickets and calls associated with this address will show no address</li>
            </ul>
            <p>Are you sure you wish to continue?</p>
            <form action="{{ route('admin.settings.addresses.destroy', $address->id) }}" class="mt-5 block space-y-3"
                method="POST">
                @csrf
                @method('delete')

                <div>
                    <label class="label-dark" for="confirm">Please type the postal and street
                        ({{ $address->postal }} {{ $address->street }}) to confirm</label>
                    <input class="form-text-input-dark" name="confirm" type="text" value="">
                    @error('confirm')
                        <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <input class="btn-red" type="submit" value="Delete">
            </form>
        </div>

    </div>
@endsection
