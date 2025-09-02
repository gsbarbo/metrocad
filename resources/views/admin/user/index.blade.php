@extends('layouts.admin')

@section('main')
    <x-breadcrumb pageTitle="Users" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.user.index') }}">Users</x-breadcrumb-link>
    </x-breadcrumb>

    <div class="">

        @livewire('admin.member-search')

        {{--        <livewire:data-table--}}
        {{--            :model="\App\Models\User::class"--}}
        {{--            editRoute="admin.settings.licenseValues.edit"--}}
        {{--            :columns="[--}}
        {{--            'discord_name' => 'Name',--}}
        {{--            'id' => 'Discord ID',--}}
        {{--            'status' => 'Status',--}}
        {{--            ]"--}}
        {{--        />--}}

    </div>
@endsection
