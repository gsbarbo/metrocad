@extends('layouts.civilian')

@section('main')
    <x-breadcrumb pageTitle="Create Civilian" route="{{ route('portal.dashboard') }}">
        <x-breadcrumb-link route="{{ route('civilians.index') }}">Your Civilians</x-breadcrumb-link>
        <x-breadcrumb-link route="{{ route('civilians.create') }}">Create Civilian</x-breadcrumb-link>
    </x-breadcrumb>

    <div class="mt-4">
        <form action="{{ route('civilians.store') }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-6 md:gap-5 gap-3">
                <div class="md:col-span-3">
                    <x-forms.input name="first_name" label="First Name" required autofocus></x-forms.input>
                </div>

                <div class="md:col-span-3">
                    <x-forms.input name="last_name" label="Last Name" required></x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="date_of_birth" label="Date Of Birth" type="date" required></x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="gender" label="Gender" required>
                        @foreach (App\Support\Civilian\GenderOptions::getList() as $value => $name)
                            <option @selected(old('gender') == $value) value="{{ $value }}">{{ $name }}</option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="race" label="Race" required>
                        @foreach (App\Support\Civilian\RaceOptions::getList() as $value => $name)
                            <option @selected(old('race') == $value) value="{{ $value }}">{{ $name }}</option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="height" label="Height" required>
                        @foreach (App\Support\Civilian\HeightOptions::getList() as $value => $name)
                            <option @selected(old('height') == $value) value="{{ $value }}">{{ $name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="weight" label="Weight" required>
                        @foreach (App\Support\Civilian\WeightOptions::getList() as $value => $name)
                            <option @selected(old('weight') == $value) value="{{ $value }}">{{ $name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="phone_number" label="Phone Number"></x-forms.input>
                </div>

                <div class="space-y-2">
                    <x-forms.input name="postal" label="Postal" required type="number"></x-forms.input>
                </div>

                <div class="md:col-span-3">
                    <x-forms.input name="street" label="Street" required></x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="city" label="City" required></x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="occupation" label="Occupation"></x-forms.input>
                </div>

                <div class="md:col-span-4">
                    <x-forms.input name="image_url" label="Picture" help="Must be a Discord Link."
                    ></x-forms.input>
                </div>
            </div>

            <x-forms.buttons name="Save" cancel-route="civilians.index"></x-forms.buttons>
        </form>
    </div>
@endsection
