@extends('layouts.civilian')

@section('main')
    <x-breadcrumb pageTitle="Edit Civilian ({{ $civilian->name }})" route="{{ route('portal.dashboard') }}">
        <x-breadcrumb-link route="{{ route('civilians.index') }}">Your Civilians</x-breadcrumb-link>
        <x-breadcrumb-link
            route="{{ route('civilians.show', $civilian->id) }}">{{ $civilian->name }}</x-breadcrumb-link>
        <x-breadcrumb-text>Edit</x-breadcrumb-text>
    </x-breadcrumb>

    <div class="mt-4">
        <form action="{{ route('civilians.store') }}" method="POST">
            @csrf
            <div class="grid md:grid-cols-6 md:gap-5 gap-3">

                <div class="md:col-span-2">
                    <x-forms.select name="height" label="Height" required>
                        @foreach (App\Support\Civilian\HeightOptions::getList() as $value => $name)
                            <option
                                @selected(old('height', $civilian->getRawOriginal('height')) == $value) value="{{ $value }}">{{ $name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.select name="weight" label="Weight" required>
                        @foreach (App\Support\Civilian\WeightOptions::getList() as $value => $name)
                            <option
                                @selected(old('weight', $civilian->getRawOriginal('weight')) == $value) value="{{ $value }}">{{ $name }}
                            </option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="phone_number" label="Phone Number">{{$civilian->phone_number}}</x-forms.input>
                </div>

                <div class="space-y-2">
                    <x-forms.input name="postal" label="Postal" required
                                   type="number">{{$civilian->postal}}</x-forms.input>
                </div>

                <div class="md:col-span-3">
                    <x-forms.input name="street" label="Street" required>{{$civilian->street}}</x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="city" label="City" required>{{$civilian->city}}</x-forms.input>
                </div>

                <div class="md:col-span-2">
                    <x-forms.input name="occupation" label="Occupation">{{$civilian->occupation}}</x-forms.input>
                </div>

                <div class="md:col-span-4">
                    <x-forms.input name="image_url" label="Picture" help="Must be a Discord Link."
                                   type="url">{{$civilian->picture}}</x-forms.input>
                </div>
            </div>

            <x-forms.buttons name="Save" cancel-route="civilians.show"
                             cancel-route-id="{{$civilian->id}}"></x-forms.buttons>
        </form>
    </div>
@endsection
