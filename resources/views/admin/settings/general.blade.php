@extends('layouts.admin_settings')

@section('main')
    <header class="w-full my-3">
        <h1 class="text-2xl font-bold text-white">General Settings</h1>
        <p class="text-sm"><a class="flex text-sm items-center text-blue-600 underline"
                href="https://communitycad.app/docs/settings-page">Learn More
                <svg class="w-4 h-4 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </a></p>
    </header>
    <div class="">
        <form action="{{ route('admin.settings.update') }}" class="divide-y" id="mdeditor" method="POST">
            @csrf
            <div class="p-3">
                <p class="text-lg font-semibold">Community Name</p>
                <p>The name of your community.</p>
                <input class="text-input" name="community_name" type="text"
                    value="{{ old('community_name', get_setting('community_name')) }}">
            </div>

            <div class="p-3">
                <p class="text-lg font-semibold">Community Intro</p>
                <p>Text shown on the home page of the CAD. Basically a small
                    about us section.</p>
                <div>
                    <div class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm" id="editor">
                    </div>
                    <input id="mdcontent" name="community_intro" type="hidden"
                        value="{{ get_setting('community_intro') }}">
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="text-lg font-semibold">State</p>
                        <p>This is the default values for your RP area. State refers to the whole map.</p>
                    </div>
                </div>

                <input class="text-input" name="state" type="text" value="{{ old('state', get_setting('state')) }}">
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="text-lg font-semibold">County</p>
                        <p>This is the default values for your RP area. County refers to Lore Blaine County.</p>
                    </div>
                </div>

                <input class="text-input" name="county" type="text" value="{{ old('county', get_setting('county')) }}">
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="text-lg font-semibold">City</p>
                        <p>This is the default values for your RP area. City refers to Lore Los Santos.</p>
                    </div>
                </div>

                <input class="text-input" name="city" type="text" value="{{ old('city', get_setting('city')) }}">
            </div>

            <div class="p-3">
                <div class="">
                    <div>
                        <p class="text-lg font-semibold">Date Format</p>
                        <p>Date format to be used in the CAD.</p>
                    </div>

                    <div class="">
                        <select class="select-input" id="date_format" name="date_format">
                            <option @selected(old('date_format', get_setting('date_format')) == 'm/d/Y') value="m/d/Y">mm/dd/YYYY</option>
                            <option @selected(old('date_format', get_setting('date_format')) == 'd/m/Y') value="d/m/Y">dd/mm/YYYY</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="text-lg font-semibold">Force Steam Link</p>
                        <p>Forces users to link their Steam account while creating their account the first time.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 select-input" id="force_steam_link" name="force_steam_link">
                            <option @selected(old('force_steam_link', get_setting('force_steam_link')) == false) value="0">Off</option>
                            <option @selected(old('force_steam_link', get_setting('force_steam_link')) == true) value="1">On</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
            </div>
        </form>

        <hr class="mt-5">
        <div class="space-y-3">

            @livewire('admin.settings.upload-picture', [
                'title' => 'Community Logo',
                'help_text' => 'Logo for your community. Please only click save one time.',
                'setting_name' => 'community_logo',
            ])

        </div>
    </div>
@endsection
