@extends('layouts.mdt')

@section('content')
    <div class="space-y-8">
        <div>
            @livewire('mdt.cadScreen.statusButtons')
        </div>

        <div class="">
            <h1 class="text-2xl font-bold text-white">Quick Calls</h1>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="#">
                    <button class="btn btn-gray btn-lg w-full btn-rounded">Traffic Stop</button>
                </a>

                <a href="#">
                    <button class="btn btn-gray btn-lg w-full btn-rounded">Flagged Down</button>
                </a>

                <a href="#">
                    <button class="btn btn-gray btn-lg w-full btn-rounded">CALL</button>
                </a>

                <a href="{{route('mdt.calls.create')}}">
                    <button class="btn btn-green btn-lg w-full btn-rounded">New CALL</button>
                </a>
            </div>

        </div>

        <div class="">
            @livewire('mdt.cadScreen.activeCalls')
        </div>

        <div class="h-full">
            @livewire('mdt.cadScreen.activeUnits')
        </div>
    </div>
@endsection
