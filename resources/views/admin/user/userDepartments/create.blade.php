@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="{{ $user->name }} - Add Department" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.user.index') }}">Users</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.user.show', $user->id) }}">User
            - {{ $user->name }}</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.user.userDepartments.index', $user->id) }}">Manage
            Departments
        </x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.user.userDepartments.index', $user->id) }}">Add
            Department
        </x-breadcrumb-link>
    </x-breadcrumb>

    <div class="max-w-3xl mx-auto">
        <form action="{{ route('admin.user.userDepartments.store', $user->id) }}" class="space-y-3" method="POST">
            @csrf

            <div>
                <label class="label-dark" for="department_id">Department<span class="text-red-600">*</span></label>
                <select class="form-select-input-dark" id="department_id" name="department_id">
                    @foreach ($allDepartments as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach
                </select>
                @error('department_id')
                <p class="text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{--            <div>--}}
            {{--                <label class="label-dark" for="badge_number">Call Sign/Badge Number<span--}}
            {{--                        class="text-red-600">*</span></label>--}}
            {{--                <input class="form-text-input-dark" name="badge_number" required type="text"--}}
            {{--                    value="{{ old('badge_number') }}">--}}
            {{--                @error('badge_number')--}}
            {{--                    <p class="text-red-600">{{ $message }}</p>--}}
            {{--                @enderror--}}
            {{--            </div>--}}

            {{--            <div>--}}
            {{--                <label class="label-dark" for="rank">Rank<span class="text-red-600">*</span></label>--}}
            {{--                <input class="form-text-input-dark" name="rank" required type="text" value="{{ old('rank') }}">--}}
            {{--                @error('rank')--}}
            {{--                    <p class="text-red-600">{{ $message }}</p>--}}
            {{--                @enderror--}}
            {{--            </div>--}}

            <div>
                <button class="btn btn-green btn-rounded btn-md" name="action" type="submit"
                        value="create">Create
                </button>
            </div>
        </form>
    </div>
@endsection
