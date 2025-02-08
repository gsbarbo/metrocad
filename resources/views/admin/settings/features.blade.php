@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Extra Features Settings" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.features') }}">Extra Features Settings</x-breadcrumb-link>
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
        <form action="{{ route('admin.settings.update') }}" class="divide-y" id="mdeditor" method="POST">
            @csrf

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">LOA Requests</p>
                        <p class="form-help-text-dark">This will allow members to submit LOA requests through the user
                            profile page.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="feature_loa_requests" name="feature_loa_requests">
                            <option @selected(old('feature_loa_requests', get_setting('feature_loa_requests')) == false) value="0">Off</option>
                            <option @selected(old('feature_loa_requests', get_setting('feature_loa_requests')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3 flex justify-end">
                <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
            </div>
        </form>
    </div>
@endsection
