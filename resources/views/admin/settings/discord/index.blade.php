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
    <div class="card">
        <form action="{{ route('admin.settings.discord.update_guild_id') }}" method="POST">

            @csrf
            <div class="mb-3 space-y-2">
                <label class="block text-sm font-medium leading-6 text-white" for="discord_guild_id">
                    Discord Guild ID
                </label>
                <p class="text-xs">Discord Guild ID for the server used for Discord Integration. Only one server ID
                    accepted. You can find
                    this by right clicking on your server icon and select "Copy server ID"</p>
                <input autofocus class="text-input @error('discord_guild_id') !border-red-600 !border @enderror"
                    id="discord_guild_id" name="discord_guild_id" placeholder="123456..." required type="text"
                    value="{{ old('discord_guild_id', get_setting('discord_guild_id')) }}" />

                @error('discord_guild_id')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
            </div>
        </form>
    </div>
@endsection
