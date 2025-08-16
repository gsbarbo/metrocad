@extends('layouts.admin')

@section('main')
    <x-breadcrumb pageTitle="{{ $user->name }} - Manage Departments" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.user.index') }}">Users</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.user.show', $user->id) }}">User
            - {{ $user->name }}</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.user.userDepartments.index', $user->id) }}">Manage
            Departments
        </x-breadcrumb-link>
    </x-breadcrumb>

    <div class="">
        <div class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">

                    @if (get_setting('feature_use_discord_department_roles') && get_setting('feature_use_discord_roles'))
                        <p class="text-red-600 text-lg"></p>
                        <div
                            class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 mx-auto dark:bg-gray-800 dark:text-blue-400"
                            role="alert">
                            <span class="font-medium">Info alert!</span> Departments are controlled by Discord Roles.
                            Update the members
                            roles in Discord to add/remove from departments.
                        </div>
                    @else
                        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none flex space-x-2">
                            <a href="{{ route('admin.user.userDepartments.create', $user->id) }}">
                                <button class="btn btn-md btn-green btn-rounded" type="button">Add Department</button>
                            </a>
                        </div>
                    @endif
                </div>
                <div class="mt-8 flow-root">
                    <div class="grid grid-cols-1 gap-4 mt-5 lg:grid-cols-2">
                        @forelse ($user->userDepartments as $user_department)
                            <div class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center">
                                <a class=""
                                   href="{{ route('admin.user.userDepartments.edit', ['userDepartment' => $user_department->id, 'user' => $user->id]) }}">
                                    <div class="flex items-center justify-between ml-3 text-white">
                                        <div class="flex items-center">
                                            <img alt="" class="w-20 h-20 mr-4"
                                                 src="{{ $user_department->department->logo }}">
                                            <div class="flex">
                                                <div>
                                                    <p>{{ $user_department->department->name }}</p>
                                                    <p class="-mt-1 text-xs">{{ $user_department->rank }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            {{ $user_department->badge_number }}
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @empty
                            <p>{{ $user->name }} is not in any departments.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
