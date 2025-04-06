@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Create Role" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.index') }}">Roles</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.index') }}">Create Role</x-breadcrumb-link>
    </x-breadcrumb>
    <div>
        <a class="flex text-sm items-center text-blue-600 underline" href="#">Learn
            More
            <svg class="w-4 h-4 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </a>
    </div>

    <form action="{{ route('admin.settings.role.store') }}" class="" method="POST">
        @csrf
        <div class="mb-3">
            <label class="label-dark" for="name">
                Role Name
            </label>
            <input autofocus class="form-text-input-dark @error('name') !border-red-600 !border @enderror" id="name"
                name="name" placeholder="Admin" required type="text" value="{{ old('name') }}" />

            @error('name')
                <p class="form-error-text">{{ $message }}</p>
            @enderror
        </div>

        @if (get_setting('feature_use_discord_roles'))
            <div class="mb-3">
                <label class="label-dark" for="discord_role_id">
                    Discord Role ID
                </label>
                <select class="form-select-input-dark @error('discord_role_id') !border-red-600 !border @enderror"
                    id="discord_role_id" name="discord_role_id">
                    <option value="">Choose Role</option>
                    @foreach ($discord_roles as $id => $discord_role)
                        @if ($id != 0 && $discord_role->managed != true)
                            <option @selected(old('discord_role_id') == $discord_role->id) value="{{ $discord_role->id }}">
                                {{ $discord_role->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('discord_role_id')
                    <p class="form-error-text">{{ $message }}</p>
                @enderror
            </div>
        @endif
        <div class="mb-3">
            <label class="label-dark" for="text">Permissions</label>
            @error('permissions')
                <p class="form-error-text">{{ $message }}</p>
            @enderror
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @forelse ($permissions as $permission)
                    <label class="inline-flex items-center cursor-pointer">
                        <input class="sr-only peer" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</span>
                    </label>
                @empty
                    <p>There are no permissions in the Database. Contact support to fix.</p>
                @endforelse
            </div>
        </div>

        <div class="flex justify-between items-center">
            <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
            <a class="text-red-600 hover:underline" href="{{ route('admin.settings.role.index') }}">Cancel</a>
        </div>

    </form>
@endsection
