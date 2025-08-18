@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Departments" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.index') }}">Departments</x-breadcrumb-link>
    </x-breadcrumb>

    <x-admin.header buttonRoute="{{ route('admin.settings.departments.create') }}" buttonText="Add Department"
                    learnRoute="#"/>

    <div class="">
        <table class="min-w-full divide-y divide-gray-700">
            <thead>
            <tr>
                <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0">
                    Name
                </th>
                <th class="hidden md:table-cell px-3 py-3.5 text-left text-sm font-semibold text-white">
                    Members
                </th>
                @if (get_setting('discord.useRoles.useDepartmentRoles', 0))
                    <th class="hidden md:table-cell px-3 py-3.5 text-left text-sm font-semibold text-white">
                        Discord Role
                    </th>
                @endif
                <th class="">
                </th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-800">
            @forelse ($departments as $department)
                <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                        <div class="flex items-center">
                            <img alt="" class="h-12 w-12" src="{{ $department->logo }}">
                            <p class="ml-3">{{ $department->name }}</p>
                        </div>
                    </td>
                    <td class="hidden md:table-cell whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                        No Data
                    </td>
                    @if (get_setting('discord.useRoles.useDepartmentRoles', 0))
                        <td class="hidden md:table-cell whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                            {{ $department->discord_role_name }}
                        </td>
                    @endif
                    <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                        <a class="text-indigo-400 hover:text-indigo-300"
                           href="{{ route('admin.settings.departments.edit', $department->slug) }}">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0" col-span="3">
                        No Roles
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@endsection
