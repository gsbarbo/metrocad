@extends('layouts.civilian')

@section('main')
    <x-page-header title="Create Civilian" home="{{ route('civilian.index') }}">
        <x-slot:breadcrumbs>
            <x-breadcrumb-link href="{{ route('civilian.index') }}">All Civilians</x-breadcrumb-link>
            <x-breadcrumb-text>Create Civilian</x-breadcrumb-text>
        </x-slot:breadcrumbs>

        <x-slot:actions>
            <a href="{{ route('civilian.index') }}" class="btn btn-secondary btn-md btn-pill">
                Back
            </a>
        </x-slot:actions>
    </x-page-header>

    <div class="mt-4">
        <form action="{{ route('civilian.store') }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-6 md:gap-5 gap-3">
                <div class="md:col-span-3">
                    <x-forms.input name="first_name" required autofocus></x-forms.input>
                </div>

                <div class="md:col-span-3">
                    <x-forms.input name="last_name" required></x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="date_of_birth" type="date" required></x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="gender" required>
                        @foreach (App\Enums\Civilian\Gender::cases() as $option)
                            <option @selected(old('gender') == $option->value) value="{{ $option->value }}">{{ $option->label() }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="race" required>
                        @foreach (App\Enums\Civilian\Race::cases() as $option)
                            <option @selected(old('race') == $option->value) value="{{ $option->value }}">{{ $option->label() }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="eye_color" required>
                        @foreach (App\Enums\Civilian\EyeColor::cases() as $option)
                            <option @selected(old('eye_color') == $option->value) value="{{ $option->value }}">{{ $option->label() }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="hair_color" required>
                        @foreach (App\Enums\Civilian\HairColor::cases() as $option)
                            <option @selected(old('hair_color') == $option->value) value="{{ $option->value }}">{{ $option->label() }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="blood_type" required>
                        @foreach (App\Enums\Civilian\BloodType::cases() as $option)
                            <option @selected(old('blood_type') == $option->value) value="{{ $option->value }}">{{ $option->label() }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="height" required>
                        @foreach (App\Helpers\Civilian\PhysicalAttributes::heights(setting('community.units')) as $value => $name)
                            <option @selected(old('height') == $value) value="{{ $value }}">{{ $name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="weight" required>
                        @foreach (App\Helpers\Civilian\PhysicalAttributes::weights(setting('community.units')) as $value => $name)
                            <option @selected(old('weight') == $value) value="{{ $value }}">{{ $name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="phone_number"></x-forms.input>
                </div>

                <div class="space-y-2">
                    <x-forms.input name="postal" required type="number"></x-forms.input>
                </div>

                <div class="md:col-span-3">
                    <x-forms.input name="street" required></x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="city" required></x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="occupation"></x-forms.input>
                </div>

                <div class="md:col-span-4">
                    <x-forms.input name="image_url" help="Must be a Discord Link."></x-forms.input>
                </div>
            </div>

            <x-forms.buttons name="Create" cancel-route="civilian.index"></x-forms.buttons>
        </form>
    </div>
@endsection
