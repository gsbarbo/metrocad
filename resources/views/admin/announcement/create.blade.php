@extends('layouts.admin')

@section('main')
    <x-breadcrumb pageTitle="Create Announcement" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.announcement.index') }}">Announcements</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.announcement.create') }}">Create</x-breadcrumb-link>
    </x-breadcrumb>

    <form action="{{ route('admin.announcement.store') }}" class="max-w-lg" method="POST">
        @csrf
        <div class="mb-3">
            <label class="label-dark" for="title">
                Title
            </label>
            <input autofocus class="form-text-input-dark @error('title') !border-red-600 !border @enderror" id="title"
                name="title" placeholder="Title of Announcement" required type="text" value="{{ old('title') }}" />

            @error('title')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="label-dark" for="department_id">
                Department
            </label>
            <select class="form-select-input-dark @error('department_id') !border-red-600 !border @enderror"
                id="department_id" name="department_id">
                <option value="">Community Wide</option>
                @foreach ($departments as $department)
                    <option @selected(old('department_id') == $department->id) disabled value="{{ $department->id }}">{{ $department->name }}
                    </option>
                @endforeach
            </select>
            <p class="form-help-text-dark">Only community wide announcements are available right now.</p>
            @error('department_id')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="label-dark" for="text">Text</label>
            <textarea class="form-textarea-dark markdown @error('text') !border-red-600 !border @enderror" id="text"
                name="text" placeholder="Announcement Text" required>{{ old('text') }}</textarea>
            @error('text')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
            <p class="form-help-text-dark">This textbox supports markdown.
                <a class="hover:underline"
                    href="https://metrocad.gitbook.io/docs/settings/basic-markdown-syntax-guide">Learn more.</a>
            </p>
        </div>

        <div class="flex justify-between items-center">
            <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Create">
            <a class="text-red-600 hover:underline" href="{{ route('admin.announcement.index') }}">Cancel</a>
        </div>
    </form>
@endsection
