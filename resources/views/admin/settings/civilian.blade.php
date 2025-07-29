@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Civilian Settings" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.civilian') }}">Civilian Settings</x-breadcrumb-link>
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
                        <p class="label-dark">Allow Duplicate Civilian Names</p>
                        <p class="form-help-text-dark">When enabled, this will allow users to create citizens with the same
                            name (first name and
                            surname).</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="allow_same_name_civilians"
                            name="allow_same_name_civilians">
                            <option @selected(old('allow_same_name_civilians', get_setting('allow_same_name_civilians')) == false) value="0">Off</option>
                            <option @selected(old('allow_same_name_civilians', get_setting('allow_same_name_civilians')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">Allow Duplicate Vehicle Plates</p>
                        <p class="form-help-text-dark">When enabled, this will allow users to create plates with the same
                            number.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="allow_same_plate_vehicles"
                            name="allow_same_plate_vehicles">
                            <option @selected(old('allow_same_plate_vehicles', get_setting('allow_same_plate_vehicles')) == false) value="0">Off</option>
                            <option @selected(old('allow_same_plate_vehicles', get_setting('allow_same_plate_vehicles')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">Use Imperial (inches/pounds) or Metric (centimeters/kilograms) for
                            height/weight</p>
                        <p class="form-help-text-dark">To use American Inches/Pounds for the hight and weight or to use the
                            Metic Centimeters/Kilograms.
                        </p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="use_metric_system" name="use_metric_system">
                            <option @selected(old('use_metric_system', get_setting('use_metric_system')) == false) value="0">Imperial</option>
                            <option @selected(old('use_metric_system', get_setting('use_metric_system')) == true) value="1">Metric</option>
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
