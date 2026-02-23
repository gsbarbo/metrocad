@extends('layouts.admin_settings')

@section('main')
    <x-breadcrumb pageTitle="Create Penal Code" route="{{ route('admin.dashboard') }}">
        <x-breadcrumb-link route="{{ route('admin.settings.index') }}">Settings</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.penalCode.index') }}">Values - Penal Codes
        </x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('admin.settings.penalCode.create') }}">Create Penal Code
        </x-breadcrumb-link>
    </x-breadcrumb>

    <form action="{{ route('admin.settings.penalCode.store') }}" class="space-y-4 max-w-3xl mx-auto"
          enctype="multipart/form-data"
          method="POST">
        @csrf
        <x-forms.input name="title_number" required></x-forms.input>
        <x-forms.input name="section_number" required></x-forms.input>
        <x-forms.input name="code" required></x-forms.input>
        <x-forms.input name="code_title" label="Title" required></x-forms.input>
        <x-forms.textarea name="code_description" label="Description" required></x-forms.textarea>

        <x-forms.select name="type" label="Code Type" required>
            <option value="">Choose one</option>
            @foreach(\App\Enum\PenalCodeType::toArray() as $value => $label)
                <option @selected(old('type') == $value) value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.select name="category" label="Code Category" required>
            <option value="">Choose one</option>
            @foreach(\App\Enum\PenalCodeCategory::toArray() as $value => $label)
                <option @selected(old('type') == $value) value="{{ $value }}">{{ $label }}</option>
            @endforeach
        </x-forms.select>

        <x-forms.select name="is_active" label="Active" help="Can this code be assigned in new tickets?"
                        required>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </x-forms.select>
        <x-forms.input type="number" name="fine"
                       help="This needs to be whole number. If you want '$100' then type '100'."
        ></x-forms.input>
        <x-forms.input type="number" name="bail"
                       help="This needs to be whole number. If you want '$100' then type '100'."
        ></x-forms.input>
        <x-forms.input type="number" name="in_game_jail_time" help="This needs to be seconds for a /jail command."
        ></x-forms.input>
        <x-forms.input type="number" name="cad_jail_time"
                       help="This needs to be hours for the civilian to shown as arrested in CAD."
        ></x-forms.input>


        <x-forms.buttons name="Save" cancel-route="admin.settings.penalCode.index"></x-forms.buttons>
    </form>
@endsection
