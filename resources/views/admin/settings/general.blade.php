@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="General Settings" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">General Settings</x-breadcrumb-link>
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
                <p class="label-dark">Community Name</p>
                <p class="form-help-text-dark">The name of your community.</p>
                <input class="form-text-input-dark" name="community_name" type="text"
                    value="{{ old('community_name', get_setting('community_name')) }}">
            </div>

            <div class="p-3">
                <p class="label-dark">Community Intro</p>
                <p class="form-help-text-dark">Text shown on the home page of the CAD. Basically a small
                    about us section.</p>
                <textarea class="form-textarea-dark markdown" id="community_intro" name="community_intro">
                    {{ old('community_intro', get_setting('community_intro')) }}
                </textarea>
                <p class="form-help-text-dark">This textbox supports markdown.
                    <a class="hover:underline"
                        href="https://metrocad.gitbook.io/docs/settings/basic-markdown-syntax-guide">Learn more.</a>
                </p>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">State</p>
                        <p class="form-help-text-dark">This is the default values for your RP area. State refers to the
                            whole map.</p>
                    </div>
                </div>

                <input class="form-text-input-dark" name="state" type="text"
                    value="{{ old('state', get_setting('state')) }}">
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">County</p>
                        <p class="form-help-text-dark">This is the default values for your RP area. County refers to Lore
                            Blaine County.</p>
                    </div>
                </div>

                <input class="form-text-input-dark" name="county" type="text"
                    value="{{ old('county', get_setting('county')) }}">
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">City</p>
                        <p class="form-help-text-dark">This is the default values for your RP area. City refers to Lore Los
                            Santos.</p>
                    </div>
                </div>

                <input class="form-text-input-dark" name="city" type="text"
                    value="{{ old('city', get_setting('city')) }}">
            </div>

            <div class="p-3">
                <div class="">
                    <div>
                        <p class="label-dark">Date Format</p>
                        <p class="form-help-text-dark">Date format to be used in the CAD.</p>
                    </div>

                    <div class="">
                        <select class="form-select-input-dark" id="date_format" name="date_format">
                            <option @selected(old('date_format', get_setting('date_format')) == 'm/d/Y') value="m/d/Y">mm/dd/YYYY</option>
                            <option @selected(old('date_format', get_setting('date_format')) == 'd/m/Y') value="d/m/Y">dd/mm/YYYY</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="p-3">
                <div class="flex justify-between">
                    <div>
                        <p class="label-dark">Force Steam Link</p>
                        <p class="form-help-text-dark">Forces users to link their Steam account while creating their account
                            the first time.</p>
                    </div>

                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="force_steam_link" name="force_steam_link">
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
