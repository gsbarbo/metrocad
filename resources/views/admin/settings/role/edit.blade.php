@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Edit Role - {{ $role->name }}" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.index') }}">Roles</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.edit', $role->id) }}">Edit
            {{ $role->name }}</x-breadcrumb-link>
    </x-breadcrumb>

    <div class="space-y-4 max-w-3xl mx-auto">
        <form action="{{ route('admin.settings.role.update', $role->id) }}" class="space-y-4" method="POST">
            @csrf
            @method('PUT')
            <x-forms.input name="name" label="Name" required>{{$role->name}}</x-forms.input>

            @if (get_setting('discord.useRoles'))
                <x-forms.select name="discord_role_id" label="Discord Role" required>
                    <option
                        @selected(old('discord_role_id') == '0') value="0">
                        None
                    </option>
                    @foreach($serverRoles as $serverRole)
                        <option
                            @selected(old('discord_role_id', $serverRole->id) == $serverRole->id) value="{{ $serverRole->id }}">
                            {{ $serverRole->name }}
                        </option>
                    @endforeach
                </x-forms.select>
            @endif

            <div class="mb-3">
                <label class="block mb-2 text-sm font-medium leading-6 text-white" for="text">Permissions</label>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                    @forelse ($permissions as $permission)
                        <label class="inline-flex items-center cursor-pointer">
                            <input
                                @checked(in_array($permission->id, $role->permissions->pluck('id')->toArray())) class="sr-only peer"
                                name="permissions[]" type="checkbox"
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

            <x-forms.buttons name="Save" cancel-route="admin.settings.role.index"></x-forms.buttons>

        </form>

        <x-forms.danger-area
            confirm="{{$role->name}}"
            route="admin.settings.role.destroy"
            id="{{$role->id}}"
            cancel-route="admin.settings.role.index">
            <li>Current Users with this role will loose it.</li>
        </x-forms.danger-area>
    </div>
@endsection
