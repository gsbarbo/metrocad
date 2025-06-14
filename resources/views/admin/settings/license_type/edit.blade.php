@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Edit License" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.license_type.index') }}">Values - License</x-breadcrumb-link>
        <x-breadcrumb-text>Edit {{ $license_type->name }}</x-breadcrumb-text>
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
        <form action="{{ route('admin.settings.license_type.update', $license_type->id) }}" class="space-y-3"
            method="POST">
            @csrf
            @method('put')

            <div>
                <label class="label-dark" for="name">Name<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="name" required type="text"
                    value="{{ old('name', $license_type->name) }}">
                @error('name')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="format">Format<span class="text-red-600">*</span></label>
                <p class="form-help-text-dark">What the random license number format should be. ie If you want it to be 6
                    numbers then put '######'. If you want 2 letters and 5 numbers put 'AA#####'.
                    <br>(Guide: A - Letter; # - Number). Do not use spaces or dashes. Default is 9 numbers.
                </p>
                <input class="form-text-input-dark" name="format" required type="text"
                    value="{{ old('format', $license_type->format) }}">
                @error('format')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="prefix">Prefix<span class="text-red-600"></span></label>
                <p class="form-help-text-dark">What the license should start with. ie if you want all drivers licenses to
                    start with DL##### you would want to put DL here. This is in addition to the above format.</p>
                <input class="form-text-input-dark" name="prefix" type="text"
                    value="{{ old('prefix', $license_type->prefix) }}">
                @error('prefix')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <input class="btn-default" type="submit" value="Update License">
            </div>
        </form>

        <div class="border-red-600 border-2 p-3">
            <h3 class="text-red-600 text-lg font-bold">Danger Zone</h3>
            <p class="">Deleting this license value will delete the following information that can <span
                    class="font-bold text-red-600">NOT</span> be recovered:</p>
            <ul class="list-inside list-disc ml-5">
                <li>Civilian licenses</li>
                <li>Any tickets associated with those licenses</li>
            </ul>
            <p>Are you sure you wish to continue?</p>
            <form action="{{ route('admin.settings.license_type.destroy', $license_type->id) }}"
                class="mt-5 block space-y-3" method="POST">
                @csrf
                @method('delete')

                <div>
                    <label class="label-dark" for="confirm">Please type the license name
                        ({{ $license_type->name }}) to confirm</label>
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
