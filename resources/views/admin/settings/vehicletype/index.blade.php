@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Vehicle Types" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-text>Values - Vehicles</x-breadcrumb-text>
    </x-breadcrumb>
    <x-admin.header learn-route="#">
        <div class="">
            <a href="{{ route('admin.settings.vehicletype.create') }}">
                <button class="btn btn-green btn-md btn-rounded" type="button">Add Vehicle</button>
            </a>
            <a href="#import">
                <button class="btn btn-gray btn-md btn-rounded" type="button">Import Vehicles</button>
            </a>
        </div>
    </x-admin.header>

    <div class="">
        <livewire:data-table
            :model="\App\Models\VehicleType::class"
            editRoute="admin.settings.vehicletype.edit"
            :columns="[
            'type' => 'Type',
            'make' => 'Make',
            'model' => 'Model',
            'spawn_code' => 'Spawn Code',
            ]"
        />
    </div>

    <div class="mt-3" id="import">
        <form action="{{ route('admin.settings.vehicletype.import') }}" class="space-y-3"
              enctype="multipart/form-data" method="POST">
            @csrf

            <input accept=".csv" class="form-text-input" name="file" type="file">
            <p class="form-help-text">Please read the documentation found on the top of this
                page for more information and correct file format.</p>
            <input class="btn btn-blue btn-md btn-rounded" type="submit" value="Import Vehicles">
        </form>
    </div>
@endsection
