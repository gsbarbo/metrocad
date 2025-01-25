@extends('layouts.admin_settings')

@section('main')
    <div class="flex justify-between items-baseline">
        <h1 class="text-xl font-bold">Manage Roles > <span class="font-thin text-lg">Create Role</span></h1>
        <a class="text-red-600 hover:underline" href="{{ route('admin.settings.role.index') }}">
            Cancel
        </a>
    </div>
    <hr class="my-2">

    <form action="{{ route('admin.settings.role.store') }}" class="" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium leading-6 text-white" for="name">
                Name
            </label>
            <input autofocus class="text-input @error('name') !border-red-600 !border @enderror" id="name"
                name="name" placeholder="Admin" required type="text" value="{{ old('name') }}" />

            @error('name')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        @if (get_setting('feature_use_discord_roles'))
            <div class="mb-3">
                <label class="block mb-2 text-sm font-medium leading-6 text-white" for="discord_role_id">
                    Discord Role ID
                </label>
                <select class="text-input @error('discord_role_id') !border-red-600 !border @enderror" id="discord_role_id"
                    name="discord_role_id">
                    <option value="">Choose Role</option>
                    @foreach ($discord_roles as $id => $discord_role)
                        @if ($id != 0 && $discord_role->managed != true)
                            <option @selected(old('discord_auto_role_id', get_setting('discord_auto_role_id')) == $discord_role->id) value="{{ $discord_role->id }}">
                                {{ $discord_role->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('discord_role_id')
                    <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @endif
        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium leading-6 text-white" for="text">Permissions</label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                @forelse ($permissions as $permission)
                    <label class="inline-flex items-center cursor-pointer">
                        <input class="sr-only peer" name="permissions[]" type="checkbox" value="{{ $permission->id }}">
                        <div
                            class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                        </div>
                        <span
                            class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $permission->name }}</span>
                    </label>
                @empty
                    <p>No Permissions</p>
                @endforelse
            </div>
        </div>

        <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Create">

    </form>
@endsection
