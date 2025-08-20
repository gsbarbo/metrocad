@extends('layouts.workbench')

@section('content')
    <div class="max-w-5xl mx-auto p-3">
        <x-breadcrumb pageTitle="Officers" route="{{ route('workbench.home') }}">
            <x-breadcrumb-link route="{{ route('workbench.officer.index') }}">Your Officers</x-breadcrumb-link>
        </x-breadcrumb>
        <x-admin.header>
            <div class="">
                <a href="{{ route('workbench.officer.create') }}">
                    <button class="btn btn-green btn-md btn-rounded" type="button">Add Officer</button>
                </a>
            </div>
        </x-admin.header>

        <div class="container mx-auto p-4">
            <div class="grid grid-cols-2 gap-4">
                @foreach($officers as $officer)
                    <a href="{{route('workbench.officer.edit', $officer->id)}}">
                        <x-officer.card :officer="$officer"></x-officer.card>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
