@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="CAD/MDT/Officer Settings" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.cad') }}">CAD/MDT/Officer Settings</x-breadcrumb-link>
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
                        <p class="label-dark">Use 10 Codes</p>
                        <p class="form-help-text-dark">This will show the link to the 10 codes on the MDT/CAD.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="use_ten_codes" name="use_ten_codes">
                            <option @selected(old('use_ten_codes', get_setting('use_ten_codes')) == false) value="0">Off</option>
                            <option @selected(old('use_ten_codes', get_setting('use_ten_codes')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="">
                    <div>
                        <p class="label-dark">Officer Name Format</p>
                        <p class="form-help-text-dark">This forces a consistent format on officer names in the CAD/MDT. Name
                            will be used on Reports as
                            well.</p>
                    </div>

                    <div class="">
                        <select class="form-select-input-dark" id="officer_name_format" name="officer_name_format">
                            <option @selected(old('officer_name_format', get_setting('officer_name_format')) == 'F. Last') value="F. Last">F. Last</option>
                            <option @selected(old('officer_name_format', get_setting('officer_name_format')) == 'First Last') value="First Last">First Last</option>
                            <option @selected(old('officer_name_format', get_setting('officer_name_format')) == 'First L.') value="First L.">First L.</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <p class="label-dark">Area of Patrol</p>
                <p class="form-help-text-dark">Shows up in CAD and API for where your AOP is located.</p>
                <input class="form-text-input-dark" name="aop_location" type="text"
                    value="{{ old('aop_location', get_setting('aop_location')) }}">
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">Allow Officers To Control Their Own Unit Number</p>
                        <p class="form-help-text-dark">This allows members once accepted into a department or added via
                            Discord Department Roles to
                            update their own unit number.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="allow_members_to_update_number"
                            name="allow_members_to_update_number">
                            <option @selected(old('allow_members_to_update_number', get_setting('allow_members_to_update_number')) == false) value="0">Off</option>
                            <option @selected(old('allow_members_to_update_number', get_setting('allow_members_to_update_number')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">Allow officers to Control Their Own Department Rank</p>
                        <p class="form-help-text-dark">This allows members once accepted into a department or added via
                            Discord Department Roles to
                            update their own department rank. This doesn't affect any roles or permission in the CAD.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="allow_members_to_update_rank"
                            name="allow_members_to_update_rank">
                            <option @selected(old('allow_members_to_update_rank', get_setting('allow_members_to_update_rank')) == false) value="0">Off</option>
                            <option @selected(old('allow_members_to_update_rank', get_setting('allow_members_to_update_rank')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">Roleplay Suspended</p>
                        <p class="form-help-text-dark">This will show a banner that RP is suspended in the MDT and Civilian
                            portal.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="roleplay_suspended" name="roleplay_suspended">
                            <option @selected(old('roleplay_suspended', get_setting('roleplay_suspended')) == false) value="0">Off</option>
                            <option @selected(old('roleplay_suspended', get_setting('roleplay_suspended')) == true) value="1">On</option>
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
