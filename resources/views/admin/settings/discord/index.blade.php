@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Discord Integration" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.discord.index') }}">Discord Integration</x-breadcrumb-link>
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

    <div class="py-10">
        <form action="{{ route('admin.settings.discord.update_guild_id') }}" method="POST">

            @csrf
            <div class="mb-3 space-y-2">
                <label class="label-dark" for="discord_guild_id">
                    Discord Guild ID
                </label>
                <p class="form-help-text-dark">Discord Guild ID for the server used for Discord Integration. Only one server
                    ID
                    accepted. You can find
                    this by right clicking on your server icon and select "Copy server ID".</p>
                <input autofocus class="form-text-input-dark @error('discord_guild_id') !border-red-600 !border @enderror"
                    id="discord_guild_id" name="discord_guild_id" placeholder="123456..." required type="text"
                    value="{{ old('discord_guild_id', get_setting('discord_guild_id')) }}" />

                @error('discord_guild_id')
                    <p class="form-error-text">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
            </div>
        </form>
    </div>
@endsection
