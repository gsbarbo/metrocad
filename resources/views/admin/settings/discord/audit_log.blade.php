@extends('layouts.admin_settings')

@section('main')
    <header class="w-full my-3">
        <h1 class="text-2xl font-bold text-white">Discord Audit Log Settings</h1>
        <p class="text-sm"><a class="flex text-sm items-center text-blue-600 underline"
                              href="https://communitycad.app/docs/settings-page">Learn More
                <svg class="w-4 h-4 ml-2" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"
                        stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </a></p>
    </header>
    <div class="">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            <div class="p-3 flex justify-between">
                <div class="">
                    <label class="text-lg font-semibold" for="feature_use_discord_audit_log">
                        Use Discord Audit Logs
                    </label>
                    <p class="text-sm">Allows you to log user actions in Discord.</p>
                    @error('discord_guild_id')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="ml-3">
                    <select class="w-28 select-input" id="feature_use_discord_audit_log"
                            name="feature_use_discord_audit_log">
                        <option
                            @selected(old('feature_use_discord_audit_log', get_setting('discord.useAuditLog')) == false) value="off">
                            Off
                        </option>
                        <option
                            @selected(old('feature_use_discord_audit_log', get_setting('discord.useAuditLog')) == true) value="on">
                            On
                        </option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end">
                <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
            </div>
        </form>
    </div>

    @if (get_setting('feature_use_discord_audit_log'))
        <div class="">
            <form action="{{ route('admin.settings.discord.update_channels') }}" method="POST">
                @csrf
                @foreach ($discord_channels as $channel)
                    <div class="mb-3 space-y-2">
                        <label class="block text-base font-medium leading-6 text-white" for="{{ $channel->name }}">
                            {{ $channel->name }}
                        </label>
                        <p class="text-sm">{{ $channel->description }}</p>
                        <select class="select-input @error($channel->name) !border-red-600 !border @enderror"
                                id="{{ $channel->name }}" name="{{ $channel->name }}">
                            <option value="">Choose one</option>
                            @foreach ($channel_choices as $id => $name)
                                <option @selected($id == $channel->channel_id) value="{{ $id }}">{{ $name }}
                                </option>
                            @endforeach
                        </select>

                        @error($channel->name)
                        <p class="text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
                <div class="flex justify-end">
                    <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">
                </div>
            </form>
        </div>
    @endif
@endsection
