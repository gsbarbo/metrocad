@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Penal Code Values" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-text>Values - Penal Codes</x-breadcrumb-text>
    </x-breadcrumb>
    <x-admin.header learn-route="#">
        <div class="">
            <a href="{{ route('admin.settings.penalCode.create') }}">
                <button class="btn btn-green btn-md btn-rounded" type="button">Add Penal Code</button>
            </a>
        </div>
    </x-admin.header>

    <div class="">
        <livewire:data-table
            :model="\App\Models\PenalCode::class"
            editRoute="admin.settings.penalCode.edit"
            :columns="[
            'title_number' => 'Title Number',
            'section_number' => 'Section Number',
            'code' => 'Code',
            'code_title' => 'Title',
            'is_active' => [
                'label' => 'Active',
                'searchable' => false,
                ],
            ]"
        />
    </div>
@endsection
