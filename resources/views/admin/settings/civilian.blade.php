@extends('layouts.admin_settings')

@section('main')
    <header class="w-full my-3">
        <h1 class="text-2xl font-bold text-white">Civilian Settings</h1>
        {{-- <p class="text-sm"><a class="flex text-sm items-center text-blue-600 underline"
                href="https://communitycad.app/docs/settings-page">Learn More
                <svg class="w-4 h-4 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a></p> --}}
    </header>
    <div class="">
        <form action="{{ route('admin.settings.update') }}" class="divide-y" id="mdeditor" method="POST">
            @csrf

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="text-lg font-semibold">Allow Duplicate Civilian Names</p>
                        <p>When enabled, this will allow users to create citizens with the same name (first name and
                            surname).</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 select-input" id="allow_same_name_civilians" name="allow_same_name_civilians">
                            <option @selected(old('allow_same_name_civilians', get_setting('allow_same_name_civilians')) == false) value="0">Off</option>
                            <option @selected(old('allow_same_name_civilians', get_setting('allow_same_name_civilians')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="text-lg font-semibold">Allow Duplicate Vehicle Plates</p>
                        <p>When enabled, this will allow users to create plates with the same number.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 select-input" id="allow_same_plate_vehicles" name="allow_same_plate_vehicles">
                            <option @selected(old('allow_same_plate_vehicles', get_setting('allow_same_plate_vehicles')) == false) value="0">Off</option>
                            <option @selected(old('allow_same_plate_vehicles', get_setting('allow_same_plate_vehicles')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="text-lg font-semibold">Use Imperial (inches/pounds) or Metric (centimeters/kilograms) for
                            height/weight</p>
                        <p>To use American Inches/Pounds for the hight and weight or to use the Metic Centimeters/Kilograms.
                        </p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 select-input" id="use_metric_system" name="use_metric_system">
                            <option @selected(old('use_metric_system', get_setting('use_metric_system')) == false) value="0">Imperial</option>
                            <option @selected(old('use_metric_system', get_setting('use_metric_system')) == true) value="1">Metric</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <p class="text-lg font-semibold">ATF Name</p>
                <p>What you want the ATF to be named in the Civilian Portal.</p>
                <input class="text-input" name="atf_name" type="text"
                    value="{{ old('atf_name', get_setting('atf_name', 'Alcohol, Tobacco and Firearms')) }}">
            </div>

            <div class="p-3">
                <p class="text-lg font-semibold">ATF Initials</p>
                <p>What you want the ATF to be initials in the Civilian Portal.</p>
                <input class="text-input" name="atf_initials" type="text"
                    value="{{ old('atf_initials', get_setting('atf_initials', 'ATF')) }}">
            </div>

            <div class="p-3">
                <p class="text-lg font-semibold">DMV Name</p>
                <p>What you want the DMV to be named in the Civilian Portal.</p>
                <input class="text-input" name="dmv_name" type="text"
                    value="{{ old('dmv_name', get_setting('dmv_name', 'Department of Motor Vehicles')) }}">
            </div>

            <div class="p-3">
                <p class="text-lg font-semibold">DMV Initials</p>
                <p>What you want the DMV to be initials in the Civilian Portal.</p>
                <input class="text-input" name="dmv_initials" type="text"
                    value="{{ old('dmv_initials', get_setting('dmv_initials', 'DMV')) }}">
            </div>

            <div class="p-3 flex justify-end">
                <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
            </div>
        </form>
    </div>
@endsection
