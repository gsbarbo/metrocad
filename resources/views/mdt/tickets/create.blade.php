@extends('layouts.mdtBasic')

@section('content')
    <div class="p-2 flex justify-between bg-slate-700 ">
        <div class="text-white">
            <h1 class="text-3xl font-thin">New Ticket for {{$civilian->name}}</h1>
        </div>
    </div>
    <form action="{{route('mdt.reports.store')}}" method="post">
        @csrf
        <div class="p-2 grid grid-cols-5 gap-2">
            <div class="col-span-4 space-y-4">
                <div class="bg-slate-700 rounded-lg">
                    <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                        <h1 class="px-5">Call Information</h1>
                    </div>
                    <livewire:mdt.tickets.call-information/>
                </div>

                <div class="bg-slate-700 rounded-lg">
                    <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                        <h1 class="px-5">Type</h1>
                    </div>
                    <div class="px-5 py-2 space-y-2">
                        <x-forms.select name="type" label="Ticket Type" mdt required>
                            <option value="">Choose Type</option>
                            @foreach(\App\Enum\TicketType::toArray() as $id => $label)
                                <option
                                    @selected($id == old('type')) value="{{$id}}">{{$label}}</option>
                            @endforeach
                        </x-forms.select>
                    </div>
                </div>

                <div class="bg-slate-700 rounded-lg">
                    <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                        <h1 class="px-5">Section I - Civilian Information</h1>
                    </div>
                    <div class="px-5 py-2 space-y-2">
                        <div class="grid grid-cols-6 gap-2">
                            <div class="col-span-3">
                                <x-forms.input name="" label="Name" mdt
                                               readonly>{{$civilian->name}}</x-forms.input>
                            </div>
                            <x-forms.input name="" label="DOB" mdt readonly>
                                {{$civilian->date_of_birth?->format(get_setting('general.dateFormat'))}}
                            </x-forms.input>
                            <x-forms.input name="" label="Age" mdt readonly>
                                {{$civilian->age}}
                            </x-forms.input>
                            <x-forms.input name="" label="SSN" mdt readonly>
                                {{$civilian->s_n_n}}
                            </x-forms.input>
                            <div class="col-span-2">
                                <x-forms.input name="" label="Postal" mdt readonly>
                                    {{$civilian->postal}}
                                </x-forms.input>
                            </div>
                            <div class="col-span-2">
                                <x-forms.input name="" label="Street" mdt readonly>
                                    {{$civilian->street}}
                                </x-forms.input>
                            </div>
                            <div class="col-span-2">
                                <x-forms.input name="" label="City" mdt readonly>
                                    {{$civilian->city}}
                                </x-forms.input>
                            </div>

                            <livewire:mdt.tickets.licenseSelect :licenses="$civilian->licenses"/>


                        </div>

                    </div>
                </div>

                <div class="bg-slate-700 rounded-lg">
                    <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                        <h1 class="px-5">Section II - Ticket/Arrest Information</h1>
                    </div>
                    <div class="px-5 py-2 space-y-2">
                        <div class="grid grid-cols-6 gap-2">
                            <div class="col-span-3">
                                <x-forms.input name="" label="Name" mdt
                                               readonly>{{$civilian->name}}</x-forms.input>
                            </div>
                            <x-forms.input name="" label="DOB" mdt readonly>
                                {{$civilian->date_of_birth?->format(get_setting('general.dateFormat'))}}
                            </x-forms.input>
                            <x-forms.input name="" label="Age" mdt readonly>
                                {{$civilian->age}}
                            </x-forms.input>
                            <x-forms.input name="" label="SSN" mdt readonly>
                                {{$civilian->s_n_n}}
                            </x-forms.input>
                            <div class="col-span-2">
                                <x-forms.input name="" label="Postal" mdt readonly>
                                    {{$civilian->postal}}
                                </x-forms.input>
                            </div>
                            <div class="col-span-2">
                                <x-forms.input name="" label="Street" mdt readonly>
                                    {{$civilian->street}}
                                </x-forms.input>
                            </div>
                            <div class="col-span-2">
                                <x-forms.input name="" label="City" mdt readonly>
                                    {{$civilian->city}}
                                </x-forms.input>
                            </div>

                            <livewire:mdt.tickets.licenseSelect :licenses="$civilian->licenses"/>


                        </div>

                    </div>
                </div>

            </div>

            <div class="col-span-1 space-y-4">
                <div>
                    <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                        <h1 class="px-5">Status</h1>
                    </div>
                    <div class="flex-col flex space-y-2 mt-2 text-white mx-5">
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-6 mr-2 text-yellow-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"/>
                            </svg>
                            Unsaved
                        </div>
                    </div>
                </div>
                <div>
                    <div class="bg-blue-700 text-white border-b-4 border-blue-800 rounded-t-lg py-2">
                        <h1 class="px-5">Actions</h1>
                    </div>
                    <div class="flex-col flex space-y-2 mt-2">
                        <button class="btn btn-green btn-sm btn-rounded" type="submit">Save & Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
