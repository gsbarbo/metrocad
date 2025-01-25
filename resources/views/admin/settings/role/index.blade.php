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
                        <h1 class="text-xl font-bold leading-6 text-white">Roles</h1>
                        <p class="mt-2 text-sm text-gray-300">A list of all the roles.</p>
                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                        <a href="{{ route('admin.settings.role.create') }}">
                            <button
                                class="block rounded-md bg-navbar px-3 py-2 text-center text-sm font-semibold text-white hover:opacity-85 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500"
                                type="button">Add Role</button>
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
                                            Permissions
                                        </th>
                                        <th class="px-3 py-3.5 text-left text-sm font-semibold text-white hidden md:table-cell"
                                            scope="col">
                                            Discord Role
                                        </th>
                                        <th class="relative py-3.5 pl-3 pr-4 sm:pr-0" scope="col">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800">
                                    @forelse ($roles as $role)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                {{ $role->name }}</td>
                                            <td
                                                class="hidden md:table-cell whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                @forelse ($role->permissions as $permission)
                                                    <span
                                                        class="inline-flex items-center rounded-md bg-blue-400/10 px-2 py-1 text-xs font-medium text-blue-400 ring-1 ring-inset ring-blue-400/30">{{ $permission->name }}</span>
                                                @empty
                                                    <p>No Permissions</p>
                                                @endforelse
                                            </td>
                                            <td
                                                class="hidden md:table-cell whitespace-nowrap px-3 py-4 text-sm text-gray-300">
                                                {{ $role->discord_role_name ?? 'No Discord Role' }}
                                            </td>
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
