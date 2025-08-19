@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="License Values" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-text>Values - Licenses</x-breadcrumb-text>
    </x-breadcrumb>
    <x-admin.header learn-route="#">
        <div class="">
            <a href="{{ route('admin.settings.licenseValues.create') }}">
                <button class="btn btn-green btn-md btn-rounded" type="button">Add License Type</button>
            </a>
        </div>
    </x-admin.header>

    <div class="">
        <livewire:data-table
            :model="\App\Models\LicenseType::class"
            editRoute="admin.settings.licenseValues.edit"
            :columns="['name' => 'Name']"
        />
    </div>
@endsection
