@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Create Role" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.index') }}">Roles</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.create') }}">Create Role</x-breadcrumb-link>
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

    <form action="{{ route('admin.settings.role.store') }}" class="space-y-4 max-w-3xl mx-auto" method="POST">
        @csrf

        <x-forms.input name="name" label="Name" required></x-forms.input>

        @if (get_setting('discord.useRoles'))
            <x-forms.select name="discord_role_id" label="Discord Role" required>
                <option
                    @selected(old('discord_role_id') == '0') value="0">
                    None
                </option>
                @foreach($serverRoles as $role)
                    <option
                        @selected(old('discord_role_id') == $role->id) value="{{ $role->id }}">
                        {{ $role->name }}
                    </option>
                @endforeach
            </x-forms.select>
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

        <x-forms.buttons name="Save" cancel-route="admin.settings.role.index"></x-forms.buttons>

    </form>
@endsection
