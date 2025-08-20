@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Create Department" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.index') }}">Departments</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.create') }}">Create Department
        </x-breadcrumb-link>
    </x-breadcrumb>

    <form action="{{ route('admin.settings.departments.store') }}" class="space-y-4 max-w-3xl mx-auto"
          enctype="multipart/form-data"
          method="POST">
        @csrf
        <x-forms.input name="name" label="Department Name"></x-forms.input>
        <x-forms.input name="initials" label="Initials"></x-forms.input>
        <x-forms.select name="type" label="Department Type">
            <option value="">Choose one</option>
            @foreach(\App\Enum\DepartmentType::options() as $value => $label)
                <option @selected(old('type') == $value) value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.input name="image_url" label="Logo URL"></x-forms.input>


        @if (get_setting('discord.useRoles.useDepartmentRoles'))
            <x-forms.select name="discord_role_id" label="Discord Role">
                <option value="">Choose one</option>
                @foreach ($discordRoles as $id => $discordRole)
                    @if ($id != 0 && $discordRole->managed != true)
                        <option
                            @selected(old('discord_role_id') == $discordRole->id) value="{{ $discordRole->id }}">
                            {{ $discordRole->name }}</option>
                    @endif
                @endforeach
            </x-forms.select>
        @endif

        <x-forms.buttons name="Save" cancel-route="admin.settings.departments.index"></x-forms.buttons>
    </form>
@endsection
