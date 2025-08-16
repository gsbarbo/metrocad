@extends('layouts.mdt')

@section('content')
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 text-white">
        <div class="">
            <h1 class="text-center text-2xl font-bold">Message Center</h1>
            <div class="bg-[#0C1011] p-3 rounded-lg mt-2">
                <div class="bg-[#171B1C] rounded-md p-2">
                    <ul class="font-bold">
                        <li>Alerts: <a class="text-sm underline" href="#">0 new</a></li>
                        <li>Messages: <a class="text-sm underline" href="#">0 new</a></li>
                        <li>Approvals: <a class="text-sm underline" href="#">0 new</a></li>
                        <li>State Returns: <a class="text-sm underline" href="#">0 new</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="">
            <h1 class="text-center text-2xl font-bold">System</h1>
            <div class="bg-[#0C1011] p-3 rounded-lg mt-2">
                <div class="bg-[#171B1C] rounded-md p-2">
                    <ul class="font-bold">
                        <li class="">Username:
                            <span class="text-sm !lowercase">
                                {{ str_replace(' ', '_', strtolower(auth()->user()->active_unit->officer->name)) }}
                            </span>
                        </li>
                        <li>Server: <span class="text-sm">live_database_prod</span></li>
                        <li>Version: <span class="text-sm">{{date('Y.m-d.Hi')}}</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="">
            <h1 class="text-center text-2xl font-bold">CAD SCREEN</h1>
            <div class="bg-[#0C1011] p-3 rounded-lg mt-2">
                <div class="bg-[#171B1C] rounded-md p-2">
                    <ul class="font-bold">
                        <li>Calls: <a class="text-sm underline" href="#">0
                                active</a>
                        </li>
                        <li>Unit: <a class="text-sm underline"
                                     href="#">{{ auth()->user()->active_unit->officer->badge_number }} -
                                {{ auth()->user()->active_unit->status }}</a></li>
                        <li>Zone: <a class="text-sm underline" href="#">Sandy Shores AOP</a></li>
                        <li>My Active Call:
                            {{--                            @forelse (auth()->user()->active_unit->nice_calls as $call)--}}
                            {{--                                <a class="text-sm underline"--}}
                            {{--                                   href="{{ route('mdt.call.show', $call) }}">{{ str_pad($call, 5, 0, STR_PAD_LEFT) }}--}}
                            {{--                                    ,</a>--}}
                            {{--                            @empty--}}
                            None
                            {{--                            @endforelse--}}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="">
            <h1 class="text-center text-2xl font-bold">Statistics</h1>
            <div class="bg-[#0C1011] p-3 rounded-lg mt-2">
                <div class="bg-[#171B1C] rounded-md p-2">
                    <ul class="font-bold">
                        <li class="">Username:
                            <span class="text-sm !lowercase">
                                {{ str_replace(' ', '_', strtolower(auth()->user()->active_unit->officer->name)) }}
                            </span>
                        </li>
                        <li>Server: <span class="text-sm">live_database_prod</span></li>
                        <li>Version: <span class="text-sm">2023.3.29.1856</span></li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
@endsection
