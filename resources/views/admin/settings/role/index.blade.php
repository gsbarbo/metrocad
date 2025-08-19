@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Roles" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.index') }}">Roles</x-breadcrumb-link>
    </x-breadcrumb>
    <x-admin.header learn-route="#">
        <div class="">
            <a href="{{ route('admin.settings.role.create') }}">
                <button class="btn btn-green btn-md btn-rounded" type="button">Add Role</button>
            </a>
        </div>
    </x-admin.header>

    <div class="">
        <livewire:data-table
            :model="\App\Models\Role::class"
            editRoute="admin.settings.role.edit"
            :columns="[
            'name' => 'Name',
            'permissions' => [
                'label' => 'Permissions',
                'relation' => 'permissions',
                'display' => 'name',
                'searchable' => true,
                'sortable'=> false,
                ]
            ]"
        />
    </div>
@endsection
