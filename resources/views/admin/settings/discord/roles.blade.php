@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Discord Integration" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.discord.index') }}">Discord Integration</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.discord.roles') }}">Roles</x-breadcrumb-link>
    </x-breadcrumb>
    <div class="mb-10">
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
        <form action="{{ route('admin.settings.update') }}" id="mdeditor" method="POST">
            @csrf
            <div class="p-3 flex justify-between">
                <div>
                    <label class="label-dark" for="feature_use_discord_roles">
                        Use Discord Roles
                    </label>
                    <p class="form-help-text-dark">Manage CAD Roles with Discord Roles. It is best not to switch this a lot.
                        Pick one
                        and stick with it. Bugs may appear if you switch between using Discord roles and back to CAD roles.
                    </p>
                </div>
                <div class="ml-3">
                    <select class="!w-28 form-select-input-dark" id="feature_use_discord_roles"
                        name="feature_use_discord_roles">
                        <option @selected(old('feature_use_discord_roles', get_setting('feature_use_discord_roles', false)) == false) value="0">Off</option>
                        <option @selected(old('feature_use_discord_roles', get_setting('feature_use_discord_roles', false)) == true) value="1">On</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="btn bg-navbar text-white hover:opacity-85">Save</button>
            </div>
        </form>
    </div>

    @if (get_setting('feature_use_discord_roles'))
        <hr class="mt-5">
        <div class="">
            <form action="{{ route('admin.settings.update') }}" class="divide-y" method="POST">
                @csrf

                <div class="p-3">
                    <div class="flex justify-between">
                        <div>
                            <p class="label-dark">Discord Member Role</p>
                            <p class="form-help-text-dark">This will allow members immediate access to the CAD if they have
                                this role in your Discord
                                Server. If you do not want to use this feature leave the role as 'None'. If this is 'None'
                                you will have to approve members through the 'Staff > Approve Member' page.</p>
                        </div>
                    </div>

                    <select class="form-select-input-dark" id="discord_auto_role_id" name="discord_auto_role_id">
                        <option value="">-- Choose One --</option>
                        <option selected value="0">None</option>
                        @foreach ($discord_roles as $id => $discord_role)
                            @if ($id != 0 && $discord_role->managed != true)
                                <option @selected(old('discord_auto_role_id', get_setting('discord_auto_role_id')) == $discord_role->id) value="{{ $discord_role->id }}">
                                    {{ $discord_role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="p-3">
                    <div class="flex justify-between">
                        <div>
                            <p class="label-dark">Discord Suspend Role</p>
                            <p class="form-help-text-dark">This will suspend members from the CAD if they have this role in
                                your Discord server. If you
                                do not want to use this setting lave as 'None'.</p>
                        </div>
                    </div>

                    <select class="form-select-input-dark" id="discord_suspended_role_id" name="discord_suspended_role_id">
                        <option value="">-- Choose One --</option>
                        <option selected value="0">None</option>
                        @foreach ($discord_roles as $id => $discord_role)
                            @if ($id != 0 && $discord_role->managed != true)
                                <option @selected(old('discord_suspended_role_id', get_setting('discord_suspended_role_id')) == $discord_role->id) value="{{ $discord_role->id }}">
                                    {{ $discord_role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="p-3 flex justify-between">
                    <div>
                        <label class="label-dark" for="feature_use_discord_department_roles">
                            Use Discord Department Roles
                        </label>
                        <p class="form-help-text-dark">Allows members to set up their own Officer based on the roles in
                            Discord. They
                            will be able to go straight to creating an officer. Members will be able to control their own
                            Rank and Badge Number regardless of the setting on "General" page. Roles can be synced by
                            clicking "Sync Roles" or will auto update when a member goes into the CAD System.</p>
                    </div>
                    <div class="ml-3">
                        <select class="!w-28 form-select-input-dark" id="feature_use_discord_department_roles"
                            name="feature_use_discord_department_roles">
                            <option @selected(old('feature_use_discord_department_roles', get_setting('feature_use_discord_department_roles', false)) == false) value="0">Off</option>
                            <option @selected(old('feature_use_discord_department_roles', get_setting('feature_use_discord_department_roles', false)) == true) value="1">On</option>
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <input class="btn bg-navbar text-white hover:opacity-85 mt-3" type="submit" value="Save">
                </div>
            </form>
        </div>
    @endif

    {{-- <div class="pill p-3">
                <div class="flex justify-between items-center">
                    <div class="mr-3">
                        <p class="text-lg font-semibold">Use Discord Roles</p>
                        <p>Manage CAD Roles with Discord Roles. It is best not to switch this alot. Pick one and stick with
                            it. Bugs may appear if you switch between using Discord roles and back to CAD roles. <span
                                class="text-red-500">Discord Guild ID must be set.</span></p>
                    </div>
                    <select class="w-28 px-1 py-1 mt-2 text-black border rounded-md cursor-pointer focus:outline-none"
                        id="use_discord_roles" name="use_discord_roles">
                        <option @selected(old('use_discord_roles', get_setting('use_discord_roles')) == false) value="off">Off</option>
                        <option @selected(old('use_discord_roles', get_setting('use_discord_roles')) == true) value="on">On</option>
                    </select>
                </div>
            </div>

            <div class="pill p-3">
                <p class="text-lg font-semibold">Discord Auto Approve Role</p>
                <p>This will allow new members immediate access to Member if they have this role in your Discord Server. If
                    you do not want to use
                    Auto Role leave as 'None'. This only applies to new
                    members. <span class="text-red-500">Discord Guild ID must be set.</span></p>
                <select class="w-full p-1 mt-2 text-black border rounded-md focus:outline-none" id="discord_auto_role_id"
                    name="discord_auto_role_id">
                    <option value="">-- Choose One --</option>
                    <option selected value="0">None</option>
                    @foreach ($discord_roles as $id => $discord_role)
                        @if ($id != 0 && $discord_role->managed != true)
                            <option @selected(old('discord_auto_role_id', get_setting('discord_auto_role_id')) == $discord_role->id) value="{{ $discord_role->id }}">
                                {{ $discord_role->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="pill p-3">
                <div class="flex justify-between items-center">
                    <div class="mr-3">
                        <p class="text-lg font-semibold">Use Discord Department Roles</p>
                        <p>Allows members to set up thier own Officer based on the roles in Discord. They will be able to go
                            straight to creating an officer. Members will be able to control their own Rank and Badge Number
                            regardless of the setting on "General" page. Roles can be synced by clicking "Sync Roles" or
                            will auto update when a member goes into the CAD System. <span class="text-red-500">Discord
                                Guild ID must be
                                set.</span></p>
                    </div>
                    <select class="w-28 px-1 py-1 mt-2 text-black border rounded-md cursor-pointer focus:outline-none"
                        id="use_discord_department_roles" name="use_discord_department_roles">
                        <option @selected(old('use_discord_department_roles', get_setting('use_discord_department_roles', false)) == false) value="off">Off</option>
                        <option @selected(old('use_discord_department_roles', get_setting('use_discord_department_roles', false)) == true) value="on">On</option>
                    </select>
                </div>
            </div> --}}
@endsection
