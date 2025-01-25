@extends('layouts.admin')

@section('main')
    <div class="flex justify-between items-baseline">
        <h1 class="text-xl font-bold">Manage Members</h1>
    </div>
    <hr class="my-2">

    <div class="">

        @livewire('admin.member-search')

    </div>
@endsection
