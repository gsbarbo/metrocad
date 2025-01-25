@extends('layouts.admin_settings')

@section('main')
    {{-- <div class="flex justify-between items-baseline">
        <h1 class="text-xl font-bold">Manage Roles</h1>
        <a class="text-green-600 hover:underline" href="{{ route('admin.settings.role.create') }}">
            New Role
        </a>
    </div> --}}

    <div class="">
        <div class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">
                        <h1 class="text-xl font-bold leading-6 text-white">Departments</h1>
                        <p class="mt-2 text-sm text-gray-300">A list of all departments.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('admin.settings.departments.create') }}">
                            <button
                                class="block rounded-md bg-navbar px-3 py-2 text-center text-sm font-semibold text-white hover:opacity-85 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                                type="button">Add Department</button>
                        </a>
                    </div>
                </div>
                <div class="mt-8 flow-root">
                    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                            <table class="min-w-full divide-y divide-gray-700">
                                <thead>
                                    <tr>
                                        <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0"
                                            scope="col">Name</th>
                                        <th class="hidden md:table-cell px-3 py-3.5 text-left text-sm font-semibold text-white"
                                            scope="col">
                                            Members
                                        </th>
                                        @if ('feature_use_discord_department_roles')
                                            <th class="hidden md:table-cell px-3 py-3.5 text-left text-sm font-semibold text-white"
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
                                    @forelse ($departments as $department)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                <div class="flex items-center">
                                                    <img alt="" class="h-12 w-12" src="{{ $department->logo }}">
                                                    <p class="ml-3">{{ $department->name }}</p>
                                                </div>
                                            </td>
                                            <td
                                                class="hidden md:table-cell whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                5
                                            </td>
                                            @if ('feature_use_discord_department_roles')
                                                <td
                                                    class="hidden md:table-cell whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                    {{ $department->discord_role_name }}
                                                </td>
                                            @endif
                                            <td
                                                class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-0">
                                                <a class="text-indigo-400 hover:text-indigo-300"
                                                    href="{{ route('admin.settings.departments.edit', $department->slug) }}">Edit</a>
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
