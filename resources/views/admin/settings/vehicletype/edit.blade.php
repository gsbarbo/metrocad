@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Edit Vehicle" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.vehicletype.index') }}">Values - Vehicles</x-breadcrumb-link>
        <x-breadcrumb-text>Edit - {{ $vehicle_type->make . ' ' . $vehicle_type->model }}</x-breadcrumb-text>
    </x-breadcrumb>
    <div>
        <a class="flex text-sm items-center text-blue-600 underline" href="#">Learn
            More
            <svg class="w-4 h-4 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                    stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>

    <div class="max-w-3xl mx-auto space-y-4">
        <form action="{{ route('admin.settings.vehicletype.update', $vehicle_type->id) }}" class="space-y-4"
              method="POST">
            @csrf
            @method('put')

            <x-forms.input name="type" label="Type" required>{{$vehicle_type->type}}</x-forms.input>
            <x-forms.input name="make" label="Make" required>{{$vehicle_type->make}}</x-forms.input>
            <x-forms.input name="model" label="Model" required>{{$vehicle_type->model}}</x-forms.input>
            <x-forms.input name="price" label="Price">{{$vehicle_type->price}}</x-forms.input>
            <x-forms.input name="spawn_code" label="Spawn Code">{{$vehicle_type->spawn_code}}</x-forms.input>

            <x-forms.select name="is_emergency_vehicle" label="Is this an emergency vehicle?" required>
                <option @selected(old('is_emergency_vehicle', $vehicle_type->is_emergency_vehicle) == 0) value="0">No
                </option>
                <option @selected(old('is_emergency_vehicle', $vehicle_type->is_emergency_vehicle) == 1) value="1">Yes
                </option>
            </x-forms.select>

            <x-forms.buttons name="Save" cancel-route="admin.settings.vehicletype.index"></x-forms.buttons>
        </form>

        <x-forms.danger-area
            confirm="{{$vehicle_type->make}} {{$vehicle_type->model}}"
            route="admin.settings.vehicletype.destroy"
            id="{{$vehicle_type->id}}"
            cancel-route="admin.settings.vehicletype.index">
            <li>Civilian vehicles ({{ $vehicle_type->vehicles->count() }})</li>
            <li>Any tickets associated with those vehicles</li>
        </x-forms.danger-area>
    </div>
@endsection
