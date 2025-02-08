@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="API Settings" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.general') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.api_key') }}">API Settings</x-breadcrumb-link>
    </x-breadcrumb>
    <div>
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
        <div class="py-3">
            <p class="mb-3">If you do not have an API key below you must generate it. This needs to be kept private. You
                can regenerate it any time by clicking on the button below. Only owners can view/reset the API Key.</p>
        </div>
        <form action="{{ route('admin.settings.update') }}" id="mdeditor" method="POST">
            @csrf
            <div class="py-3">
                <p class="text-lg font-semibold">API Key</p>
                <p></p>
                <input class="form-text-input-dark bg-slate-500" name="api_key" readonly type="text"
                    value="{{ old('api_key', get_setting('api_key')) }}">
            </div>
        </form>
        <a class="primary-btn" href="{{ route('admin.settings.generate_api_key') }}">Generate/Regenerate API Key</a>
    </div>
@endsection
