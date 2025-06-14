@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Vehicle Types" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-text>Values - Vehicles</x-breadcrumb-text>
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

    <div class="">
        <div class="py-10">
            <div class="px-4 sm:px-6 lg:px-8">
                <div class="sm:flex sm:items-center">
                    <div class="sm:flex-auto">

                    </div>
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none flex space-x-2">
                        <a href="{{ route('admin.settings.vehicletype.create') }}">
                            <button class="btn-default" type="button">Add Vehicle</button>
                        </a>
                        <a href="#import">
                            <button class="btn-alternative" type="button">Import Vehicles</button>
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
                                            scope="col">Type</th>
                                        <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0"
                                            scope="col">Name</th>
                                        <th class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-white sm:pl-0"
                                            scope="col">Spawn Code</th>
                                        <th class="relative py-3.5 pl-3 pr-4 sm:pr-0" scope="col">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800">
                                    @forelse ($vehicle_types as $vehicle_type)
                                        <tr>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                {{ $vehicle_type->type }}</td>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                {{ $vehicle_type->make }} {{ $vehicle_type->model }}</td>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                {{ $vehicle_type->spawn_code ? $vehicle_type->spawn_code : 'No Spawn Code' }}
                                            </td>
                                            <td
                                                class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0">
                                                <a
                                                    href="{{ route('admin.settings.vehicletype.edit', $vehicle_type->id) }}">Edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-white sm:pl-0"
                                                col-span="3">
                                                No vehicles have been added to the CAD yet.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <hr>
                            <div class="mt-3" id="import">
                                <form action="{{ route('admin.settings.vehicletype.import') }}" class="space-y-3"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf

                                    <input accept=".json" class="form-text-input-dark" name="file" type="file">
                                    <p class="form-help-text-dark">Please read the documentation found on the top of this
                                        page for more information and correct file format.</p>
                                    <input class="btn-default" type="submit" value="Import Vehicles">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
