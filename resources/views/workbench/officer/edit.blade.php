@extends('layouts.workbench')

@section('content')
    <div class="p-3">
        <x-breadcrumb pageTitle="Edit {{$officer->name}}" route="{{ route('workbench.home') }}">
            <x-breadcrumb-link route="{{ route('workbench.officer.index') }}">Your Officers</x-breadcrumb-link>
            <x-breadcrumb-link route="{{ route('workbench.officer.index') }}">Edit Officer</x-breadcrumb-link>
        </x-breadcrumb>
    </div>

    <div class="container mx-auto p-4">
        <form action="{{ route('workbench.officer.update', $officer->id) }}" method="POST" class="space-y-4">
            @csrf
            <x-forms.input name="first_name" label="First Name" required mdt
                           autofocus>{{$officer->first_name}}</x-forms.input>
            <x-forms.input name="last_name" label="Last Name" required mdt>{{$officer->last_name}}</x-forms.input>
            <x-forms.input name="badge_number" label="Badge Number" required
                           mdt>{{$officer->badge_number}}</x-forms.input>
            <x-forms.input name="rank" label="Rank" required mdt>{{$officer->rank}}</x-forms.input>

            <x-forms.input name="image_url" label="Picture" mdt>{{$officer->picture}}</x-forms.input>


            <x-forms.select name="user_department_id" label="Department"
                            help="Only change this if you want to move the officer to a new department." mdt>
                <option value="">Select Department</option>
                @foreach($userDepartments as $userDepartment)
                    <option
                        value="{{$userDepartment->id}}" @selected($userDepartment->id === old('user_department_id', $officer->user_department?->id))>{{$userDepartment->department->name}}</option>
                @endforeach
            </x-forms.select>

            <x-forms.buttons name="Save" cancel-route="workbench.officer.index"></x-forms.buttons>
        </form>
    </div>

@endsection
