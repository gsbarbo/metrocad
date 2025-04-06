@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Create Department" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.index') }}">Departments</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.create') }}">Create Department</x-breadcrumb-link>
    </x-breadcrumb>

    <form action="{{ route('admin.settings.departments.store') }}" class="" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="mb-3">
            <label class="label-dark" for="name">
                Name
            </label>
            <input autofocus class="form-text-input-dark @error('name') !border-red-600 !border @enderror" id="name"
                name="name" placeholder="" required type="text" value="{{ old('name') }}" />
            @error('name')
                <p class="form-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="label-dark" for="initials">
                Initials
            </label>
            <input class="form-text-input-dark @error('initials') !border-red-600 !border @enderror" id="initials"
                name="initials" placeholder="" required type="text" value="{{ old('initials') }}" />

            @error('initials')
                <p class="form-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="label-dark" for="type">
                Department Type
            </label>

            <select class="form-select-input-dark" id="type" name="type">
                <option value="">Choose one</option>
                <option @selected(old('type') == 1) value="1">Law Enforcement</option>
                <option @selected(old('type') == 2) value="2">Dispatch</option>
                <option @selected(old('type') == 3) value="3">Civilian</option>
                <option @selected(old('type') == 4) value="4">Fire/EMS</option>
                <option @selected(old('type') == 5) value="5">Other In-game</option>
                <option @selected(old('type') == 6) value="6">Out of Game</option>
            </select>

            @error('type')
                <p class="form-error-text">{{ $message }}</p>
            @enderror
        </div>

        @livewire('admin.settings.upload-department-picture', [
            'title' => 'Logo',
        ])

        @if (get_setting('feature_use_discord_department_roles'))
            <div class="mb-3">
                <label class="label-dark" for="discord_role_id">
                    Discord Role
                </label>
                <select class="form-select-input-dark @error('discord_role_id') !border-red-600 !border @enderror"
                    id="discord_role_id" name="discord_role_id">
                    <option value="">Choose Role</option>
                    @foreach ($discord_roles as $id => $discord_role)
                        @if ($id != 0 && $discord_role->managed != true)
                            <option @selected(old('discord_role_id', get_setting('discord_role_id')) == $discord_role->id) value="{{ $discord_role->id }}">
                                {{ $discord_role->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('discord_role_id')
                    <p class="form-error-text">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <div class="flex justify-between items-center">
            <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
            <a class="text-red-600 hover:underline" href="{{ route('admin.settings.departments.index') }}">Cancel</a>
        </div>

    </form>
@endsection
