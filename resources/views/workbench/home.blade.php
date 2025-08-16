@extends('layouts.workbench')

@section('content')

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Your Officers</h1>

        @foreach(auth()->user()->userDepartments as $userDepartment)
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-2">{{ $userDepartment->department->name }}</h2>
                <ul class="list-disc pl-5">
                    <li class="mb-1">
                        {{ $userDepartment->officer->first_name }} {{ $userDepartment->officer->last_name }} -
                        Badge: {{ $userDepartment->officer->badge_number }} -
                        Rank: {{ $userDepartment->officer->rank }}
                    </li>
                </ul>
            </div>
        @endforeach

    </div>

@endsection
