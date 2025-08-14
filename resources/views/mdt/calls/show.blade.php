@extends('layouts.mdt')

@section('content')
    <div>
        <div class="bg-[#0C1011] text-white p-1">
            <div class="flex text-sm justify-between items-center max-w-7xl mx-auto">
                <p>ID: {{$call->id}}</p>
                <p>Nature: {{$call->nature->code()}} - {{$call->nature->label()}}</p>
                <p>Started: {{$call->created_at->format('h:m:i m/d/Y')}}</p>
                <p>LastUpdate: {{$call->updated_at->format('h:m:i m/d/Y')}}</p>
            </div>
        </div>
        <div class="bg-[#0C1011] text-white p-1">
            <div class="flex text-sm justify-between items-center max-w-7xl mx-auto">
                <p>Status: {{$call->status->code()}} - {{$call->status->label()}}</p>
                <p>Attached: 3C-31, 3C-30</p>
            </div>
        </div>

        <div class="container mx-auto px-6 mt-3">

            <div class="grid grid-cols-12 h-max" x-data="{
            openTab: 1,
            activeClasses: 'bg-[#222423] text-white z-20',
            inactiveClasses: 'bg-[#0C1011] hover:bg-[#222423] hover:text-white',
            }">
                <div class="col-span-1 bg-[#0C1011] divide-y-2">
                    <a href="#" class="block text-center py-3"
                       :class="openTab === 1 ? activeClasses : inactiveClasses" @click="openTab = 1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-8 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z"/>
                        </svg>
                        Info
                    </a>
                    <a href="#" class="block text-center py-3"
                       :class="openTab === 2 ? activeClasses : inactiveClasses" @click="openTab = 2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-8 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244"/>
                        </svg>
                        Links
                    </a>
                    <a href="#" class="block text-center py-3"
                       :class="openTab === 3 ? activeClasses : inactiveClasses" @click="openTab = 3">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-8 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M2.25 12.75V12A2.25 2.25 0 0 1 4.5 9.75h15A2.25 2.25 0 0 1 21.75 12v.75m-8.69-6.44-2.12-2.12a1.5 1.5 0 0 0-1.061-.44H4.5A2.25 2.25 0 0 0 2.25 6v12a2.25 2.25 0 0 0 2.25 2.25h15A2.25 2.25 0 0 0 21.75 18V9a2.25 2.25 0 0 0-2.25-2.25h-5.379a1.5 1.5 0 0 1-1.06-.44Z"/>
                        </svg>
                        Reports
                    </a>
                    <a href="#" class="block text-center py-3"
                       :class="openTab === 4 ? activeClasses : inactiveClasses" @click="openTab = 4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-8 mx-auto">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7.864 4.243A7.5 7.5 0 0 1 19.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 0 0 4.5 10.5a7.464 7.464 0 0 1-1.15 3.993m1.989 3.559A11.209 11.209 0 0 0 8.25 10.5a3.75 3.75 0 1 1 7.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 0 1-3.6 9.75m6.633-4.596a18.666 18.666 0 0 1-2.485 5.33"/>
                        </svg>
                        Evidence
                    </a>
                </div>
                <div class="col-span-9 px-3">
                    <div class="" x-show="openTab === 1">
                        @include('components.mdt.calls.call-info-tab', ['call' => $call])
                    </div>
                    <div class="" x-show="openTab === 2">2</div>
                    <div class="" x-show="openTab === 3">3</div>
                    <div class="" x-show="openTab === 4">4</div>
                </div>
                <div class="col-span-2 flex flex-col space-y-2">
                    <input type="text" class="mdt-text-input">
                    <button class="btn btn-gray btn-md btn-rounded">Send</button>
                </div>
            </div>
        </div>
    </div>
@endsection
