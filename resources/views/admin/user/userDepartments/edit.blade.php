@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="{{ $user->name }} - Edit Department" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.user.index') }}">Users</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.user.show', $user->id) }}">User
            - {{ $user->name }}</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.user.userDepartments.index', $user->id) }}">Manage
            Departments
        </x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.user.userDepartments.index', $user->id) }}">Edit
            Department
        </x-breadcrumb-link>
    </x-breadcrumb>

    <div class="max-w-3xl mx-auto">
        <form
            action="{{ route('admin.user.userDepartments.update', ['userDepartment' => $userDepartment->id, 'user' => $user->id]) }}"
            class="space-y-3" method="POST">
            @csrf
            @method('PUT')

            <div class="border-indigo-800 hover:bg-sidebar border-4 p-2 rounded-lg text-center">
                <div class="flex items-center justify-between ml-3 text-white">
                    <div class="flex items-center">
                        <img alt="" class="w-20 h-20 mr-4" src="{{ $userDepartment->department->logo }}">
                        <div class="flex">
                            <div>
                                <p>{{ $userDepartment->department->name }}</p>
                                <p class="-mt-1 text-xs">{{ $userDepartment->rank }}</p>
                            </div>
                        </div>
                    </div>
                    <div>
                        {{ $userDepartment->badge_number }}
                    </div>
                </div>
            </div>

            {{--            <div>--}}
            {{--                <label class="label-dark" for="badge_number">Call Sign/Badge Number<span--}}
            {{--                        class="text-red-600">*</span></label>--}}
            {{--                <input class="form-text-input-dark" name="badge_number" required type="text"--}}
            {{--                    value="{{ old('badge_number', $userDepartment->badge_number) }}">--}}
            {{--                @error('badge_number')--}}
            {{--                    <p class="text-red-600">{{ $message }}</p>--}}
            {{--                @enderror--}}
            {{--            </div>--}}

            {{--            <div>--}}
            {{--                <label class="label-dark" for="rank">Rank<span class="text-red-600">*</span></label>--}}
            {{--                <input class="form-text-input-dark" name="rank" required type="text"--}}
            {{--                    value="{{ old('rank', $userDepartment->rank) }}">--}}
            {{--                @error('rank')--}}
            {{--                    <p class="text-red-600">{{ $message }}</p>--}}
            {{--                @enderror--}}
            {{--            </div>--}}

            <div>
                <button class="btn btn-green btn-rounded btn-md" type="submit">Save</button>
            </div>
        </form>

        <div class="border-red-600 border-2 p-3 mt-5">
            <h3 class="text-red-600 text-lg font-bold">Danger Zone</h3>
            <p class="">Deleting the users department will delete the following information that can <span
                    class="font-bold text-red-600">NOT</span> be recovered:</p>
            <ul class="list-inside list-disc ml-5">
                <li>Patrol Statistics</li>
                <li></li>
            </ul>
            <p>Are you sure you wish to continue?</p>
            <form
                action="{{ route('admin.user.userDepartments.destroy', ['userDepartment' => $userDepartment->id, 'user' => $user->id]) }}"
                class="mt-5 block space-y-3" method="POST">
                @csrf
                @method('delete')

                <div>
                    <label class="label-dark" for="confirm">Please type
                        ({{ $userDepartment->id }}) to confirm</label>
                    <input class="form-text-input-dark" name="confirm" type="text" value="">
                    @error('confirm')
                    <p class="text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <input class="btn btn-md btn-red btn-rounded" type="submit" value="Delete">
            </form>
        </div>

    </div>
@endsection
