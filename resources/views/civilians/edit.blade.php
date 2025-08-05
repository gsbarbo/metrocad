@extends('layouts.civilian')

@section('main')
    <x-breadcrumb pageTitle="Edit Civilian ({{ $civilian->name }})" route="{{ route('portal.dashboard') }}">
        <x-breadcrumb-link route="{{ route('civilians.index') }}">Your Civilians</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('civilians.show', $civilian->id) }}">{{ $civilian->name }}</x-breadcrumb-link>
        <x-breadcrumb-text>Edit</x-breadcrumb-text>
    </x-breadcrumb>

    <div class="mt-4">
        <form action="{{ route('civilians.update', $civilian->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid md:grid-cols-6 md:gap-5 gap-3">

                <div class="md:col-span-2">
                    <label class="label-dark" for="height">Height <span class="text-red-600">*</span></label>
                    <select class="form-select-input-dark" id="height" name="height">
                        @foreach (App\Support\Civilian\HeightOptions::getList() as $value => $name)
                            <option @selected(old('height', $civilian->getRawOriginal('height')) == $value) value="{{ $value }}">{{ $name }}
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
                            <option @selected(old('weight', $civilian->getRawOriginal('weight')) == $value) value="{{ $value }}">{{ $name }}
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
                        value="{{ old('phone_number', $civilian->phone_number) }}">
                    @error('phone_number')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-6">
                    @livewire('civilian.address-selection', ['civilian' => $civilian])
                </div>

                <div class="md:col-span-2">
                    <label class="label-dark" for="occupation">Occupation</label>
                    <input class="form-text-input-dark" name="occupation" type="text"
                        value="{{ old('occupation', $civilian->occupation) }}">
                    @error('occupation')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="md:col-span-4">
                    <label class="label-dark" for="image_url">Picture
                        <span class="form-help-text-dark">Must be a Discord link.</span>
                    </label>
                    <input class="form-text-input-dark" name="image_url" type="text"
                        value="{{ old('image_url', $civilian->picture) }}">

                    @error('image_url')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mt-5">
                <button class="btn btn-md btn-green btn-rounded" type="submit">Save</button>
            </div>
        </form>

    </div>
@endsection
