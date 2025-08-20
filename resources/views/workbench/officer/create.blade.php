@extends('layouts.workbench')

@section('content')

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create New Officer</h1>
        <form action="{{ route('workbench.officer.store') }}" method="POST" class="space-y-4">
            @csrf
            <x-forms.input name="first_name" label="First Name" required mdt autofocus></x-forms.input>
            <x-forms.input name="last_name" label="Last Name" required mdt></x-forms.input>
            <x-forms.input name="badge_number" label="Badge Number" required mdt></x-forms.input>
            <x-forms.input name="rank" label="Rank" required mdt></x-forms.input>

            <x-forms.input name="image_url" label="Picture" mdt></x-forms.input>


            <x-forms.select name="user_department_id" label="Department" required mdt>
                <option value="">Select Department</option>
                @foreach($userDepartments as $userDepartment)
                    <option value="{{$userDepartment->id}}">{{$userDepartment->department->name}}</option>
                @endforeach
            </x-forms.select>

            <x-forms.buttons name="Save" cancel-route="workbench.home"></x-forms.buttons>
        </form>
    </div>

@endsection
