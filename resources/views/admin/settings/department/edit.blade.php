@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Edit {{$department->name}}" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.index') }}">Departments</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.departments.create') }}">Edit Department
        </x-breadcrumb-link>
    </x-breadcrumb>

    <div class="max-w-3xl mx-auto space-y-4">

        <form action="{{ route('admin.settings.departments.update', $department->slug) }}"
              class="space-y-4"
              method="POST">
            @csrf
            @method('PUT')
            <x-forms.input name="name" label="Department Name">{{$department->name}}</x-forms.input>
            <x-forms.input name="initials" label="Initials">{{$department->initials}}</x-forms.input>
            <x-forms.select name="type" label="Department Type">
                <option value="">Choose one</option>
                @foreach(\App\Enum\DepartmentType::options() as $value => $label)
                    <option
                        @selected(old('type', $department->type) == $value) value="{{ $value }}">{{ $label }}</option>
                @endforeach
            </x-forms.select>

            <x-forms.input name="image_url" label="Logo URL" type="url">{{$department->logo}}</x-forms.input>


            @if (get_setting('discord.useRoles.useDepartmentRoles'))
                <x-forms.select name="discord_role_id" label="Discord Role">
                    <option value="">Choose one</option>
                    @foreach ($discordRoles as $id => $discordRole)
                        @if ($id != 0 && $discordRole->managed != true)
                            <option
                                @selected(old('discord_role_id', $department->discord_role_id) == $discordRole->id) value="{{ $discordRole->id }}">
                                {{ $discordRole->name }}</option>
                        @endif
                    @endforeach
                </x-forms.select>
            @endif

            <x-forms.buttons name="Save" cancel-route="admin.settings.departments.index"></x-forms.buttons>
        </form>

        <x-forms.danger-area
            confirm="{{$department->name}}"
            route="admin.settings.departments.destroy"
            id="{{$department->slug}}"
            cancel-route="admin.settings.departments.index">
            <li>Officers assigned to this department</li>
            <li>A lot of bad things. Do not delete unless you just made this department or on a new install.</li>

        </x-forms.danger-area>
    </div>

@endsection
