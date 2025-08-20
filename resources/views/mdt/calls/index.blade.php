@extends('layouts.mdt')

@section('content')
    <div class="p-3">
        <h1 class="text-2xl font-bold text-white">All Calls</h1>
        <table class="w-full uppercase border border-collapse table-auto border-slate-400">
            <tr class="text-lg font-bold text-white">
                <th class="p-1 border border-slate-400">Call #</th>
                <th class="p-1 relative border border-slate-400" x-data="{ open: false }">
                    <div class="flex justify-between items-center">
                        Type
                        <a @click="open = !open" class="cursor-pointer">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke-width="1.5" stroke="currentColor"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5"
                                    stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <div @click.outside="open = false"
                         class="absolute right-0 top-8 z-50 w-32 p-3 space-y-3 text-white bg-gray-800 rounded"
                         x-show="open">
                        <div class="flex items-center">
                            <input @checked(isset($type_filters['1']))
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                   id="LEO" name="type_filters[]" type="checkbox" value="1"
                                   wire:model="type_filters">
                            <label class="ms-2" for="LEO">LEO</label>
                        </div>
                        <div class="flex items-center">
                            <input @checked(isset($type_filters['2']))
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                   id="FD" name="type_filters[]" type="checkbox" value="2"
                                   wire:model="type_filters">
                            <label class="ms-2" for="FD">FD</label>
                        </div>
                        <div class="flex items-center">
                            <input @checked(isset($type_filters['3']))
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                   id="EMS" name="type_filters[]" type="checkbox" value="3"
                                   wire:model="type_filters">
                            <label class="ms-2" for="EMS">EMS</label>
                        </div>
                    </div>
                </th>
                <th class="p-1 relative border border-slate-400" x-data="{ open: false }">
                    <div class="flex justify-between items-center">
                        Nature
                        <span class="text-xs text-yellow-500">
{{--                        @if ($nature_filter)--}}
                            {{--                                (({{ $nature_filter }} - {{ $call_natures[$nature_filter]['name'] }}))--}}
                            {{--                            @else--}}
                            {{--                                ((ALL CALLS))--}}
                            {{--                            @endif--}}
                    </span>
                        <a @click="open = !open" class="underline cursor-pointer">
                            <svg class="w-5 h-5 ml-2" fill="none" stroke-width="1.5" stroke="currentColor"
                                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6 13.5V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m12-3V3.75m0 9.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 3.75V16.5m-6-9V3.75m0 3.75a1.5 1.5 0 0 1 0 3m0-3a1.5 1.5 0 0 0 0 3m0 9.75V10.5"
                                    stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <div @click.outside="open = false"
                         class="absolute right-0 top-8 z-50 w-80 p-3 space-y-3 text-white bg-gray-800 rounded"
                         x-show="open">
                        <select @change="open = false" class="select-input" id="" name=""
                                wire:model="nature_filter">
                            <option value="">ALL</option>
                            {{--                            @foreach ($call_natures as $call_nature => $name)--}}
                            {{--                                <option value="{{ $call_nature }}">{{ $call_nature }} ---}}
                            {{--                                    {{ $name['name'] }}</option>--}}
                            {{--                            @endforeach--}}
                        </select>
                    </div>
                </th>
                <th class="p-1 border border-slate-400">Location</th>
                <th class="p-1 border border-slate-400">City</th>
                <th class="p-1 border border-slate-400">Status</th>
            </tr>
            @foreach ($calls as $call)
                <tr class="text-green-600">
                    <td class="p-1 border border-slate-400">
                        <a class="hover:underline" href="{{route('mdt.calls.show', $call['id'])}}">{{$call['id']}}</a>
                    </td>
                    <td class="p-1 border border-slate-400">{{$call['resource']['label']}}</td>
                    <td class="p-1 border border-slate-400">{{$call['nature']['code'] }}
                        - {{$call['nature']['label']}}</td>
                    <td class="p-1 border border-slate-400">{{$call['address']['postal']}} {{$call['address']['street']}}
                        @if($call['address']['name'])
                            ({{$call['address']['name']}})
                        @endif
                    </td>
                    <td class="p-1 border border-slate-400">{{$call['address']['city']}}</td>
                    <td class="relative p-1 border border-slate-400" x-data="{ statusOpen: false }">
                        <div class="flex justify-between">
                            <span>{{$call['status']['code']}} - {{$call['status']['label']}}</span>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
