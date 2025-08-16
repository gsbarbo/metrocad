@extends('layouts.workbench')

@section('content')

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Create New Officer</h1>
        <form action="{{ route('workbench.newOfficer.store') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="first_name" class="label-dark">First Name</label>
                <input type="text" name="first_name" id="first_name" required
                       class="form-text-input-dark">
            </div>
            <div>
                <label for="last_name" class="label-dark">Last Name</label>
                <input type="text" name="last_name" id="last_name" required
                       class="form-text-input-dark">
            </div>

            <div>
                <label for="badge_number" class="label-dark">Badge Number</label>
                <input type="text" name="badge_number" id="badge_number" required
                       class="form-text-input-dark">
            </div>

            <div>
                <label for="rank" class="label-dark">Rank</label>
                <input type="text" name="rank" id="rank" required
                       class="form-text-input-dark">
            </div>

            <div>
                <label for="user_department_id" class="label-dark">Department</label>
                <select name="user_department_id" id="user_department_id"
                        class="form-select-input-dark">
                    <option value="">Select Department</option>
                    @foreach(auth()->user()->userDepartments as $userDepartment)
                        <option value="{{$userDepartment->id}}">{{$userDepartment->department->name}}</option>
                    @endforeach
                    <!-- Add department options here -->
                </select>
            </div>

            <button type="submit"
                    class="btn btn-green btn-md btn-rounded">Create
            </button>
        </form>
    </div>

@endsection
