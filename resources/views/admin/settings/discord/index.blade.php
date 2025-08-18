@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Discord Integration" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.discord.index') }}">Discord Integration</x-breadcrumb-link>
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
                             stroke="currentColor" class="size-4 me-2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.25 14.25h13.5m-13.5 0a3 3 0 0 1-3-3m3 3a3 3 0 1 0 0 6h13.5a3 3 0 1 0 0-6m-16.5-3a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3m-19.5 0a4.5 4.5 0 0 1 .9-2.7L5.737 5.1a3.375 3.375 0 0 1 2.7-1.35h7.126c1.062 0 2.062.5 2.7 1.35l2.587 3.45a4.5 4.5 0 0 1 .9 2.7m0 0a3 3 0 0 1-3 3m0 3h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Zm-3 6h.008v.008h-.008v-.008Zm0-6h.008v.008h-.008v-.008Z"/>
                        </svg>
                        Server ID
                    </a>
                </li>
                @if(get_setting('discord.guildId'))
                    <li class="me-2">
                        <a href="#"
                           :class="activeTab === 2 ? activeTabStyle : inActiveTabStyle"
                           @click="activeTab = 2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4 me-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/>
                            </svg>
                            Discord Roles
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
                            Audit Log
                        </a>
                    </li>
                @endif
            </ul>
        </div>

        <div class="mt-2" x-show="activeTab === 1">
            <h1 class="text-lg">Server ID</h1>
            <hr class="my-2">
            <form action="{{ route('admin.settings.discord.update_guild_id') }}" method="POST" class="space-y-2">
                @csrf

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Server ID</p>
                        <p class="form-help-text-dark">Discord Guild ID for the server used for Discord Integration.
                            Only one
                            server ID accepted. You can find this by right clicking on your server icon and select "Copy
                            server
                            ID".</p>
                    </div>
                    <input autofocus
                           class="form-text-input-dark max-w-sm"
                           id="discord.guildId" name="discord.guildId" placeholder="123456..." required type="number"
                           value="{{ old('discord.guildId', get_setting('discord.guildId')) }}"/>
                </div>

                <div class="flex justify-end">
                    <input class="btn btn-md btn-green btn-rounded" type="submit" value="Save">
                </div>
            </form>
        </div>

        <div class="mt-2" x-show="activeTab === 2">
            <h1 class="text-lg">Discord Roles</h1>
            <hr class="my-2">

            <form action="{{ route('admin.settings.update') }}" class="space-y-2" method="POST">
                @csrf

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Use Discord Roles For CAD Roles</p>
                        <p class="form-help-text-dark">Manage CAD Roles with Discord Roles. It is best not to switch
                            this a lot. Pick one and stick with it. Bugs may appear if you switch between using Discord
                            roles and back to CAD roles.</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="discord.useRoles"
                            name="discord.useRoles">
                        <option
                            @selected(old('discord.useRoles', get_setting('discord.useRoles')) == 'false') value="false">
                            False (No)
                        </option>
                        <option
                            @selected(old('discord.useRoles', get_setting('discord.useRoles')) == 'true') value="true">
                            True (Yes)
                        </option>
                    </select>
                </div>

                @if(get_setting('discord.useRoles'))
                    <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                        <div>
                            <p class="label-dark">Auto Member Role</p>
                            <p class="form-help-text-dark">This will allow members immediate access to the CAD if they
                                have this role in your Discord Server. If you do not want to use this feature leave the
                                role as 'None'. If this is 'None' you will have to approve members through the 'Admin >
                                Users' page.</p>
                        </div>
                        <select class="form-select-input-dark max-w-sm" id="discord.useRoles.memberRoleId"
                                name="discord.useRoles.memberRoleId">
                            <option
                                @selected(old('discord.useRoles.memberRoleId', get_setting('discord.useRoles.memberRoleId')) == '0') value="0">
                                None
                            </option>
                            @foreach($serverRoles as $role)
                                <option
                                    @selected(old('discord.useRoles.memberRoleId', get_setting('discord.useRoles.memberRoleId')) == $role->id) value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>

                    <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                        <div>
                            <p class="label-dark">Suspend Member Role</p>
                            <p class="form-help-text-dark">This will suspend members from the CAD if they have this role
                                in your Discord server. If you do not want to use this setting lave as 'None'.</p>
                        </div>
                        <select class="form-select-input-dark max-w-sm" id="discord.useRoles.suspendedRoleId"
                                name="discord.useRoles.suspendedRoleId">
                            <option
                                @selected(old('discord.useRoles.suspendedRoleId', get_setting('discord.useRoles.suspendedRoleId')) == '0') value="0">
                                None
                            </option>
                            @foreach($serverRoles as $role)
                                <option
                                    @selected(old('discord.useRoles.suspendedRoleId', get_setting('discord.useRoles.suspendedRoleId')) == $role->id) value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                @endif

                <hr class="my-2">

                <div class="bg-navbar p-3 rounded-lg md:flex md:justify-between">
                    <div>
                        <p class="label-dark">Use Discord Roles For Department Access</p>
                        <p class="form-help-text-dark">Allows members to set up their own Officer based on the roles in
                            Discord. They will be able to go straight to creating an officer. Members will be able to
                            control their own Rank and Badge Number regardless of the setting on "General" page. Roles
                            can be synced by clicking "Sync Roles" or will auto update when a member goes into the CAD
                            System.</p>
                    </div>
                    <select class="form-select-input-dark max-w-sm" id="discord.useRoles.useDepartmentRoles"
                            name="discord.useRoles.useDepartmentRoles">
                        <option
                            @selected(old('discord.useRoles.useDepartmentRoles', get_setting('discord.useRoles.useDepartmentRoles')) == 'false') value="false">
                            False (No)
                        </option>
                        <option
                            @selected(old('discord.useRoles.useDepartmentRoles', get_setting('discord.useRoles.useDepartmentRoles')) == 'true') value="true">
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
            <h1 class="text-lg">Audit Log</h1>
            <hr class="my-2">
            
        </div>

    </div>
@endsection
