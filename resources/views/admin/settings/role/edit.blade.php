@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Edit Role - {{ $role->name }}" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.index') }}">Roles</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.edit', $role->id) }}">Edit
            {{ $role->name }}</x-breadcrumb-link>
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

    <div class="text-right">
        <form action="{{ route('admin.settings.role.destroy', $role->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <a class="text-red-600 hover:underline" href="#"
                onclick="event.preventDefault();
                this.closest('form').submit();">
                Delete Role
            </a>
        </form>
    </div>

    <form action="{{ route('admin.settings.role.update', $role->id) }}" class="" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium leading-6 text-white" for="name">
                Name
            </label>
            <input autofocus class="form-text-input-dark @error('name') !border-red-600 !border @enderror" id="name"
                name="name" placeholder="Admin" required type="text" value="{{ old('name', $role->name) }}" />

            @error('name')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        @if (get_setting('feature_use_discord_roles'))
            <div class="mb-3">
                <label class="block mb-2 text-sm font-medium leading-6 text-white" for="discord_role_id">
                    Discord Role ID
                </label>
                <select class="form-select-input-dark @error('discord_role_id') !border-red-600 !border @enderror"
                    id="discord_role_id" name="discord_role_id">
                    <option value="">Choose Role</option>
                    @foreach ($discord_roles as $id => $discord_role)
                        @if ($id != 0 && $discord_role->managed != true)
                            <option @selected(old('discord_role_id', $role->discord_role_id) == $discord_role->id) value="{{ $discord_role->id }}">
                                {{ $discord_role->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('discord_role_id')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif
        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium leading-6 text-white" for="text">Permissions</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @forelse ($permissions as $permission)
                    <label class="inline-flex items-center cursor-pointer">
                        <input @checked(in_array($permission->id, $role->permissions->pluck('id')->toArray())) class="sr-only peer" name="permissions[]" type="checkbox"
                            value="{{ $permission->id }}">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</span>
                    </label>
                @empty
                    <p>No Permissions</p>
                @endforelse
            </div>
        </div>

        <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="save">

    </form>
@endsection
