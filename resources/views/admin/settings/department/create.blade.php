@extends('layouts.admin_settings')

@section('main')
    <div class="flex justify-between items-baseline">
        <h1 class="text-xl font-bold">Manage Departments > <span class="font-thin text-lg">Create Department</span></h1>
        <a class="text-red-600 hover:underline" href="{{ route('admin.settings.departments.index') }}">
            Cancel
        </a>
    </div>

    <form action="{{ route('admin.settings.departments.store') }}" class="divide-y" enctype="multipart/form-data"
        method="POST">
        @csrf
        <div class="p-3">
            <label class="text-lg font-semibold" for="name">
                Name
            </label>
            <input autofocus class="text-input @error('name') !border-red-600 !border @enderror" id="name"
                name="name" placeholder="" required type="text" value="{{ old('name') }}" />

            @error('name')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-3">
            <label class="text-lg font-semibold" for="initials">
                Initials
            </label>
            <input autofocus class="text-input @error('initials') !border-red-600 !border @enderror" id="initials"
                name="initials" placeholder="" required type="text" value="{{ old('initials') }}" />

            @error('initials')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-3">
            <label class="text-lg font-semibold" for="type">
                Department Type
            </label>

            <select class="select-input" id="type" name="type">
                <option value="">Choose one</option>
                <option @selected(old('type') == 1) value="1">Law Enforcement</option>
                <option @selected(old('type') == 2) value="2">Dispatch</option>
                <option @selected(old('type') == 3) value="3">Civilian</option>
                <option @selected(old('type') == 4) value="4">Fire/EMS</option>
                <option @selected(old('type') == 5) value="5">Other In-game</option>
                <option @selected(old('type') == 6) value="6">Out of Game</option>
            </select>

            @error('type')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        @livewire('admin.settings.upload-department-picture', [
            'title' => 'Logo',
        ])

        @if (get_setting('feature_use_discord_department_roles'))
            <div class="p-3">
                <label class="text-lg font-semibold" for="discord_role_id">
                    Discord Role
                </label>
                <select class="text-input @error('discord_role_id') !border-red-600 !border @enderror" id="discord_role_id"
                    name="discord_role_id">
                    <option value="">Choose Role</option>
                    @foreach ($discord_roles as $id => $discord_role)
                        @if ($id != 0 && $discord_role->managed != true)
                            <option @selected(old('discord_role_id', get_setting('discord_role_id')) == $discord_role->id) value="{{ $discord_role->id }}">
                                {{ $discord_role->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('discord_role_id')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Create">

    </form>
@endsection
