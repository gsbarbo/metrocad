@extends('layouts.admin_settings')

@section('main')
    <div class="flex justify-between items-baseline">
        <h1 class="text-xl font-bold">Manage Departments > <span
                class="font-thin text-lg">Edit {{ $department->name }}</span>
        </h1>
        <a class="text-red-600 hover:underline" href="{{ route('admin.settings.departments.index') }}">
            Cancel
        </a>
    </div>

    <form action="{{ route('admin.settings.departments.update', $department->slug) }}" class="divide-y"
          enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
        <div class="p-3">
            <label class="label-dark" for="name">
                Name
            </label>
            <input autofocus class="form-text-input-dark @error('name') !border-red-600 !border @enderror" id="name"
                   name="name" placeholder="" required type="text" value="{{ old('name', $department->name) }}"/>

            @error('name')
            <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-3">
            <label class="label-dark" for="initials">
                Initials
            </label>
            <input autofocus class="form-text-input-dark @error('initials') !border-red-600 !border @enderror"
                   id="initials" name="initials" placeholder="" required type="text"
                   value="{{ old('initials', $department->initials) }}"/>

            @error('initials')
            <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="p-3">
            <label class="label-dark" for="type">
                Department Type
            </label>

            <select class="form-select-input-dark" id="type" name="type">
                <option value="">Choose one</option>
                <option @selected(old('type', $department->type) == 1) value="1">Law Enforcement</option>
                <option @selected(old('type', $department->type) == 2) value="2">Dispatch</option>
                <option @selected(old('type', $department->type) == 3) value="3">Civilian</option>
                <option @selected(old('type', $department->type) == 4) value="4">Fire/EMS</option>
                <option @selected(old('type', $department->type) == 5) value="5">Other In-game</option>
                <option @selected(old('type', $department->type) == 6) value="6">Out of Game</option>
            </select>

            @error('type')
            <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        @livewire('admin.settings.upload-department-picture', [
            'title' => 'Logo',
            'default_image' => $department->logo,
        ])

        @if (get_setting('discord.useRoles.useDepartmentRoles'))
            <div class="p-3">
                <label class="label-dark" for="discord_role_id">
                    Discord Role
                </label>
                <select class="form-text-input-dark @error('discord_role_id') !border-red-600 !border @enderror"
                        id="discord_role_id" name="discord_role_id">
                    <option value="">Choose Role</option>
                    @foreach ($discord_roles as $id => $discord_role)
                        @if ($id != 0 && $discord_role->managed != true)
                            <option
                                @selected(old('discord_role_id', $department->discord_role_id) == $discord_role->id) value="{{ $discord_role->id }}">
                                {{ $discord_role->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('discord_role_id')
                <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif

        <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Save">

    </form>

    <form action="{{ route('admin.settings.departments.destroy', $department->slug) }}" class="text-right" method="POST"
          onsubmit="return confirm('Are you sure you wish to delete this department? This can\'t be undone and will delete everything associated with this department!');">
        @csrf
        @method('DELETE')
        <button class="text-red-600 hover:underline">
            Delete
        </button>
    </form>
@endsection
