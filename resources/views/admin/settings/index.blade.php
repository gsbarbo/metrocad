@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Settings" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
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
    <div class="" x-data="{activeTab: 1,
    activeTabStyle: 'inline-flex items-center justify-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg group',
    inActiveTabStyle: 'inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-300 hover:border-gray-300 group'
    }">
        <div class="border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                <li class="me-2">
                    <a href="#"
                       :class="activeTab === 1 ? activeTabStyle : inActiveTabStyle"
                       @click="activeTab = 1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor"
                             class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z"/>
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                        </svg>
                        General
                    </a>
                </li>
                <li class="me-2">
                    <a href="#"
                       :class="activeTab === 2 ? activeTabStyle : inActiveTabStyle"
                       @click="activeTab = 2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                        </svg>
                        Civilian
                    </a>
                </li>
                <li class="me-2">
                    <a href="#"
                       :class="activeTab === 3 ? activeTabStyle : inActiveTabStyle"
                       @click="activeTab = 3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor"
                             class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25"/>
                        </svg>
                        MDT/Workbench
                    </a>
                </li>
                <li class="me-2">
                    <a href="#"
                       :class="activeTab === 4 ? activeTabStyle : inActiveTabStyle"
                       @click="activeTab = 4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor"
                             class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5"/>
                        </svg>
                        Features
                    </a>
                </li>
                <li class="me-2">
                    <a href="#"
                       :class="activeTab === 5 ? activeTabStyle : inActiveTabStyle"
                       @click="activeTab = 5">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M4.5 12a7.5 7.5 0 0 0 15 0m-15 0a7.5 7.5 0 1 1 15 0m-15 0H3m16.5 0H21m-1.5 0H12m-8.457 3.077 1.41-.513m14.095-5.13 1.41-.513M5.106 17.785l1.15-.964m11.49-9.642 1.149-.964M7.501 19.795l.75-1.3m7.5-12.99.75-1.3m-6.063 16.658.26-1.477m2.605-14.772.26-1.477m0 17.726-.26-1.477M10.698 4.614l-.26-1.477M16.5 19.794l-.75-1.299M7.5 4.205 12 12m6.894 5.785-1.149-.964M6.256 7.178l-1.15-.964m15.352 8.864-1.41-.513M4.954 9.435l-1.41-.514M12.002 12l-3.75 6.495"/>
                        </svg>

                        Misc Settings
                    </a>
                </li>
            </ul>
        </div>

        <div class="mt-2" x-show="activeTab === 1">
            <h1 class="text-lg">General Settings</h1>
            <hr class="my-2">
            <form action="{{ route('admin.settings.update') }}" class="space-y-2" method="POST">
                @csrf

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Community Name</p>
                        <p class="form-help-text-dark">The name of your community.</p>
                    </div>
                    <input class="form-text-input-dark max-w-md" name="community.name" type="text"
                           value="{{ old('community.name', get_setting('community.name')) }}">
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Community Logo</p>
                        <p class="form-help-text-dark">URL of your community logo. Must be a Discord Link.</p>
                    </div>
                    <input class="form-text-input-dark max-w-xl" name="community.logo" type="text"
                           value="{{ old('community.logo', get_setting('community.logo')) }}">
                </div>

                <div class="bg-navbar p-3 rounded-lg">
                    <p class="label-dark">Community About Us</p>
                    <p class="form-help-text-dark">Text shown on the home page of the CAD.</p>
                    <textarea class="form-textarea-dark markdown" id="community.aboutUs" name="community.aboutUs">
                                {{ old('community.aboutUs', get_setting('community.aboutUs')) }}
                            </textarea>
                    <p class="form-help-text-dark">This textbox supports markdown.
                        <a class="hover:underline"
                           href="https://metrocad.gitbook.io/docs/settings/basic-markdown-syntax-guide">Learn more.</a>
                    </p>
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">State</p>
                        <p class="form-help-text-dark">This is the default values for your RP area. State refers to the
                            whole map.</p>
                    </div>
                    <input class="form-text-input-dark max-w-md" name="names.state" type="text"
                           value="{{ old('names.state', get_setting('names.state')) }}">
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">County</p>
                        <p class="form-help-text-dark">This is the default values for your RP area. County refers to
                            Lore Blaine County.</p>
                    </div>
                    <input class="form-text-input-dark max-w-md" name="names.county" type="text"
                           value="{{ old('names.county', get_setting('names.county')) }}">
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">City</p>
                        <p class="form-help-text-dark">This is the default values for your RP area. City refers to
                            Lore Los Santos.</p>
                    </div>
                    <input class="form-text-input-dark max-w-md" name="names.city" type="text"
                           value="{{ old('names.city', get_setting('names.city')) }}">
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Date Format</p>
                        <p class="form-help-text-dark">Date format to be used in the CAD.</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="general.dateFormat" name="general.dateFormat">
                        <option
                            @selected(old('general.dateFormat', get_setting('general.dateFormat')) == 'm/d/Y') value="m/d/Y">
                            mm/dd/YYYY
                        </option>
                        <option
                            @selected(old('general.dateFormat', get_setting('general.dateFormat')) == 'd/m/Y') value="d/m/Y">
                            dd/mm/YYYY
                        </option>
                    </select>
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Measurement Units</p>
                        <p class="form-help-text-dark">To use imperial or metric units.</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="general.measurementUnits"
                            name="general.measurementUnits">
                        <option
                            @selected(old('general.measurementUnits', get_setting('general.measurementUnits')) == 'imperial') value="imperial">
                            Imperial
                        </option>
                        <option
                            @selected(old('general.measurementUnits', get_setting('general.measurementUnits')) == 'metric') value="metric">
                            Metric
                        </option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <input class="btn btn-md btn-green btn-rounded" type="submit" value="Save">
                </div>
            </form>
        </div>

        <div class="mt-2" x-show="activeTab === 2">
            <h1 class="text-lg">Civilian Settings</h1>
            <hr class="my-2">
            <form action="{{ route('admin.settings.update') }}" class="space-y-2" method="POST">
                @csrf

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Allow Duplicate Civilian Names</p>
                        <p class="form-help-text-dark">Allows duplicate civilians with the same first and last name.</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="civilian.allowDuplicateCivilianNames"
                            name="civilian.allowDuplicateCivilianNames">
                        <option
                            @selected(old('civilian.allowDuplicateCivilianNames', get_setting('civilian.allowDuplicateCivilianNames')) == 'false') value="false">
                            False (No)
                        </option>
                        <option
                            @selected(old('civilian.allowDuplicateCivilianNames', get_setting('civilian.allowDuplicateCivilianNames')) == 'true') value="true">
                            True (Yes)
                        </option>
                    </select>
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Allow Duplicate Vehicle Plates</p>
                        <p class="form-help-text-dark">Allows vehicles to have the same plate number. Recommended to
                            keep at false (No).</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="civilian.allowDuplicateVehiclePlates"
                            name="civilian.allowDuplicateVehiclePlates">
                        <option
                            @selected(old('civilian.allowDuplicateVehiclePlates', get_setting('civilian.allowDuplicateVehiclePlates')) == 'false') value="false">
                            False (No)
                        </option>
                        <option
                            @selected(old('civilian.allowDuplicateVehiclePlates', get_setting('civilian.allowDuplicateVehiclePlates')) == 'true') value="true">
                            True (Yes)
                        </option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <input class="btn btn-md btn-green btn-rounded" type="submit" value="Save">
                </div>
            </form>
        </div>

        <div class="mt-2" x-show="activeTab === 3">
            <h1 class="text-lg">MDT/Workbench Settings</h1>
            <hr class="my-2">
            <form action="{{ route('admin.settings.update') }}" class="space-y-2" method="POST">
                @csrf

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Officer Name Format</p>
                        <p class="form-help-text-dark">How officer names should be displayed.</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="mdt.officerNameFormat"
                            name="mdt.officerNameFormat">
                        <option
                            @selected(old('officer_name_format', get_setting('mdt.officerNameFormat')) == '{f}. {last}') value="{f} {last}">
                            F. Last
                        </option>
                        <option
                            @selected(old('officer_name_format', get_setting('mdt.officerNameFormat')) == '{first} {last}') value="{first} {last}">
                            First Last
                        </option>
                        <option
                            @selected(old('officer_name_format', get_setting('mdt.officerNameFormat')) == '{first} {l}.') value="{first} {l}.">
                            First L.
                        </option>
                        <option
                            @selected(old('officer_name_format', get_setting('mdt.officerNameFormat')) == '{last}, {first}') value="{last}, {first}">
                            Last, First
                        </option>
                    </select>
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Active Unit Auto Off Duty</p>
                        <p class="form-help-text-dark">How many minutes since the last update an active unit should stay
                            on duty.</p>
                    </div>
                    <input class="form-text-input-dark max-w-xl" name="mdt.activeUnitTimeout" type="number"
                           value="{{ old('mdt.activeUnitTimeout', get_setting('mdt.activeUnitTimeout')) }}">
                </div>


                <div class="flex justify-end">
                    <input class="btn btn-md btn-green btn-rounded" type="submit" value="Save">
                </div>
            </form>
        </div>

        <div class="mt-2" x-show="activeTab === 4">
            <h1 class="text-lg">Features</h1>
            <hr class="my-2">
            <form action="{{ route('admin.settings.update') }}" class="space-y-2" method="POST">
                @csrf

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Force Steam Link</p>
                        <p class="form-help-text-dark">Forces members to link their Steam profiles to the CAD.</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="features.forceSteamLink"
                            name="features.forceSteamLink">
                        <option
                            @selected(old('features.forceSteamLink', get_setting('features.forceSteamLink')) == 'false') value="false">
                            False (No)
                        </option>
                        <option
                            @selected(old('features.forceSteamLink', get_setting('features.forceSteamLink')) == 'true') value="true">
                            True (Yes)
                        </option>
                    </select>
                </div>

                <div class="flex justify-end">
                    <input class="btn btn-md btn-green btn-rounded" type="submit" value="Save">
                </div>
            </form>
        </div>

        <div class="mt-2" x-show="activeTab === 5">
            <h1 class="text-lg">Misc Settings</h1>
            <hr class="my-2">
            <form action="{{ route('admin.settings.update') }}" class="space-y-2" method="POST">
                @csrf

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Area of Patrol</p>
                        <p class="form-help-text-dark">Area of Patrol.</p>
                    </div>
                    <input class="form-text-input-dark max-w-md" name="roleplay.areaOfPatrol" type="text"
                           value="{{ old('roleplay.areaOfPatrol', get_setting('roleplay.areaOfPatrol')) }}">
                </div>

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Suspend Roleplay</p>
                        <p class="form-help-text-dark">Shows banners on MDT and Civilian that roleplay is suspended.</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="roleplay.isSuspended"
                            name="roleplay.isSuspended">
                        <option
                            @selected(old('roleplay.isSuspended', get_setting('roleplay.isSuspended')) == 'false') value="false">
                            False (No)
                        </option>
                        <option
                            @selected(old('roleplay.isSuspended', get_setting('roleplay.isSuspended')) == 'true') value="true">
                            True (Yes)
                        </option>
                    </select>
                </div>


                <div class="flex justify-end">
                    <input class="btn btn-md btn-green btn-rounded" type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
@endsection
