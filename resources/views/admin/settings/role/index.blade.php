@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Roles" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.role.index') }}">Roles</x-breadcrumb-link>
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
    <div class="">
        <div class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="">
                    <a href="{{ route('admin.settings.role.create') }}">
                        <button
                            class="block rounded-md bg-navbar px-3 py-2 text-center text-sm font-semibold text-white hover:opacity-85 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                            type="button">Add Role
                        </button>
                    </a>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                <tr>
                                    <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0"
                                        scope="col">Name
                                    </th>
                                    <th class="hidden md:table-cell px-3 py-3.5 text-left text-sm font-semibold text-white"
                                        scope="col">
                                        Permissions
                                    </th>
                                    @if (get_setting('discord.useRoles'))
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-white hidden md:table-cell"
                                            scope="col">
                                            Discord Role
                                        </th>
                                    @endif
                                    <th class="relative py-3.5 pl-3 pr-4 sm:pr-0" scope="col">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800">
                                @forelse ($roles as $role)
                                    <tr>
                                        <td
                                            class="whitespace-nowrap flex items-center py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                            @if (is_null($role->discord_role_id))
                                                <svg class="size-6 mr-1 text-red-700" fill="none" stroke-width="1.5"
                                                     stroke="currentColor" viewBox="0 0 24 24"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
                                                        stroke-linecap="round" stroke-linejoin="round"/>
                                                </svg>
                                            @endif
                                            {{ $role->name }}
                                        </td>
                                        <td class="hidden md:table-cell px-3 py-4 text-sm text-gray-300">
                                            @forelse ($role->permissions as $permission)
                                                <span
                                                    class="inline-flex items-center rounded-md bg-blue-400/10 px-2 py-1 m-1 text-xs font-medium text-blue-400 ring-1 ring-inset ring-blue-400/30">{{ $permission->name }}</span>
                                            @empty
                                                <p>No Permissions</p>
                                            @endforelse
                                        </td>
                                        @if (get_setting('discord.useRoles'))
                                            <td
                                                class="hidden md:table-cell whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                @if (is_null($role->discord_role_id))
                                                    <svg class="size-6 text-red-700" fill="none" stroke-width="1.5"
                                                         stroke="currentColor" viewBox="0 0 24 24"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"
                                                            stroke-linecap="round" stroke-linejoin="round"/>
                                                    </svg>
                                                @elseif ($role->discord_role_id)
                                                    {{ $role->discord_role_name }}
                                                @endif
                                            </td>
                                        @endif
                                        <td
                                            class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                            <a class="text-indigo-400 hover:text-indigo-300"
                                               href="{{ route('admin.settings.role.edit', $role->id) }}">Edit</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0"
                                            col-span="3">
                                            No Roles
                                        </td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
