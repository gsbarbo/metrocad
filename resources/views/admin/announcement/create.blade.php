@extends('layouts.admin')

@section('main')
    <div class="flex justify-between items-baseline">
        <h1 class="text-xl font-bold">Manage Announcements > <span class="font-thin text-lg">Create Announcement</span></h1>
        <a class="text-red-600 hover:underline" href="{{ route('admin.announcement.index') }}">
            Cancel
        </a>
    </div>
    <hr class="my-2">

    <form action="{{ route('admin.announcement.store') }}" class="" method="POST">
        @csrf
        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium leading-6 text-white" for="title">
                Title
            </label>
            <input autofocus class="text-input @error('title') !border-red-600 !border @enderror" id="title"
                name="title" placeholder="Title of Announcement" required type="text" value="{{ old('title') }}" />

            @error('title')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium leading-6 text-white" for="department_id">
                Department
            </label>
            <select class="text-input @error('department_id') !border-red-600 !border @enderror" id="department_id"
                name="department_id">
                <option value="">Community Wide</option>
                @foreach ($departments as $department)
                    <option @selected(old('department_id') == $department->id) value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            @error('department_id')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label class="block mb-2 text-sm font-medium leading-6 text-white" for="text">Text</label>
            <textarea class="textarea-input @error('text') !border-red-600 !border @enderror" id="text" name="text"
                placeholder="test" required>{{ old('text') }}</textarea>
            @error('text')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <input class="btn bg-navbar text-white hover:opacity-85" type="submit" value="Create">

    </form>
@endsection
