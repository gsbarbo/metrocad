@extends('layouts.mdt')

@section('content')
    <div>
        <h2 class="text-2xl flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor" class="size-10">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/>
            </svg>
            <span class="ml-3">New Call</span>
        </h2>
        <form action="{{route('mdt.calls.store')}}" method="POST">
            <div class="grid grid-cols-12 gap-4 mt-4">
                <div class="p-2 col-span-9">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @csrf
                    <div class="grid grid-cols-6 gap-4 border-2 p-2">
                        <div class="col-span-4">
                            @livewire('mdt.components.address-selection')
                        </div>
                        <div class="col-span-2">
                            <div class="col-span-1">
                                <label class="label-dark font-bold text-lg">Resource:</label>
                                <select name="resource" id="" class="mdt-select-input">
                                    <option value=""></option>
                                    @foreach(\App\Enum\CallResource::options() as $id => $name)
                                        <option value="{{ $id }}" @selected(old('resource') == $id)>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-span-4">
                            <label class="label-dark font-bold text-lg">Nature:</label>
                            <select name="nature" id="" class="mdt-select-input">
                                <option value=""></option>
                                @foreach(\App\Enum\CallNatures::options() as $id => $name)
                                    <option value="{{ $id }}" @selected(old('nature') == $id)>
                                        {{$id}} - {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <div class="col-span-1">
                                <label class="label-dark font-bold text-lg">Received Via:</label>
                                <select name="source" id="" class="mdt-select-input">
                                    <option value=""></option>
                                    @foreach(\App\Enum\CallSource::options() as $id => $name)
                                        <option value="{{ $id }}" @selected(old('source') == $id)>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <div class="col-span-1">
                                <label class="label-dark font-bold text-lg">Priority:</label>
                                <select name="priority" id="" class="mdt-select-input">
                                    <option value="1" @selected(old('priority') == 1)>1</option>
                                    <option value="2" @selected(old('priority') == 2)>2</option>
                                    <option value="3" @selected(old('priority') == 3)>3</option>
                                    <option value="4" @selected(old('priority') == 4)>4</option>
                                    <option value="5" @selected(old('priority') == 5)>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-span-4">
                            <div class="col-span-1">
                                <label class="label-dark font-bold text-lg">Status:</label>
                                <select name="status" id="" class="mdt-select-input">
                                    @foreach(\App\Enum\CallStatus::options() as $id => $name)
                                        <option value="{{ $id }}" @selected(old('status') == $id)>
                                            {{$id}} - {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-span-6">
                            <label class="label-dark font-bold text-lg">Narrative:</label>
                            <textarea name="narrative" class="mdt-textarea">{{old('narrative')}}</textarea>
                        </div>

                        <div class="col-span-6">
                            <button type="submit" class="btn btn-green btn-md btn-rounded">Save</button>
                        </div>

                    </div>

                </div>
                <div class="col-span-3">
                    <h2 class="label-dark font-bold text-lg">Link Civilians To Call</h2>
                    @livewire('mdt.components.civilians-to-call')


                    <h2 class="label-dark font-bold text-lg">Link Vehicles To Call</h2>
                    @livewire('mdt.components.vehicle-to-call')


                </div>
            </div>
        </form>
    </div>
@endsection
