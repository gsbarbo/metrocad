@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Create Department" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.index') }}">Departments</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.create') }}">Create Department
        </x-breadcrumb-link>
    </x-breadcrumb>

    <form action="{{ route('admin.settings.departments.store') }}" class="" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="mb-3">
            <label class="label-dark" for="name">
                Name
            </label>
            <input autofocus class="form-text-input-dark @error('name') !border-red-600 !border @enderror" id="name"
                   name="name" placeholder="" required type="text" value="{{ old('name') }}"/>
            @error('name')
            <p class="form-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="label-dark" for="initials">
                Initials
            </label>
            <input class="form-text-input-dark @error('initials') !border-red-600 !border @enderror" id="initials"
                   name="initials" placeholder="" required type="text" value="{{ old('initials') }}"/>

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
                @foreach(\App\Enum\DepartmentType::options() as $value => $label)
                    <option @selected(old('type') == $value) value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </select>

            @error('type')
            <p class="form-error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="label-dark" for="logo_url">
                Logo URL
            </label>
            <input class="form-text-input-dark @error('logo_url') !border-red-600 !border @enderror" id="logo_url"
                   name="logo_url" placeholder="" required type="text" value="{{ old('logo_url') }}"/>
            @error('logo_url')
            <p class="form-error-text">{{ $message }}</p>
            @enderror
        </div>


        @if (get_setting('discord.useRoles.useDepartmentRoles'))
            <div class="mb-3">
                <label class="label-dark" for="discord_role_id">
                    Discord Role
                </label>
                <select class="form-select-input-dark @error('discord_role_id') !border-red-600 !border @enderror"
                        id="discord_role_id" name="discord_role_id">
                    <option value="">Choose Role</option>
                    @foreach ($discordRoles as $id => $discordRole)
                        @if ($id != 0 && $discordRole->managed != true)
                            <option
                                @selected(old('discord_role_id') == $discordRole->id) value="{{ $discordRole->id }}">
                                {{ $discordRole->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('discord_role_id')
                <p class="form-error-text">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <div class="flex justify-between items-center">
            <input class="btn btn-green btn-md btn-rounded" type="submit" value="Save">
            <a class="text-red-600 hover:underline" href="{{ route('admin.settings.departments.index') }}">Cancel</a>
        </div>

    </form>
@endsection
