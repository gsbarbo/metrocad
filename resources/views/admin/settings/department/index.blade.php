@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Departments" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.index') }}">Departments</x-breadcrumb-link>
    </x-breadcrumb>
    <x-admin.header learn-route="#">
        <div class="">
            <a href="{{ route('admin.settings.departments.create') }}">
                <button class="btn btn-green btn-md btn-rounded" type="button">Add Department</button>
            </a>
        </div>
    </x-admin.header>

    <div class="">
        <livewire:data-table
            :model="\App\Models\Department::class"
            editRoute="admin.settings.departments.edit"
            editId="slug"
            :columns="['name' => 'Name']"
        />
    </div>
@endsection
