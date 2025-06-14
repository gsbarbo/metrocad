@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Edit Vehicle" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.vehicletype.index') }}">Values - Vehicles</x-breadcrumb-link>
        <x-breadcrumb-text>Edit - {{ $vehicle_type->make . ' ' . $vehicle_type->model }}</x-breadcrumb-text>
    </x-breadcrumb>

    <div class="max-w-3xl mx-auto">
        <form action="{{ route('admin.settings.vehicletype.update', $vehicle_type->id) }}" class="space-y-3" method="POST">
            @csrf
            @method('put')

            <div>
                <label class="label-dark" for="type">Type<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" name="type" required type="text"
                    value="{{ old('type', $vehicle_type->type) }}">
                @error('type')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="make">Make<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" make="text" name="make" required
                    value="{{ old('make', $vehicle_type->make) }}">
                @error('make')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="model">Model<span class="text-red-600">*</span></label>
                <input class="form-text-input-dark" model="text" name="model" required
                    value="{{ old('model', $vehicle_type->model) }}">
                @error('model')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="price">Price</label>
                <input class="form-text-input-dark" name="price" type="number"
                    value="{{ old('price', $vehicle_type->price) }}">
                @error('price')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="is_emergency_vehicle">Is this an emergency vehicle?<span
                        class="text-red-600">*</span></label>
                <select class="form-select-input-dark" id="is_emergency_vehicle" name="is_emergency_vehicle">
                    <option @selected(old('is_emergency_vehicle', $vehicle_type->is_emergency_vehicle) == 0) value="0">No</option>
                    <option @selected(old('is_emergency_vehicle', $vehicle_type->is_emergency_vehicle) == 1) value="1">Yes</option>
                </select>
                @error('is_emergency_vehicle')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="label-dark" for="spawn_code">Spawn code</label>
                <input class="form-text-input-dark" name="spawn_code" type="text"
                    value="{{ old('spawn_code', $vehicle_type->spawn_code) }}">
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
                <input class="btn-default" type="submit" value="Save">
            </div>
        </form>

        <div class="border-red-600 border-2 p-3">
            <h3 class="text-red-600 text-lg font-bold">Danger Zone</h3>
            <p class="">Deleting this vehicle type will delete the following information that can <span
                    class="font-bold text-red-600">NOT</span> be recovered:</p>
            <ul class="list-inside list-disc ml-5">
                <li>Civilian vehicles</li>
                <li>Any tickets associated with those vehicles</li>
            </ul>
            <p>Are you sure you wish to continue?</p>
            <form action="{{ route('admin.settings.vehicletype.destroy', $vehicle_type->id) }}"
                class="mt-5 block space-y-3" method="POST">
                @csrf
                @method('delete')

                <div>
                    <label class="label-dark" for="confirm">Please type the vehicle make and model
                        ({{ $vehicle_type->make . ' ' . $vehicle_type->model }}) to confirm</label>
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
