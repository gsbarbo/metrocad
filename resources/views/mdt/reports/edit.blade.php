@extends('layouts.mdtBasic')

@section('content')
    <div class="p-2 flex justify-between bg-slate-700 ">
        <div class="text-white">
            <h1 class="text-3xl font-thin">{{$report->reportType->title}} - New</h1>
            <h3 class="text-sm">
                <span>Call:</span> {{$report->call->id}} - {{$report->call->nature->label()}}
                <br>
                <span>Officer:</span> {{auth()->user()->active_unit->officer->formatted_name}}
            </h3>
        </div>
    </div>
    <div class="p-2 grid grid-cols-5 gap-2">
        <div class="col-span-4 space-y-4">
            <div class="bg-slate-700 rounded-lg">
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Event Information</h1>
                </div>
                <div class="px-5 py-2 space-y-2">
                    <x-forms.input name="" label="Event Location"
                                   mdt readonly>{{$report->call->full_address}}</x-forms.input>
                    <x-forms.input name="" label="Event Date" mdt
                                   readonly>{{$report->call->created_at->format(get_setting('general.dateFormat'))}}</x-forms.input>

                    <div class="bg-slate-600 text-white border-b-4 border-slate-800 p-2">
                        <h1 class="ml-5">Report Information</h1>
                    </div>

                    <x-forms.input name="" label="Report Type" mdt
                                   readonly>{{$report->reportType->title}}</x-forms.input>

                </div>
            </div>

            <div class="bg-slate-700 rounded-lg text-white">
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Property</h1>
                </div>
                <div class="px-5 py-2 space-y-2">
                    <button class="btn btn-green btn-sm btn-rounded">Add Property</button>

                    <table class="w-full">
                        <tr class="border-b-2">
                            <th>Property</th>
                            <th>Status</th>
                            <th>Reason for Police Custody</th>
                        </tr>
                    </table>
                </div>
            </div>

            {{--            <div class="bg-slate-700 rounded-lg text-white">--}}
            {{--                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">--}}
            {{--                    <h1 class="px-5">Persons</h1>--}}
            {{--                </div>--}}
            {{--                <div class="px-5 py-2 space-y-2">--}}
            {{--                    <button class="btn btn-green btn-sm btn-rounded">Add Person</button>--}}

            {{--                    <table class="w-full">--}}
            {{--                        <tr class="border-b-2">--}}
            {{--                            <th>Name</th>--}}
            {{--                            <th>Type</th>--}}
            {{--                            <th>Arrested / Cited</th>--}}
            {{--                        </tr>--}}
            {{--                    </table>--}}
            {{--                </div>--}}
            {{--            </div>--}}

            <livewire:mdt.reports.person-model :reportId="$report->id" :report="$report"/>

            <div class="bg-slate-700 rounded-lg text-white">
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Vehicles</h1>
                </div>
                <div class="px-5 py-2 space-y-2">
                    <button class="btn btn-green btn-sm btn-rounded">Add Vehicle</button>

                    <table class="w-full">
                        <tr class="border-b-2">
                            <th>Plate</th>
                            <th>Status</th>
                            <th>Impounded / Towed</th>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="bg-slate-700 rounded-lg text-white">
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Narrative</h1>
                </div>
                <div class="px-5 py-2 space-y-2">
                    <x-forms.textarea name="" label="Narrative" placeholder="Enter narrative here..." required mdt
                                      rows="10"/>
                </div>
            </div>

            <div class="bg-slate-700 rounded-lg text-white">
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Comments</h1>
                </div>
                <div class="px-5 space-y-2 divide-y">

                    <div class="py-1">
                        <div class="flex">
                            <div class="">
                                <img
                                    src="https://lh3.googleusercontent.com/a/ACg8ocKIWdfb7aIybpzBFfDOHi2TyFWvW73xKa2hXx8Zw1Xzoz62T18=s96-c"
                                    alt="Placeholder"
                                    class="w-12 h-12 rounded-full mr-2">
                            </div>
                            <div>
                                <h3 class="text-lg">Rosa Diaz, Ivan</h3>
                                <p class="text-xs">09/10/2025 2000</p>
                            </div>
                        </div>
                        <div class="text-sm text-justify mt-2">
                            lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                            labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        </div>

                    </div>

                    <div class="py-1">
                        <div class="flex">
                            <div class="">
                                <img
                                    src="https://lh3.googleusercontent.com/a/ACg8ocKIWdfb7aIybpzBFfDOHi2TyFWvW73xKa2hXx8Zw1Xzoz62T18=s96-c"
                                    alt="Placeholder"
                                    class="w-12 h-12 rounded-full mr-2">
                            </div>
                            <div>
                                <h3 class="text-lg">Rosa Diaz, Ivan</h3>
                                <p class="text-xs">09/10/2025 2000</p>
                            </div>
                        </div>
                        <div class="text-sm text-justify mt-2">
                            lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut
                            labore
                            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                        </div>

                    </div>

                </div>
            </div>

            <div class="bg-slate-700 rounded-lg text-white">
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Associated Reports</h1>
                </div>
                <div class="px-5 py-2 space-y-2">
                    List of reports associated with this CAD CALL.
                </div>
            </div>


        </div>

        <div class="col-span-1 space-y-4">
            <div>
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Status</h1>
                </div>
                <div class="flex-col flex space-y-2 mt-2 text-white mx-5">

                    @switch($report->status)

                        @case(\App\Enum\ReportStatus::DRAFT)
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="size-6 mr-2 text-blue-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                                </svg>
                                Draft
                            </div>
                            @break

                        @case(\App\Enum\ReportStatus::PENDING)
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="size-6 mr-2 text-green-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                </svg>
                                Pending Review
                            </div>
                            @break

                        @case(\App\Enum\ReportStatus::REJECTED)
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="size-6 mr-2 text-red-600">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z"/>
                                </svg>
                                Rejected
                            </div>
                            @break

                        @case(\App\Enum\ReportStatus::COMPLETED)
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                     class="size-6 mr-2 text-green-500">
                                    <path fill-rule="evenodd"
                                          d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                                          clip-rule="evenodd"/>
                                </svg>
                                Completed
                            </div>
                            @break

                        @default
                            <div class="flex">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5"
                                     stroke="currentColor" class="size-6 mr-2 text-yellow-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                                </svg>
                                Unsaved
                            </div>
                    @endswitch
                </div>
            </div>
            <div>
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Actions</h1>
                </div>
                <div class="flex-col flex space-y-2 mt-2">
                    <button class="btn btn-green btn-sm btn-rounded">Submit Report</button>
                    <button class="btn btn-blue btn-sm btn-rounded">Save Report</button>
                    <button class="btn btn-red btn-sm btn-rounded">Delete Report</button>
                </div>
            </div>

            <div>
                <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                    <h1 class="px-5">Navigation</h1>
                </div>
                <div class="flex-col flex space-y-2 mt-2">
                    <button class="btn btn-gray btn-sm btn-rounded">Event Information</button>
                    <button class="btn btn-gray btn-sm btn-rounded">Property</button>
                    <button class="btn btn-gray btn-sm btn-rounded">Persons</button>
                    <button class="btn btn-gray btn-sm btn-rounded">Vehicles</button>
                    <button class="btn btn-gray btn-sm btn-rounded">Narrative</button>
                    <button class="btn btn-gray btn-sm btn-rounded">Comments</button>
                    <button class="btn btn-gray btn-sm btn-rounded">Associated Reports</button>
                </div>
            </div>
        </div>
    </div>
@endsection
