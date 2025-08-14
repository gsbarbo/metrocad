<div>
    <div class="text-base leading-relaxed" x-show="openTab === 1">
        <div class="max-w-7xl mx-auto">
            <form action="{{ route('mdt.calls.update', $call->id) }}"
                  class="p-2 space-y-2 text-white border border-white rounded cursor-default" method="POST">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1 class="text-xl font-semibold">Location</h1>
                <div class="flex items-center">
                    <div class="w-3/5">
                        <p class="block mr-2">Incident Address:</p>
                        <p class="mdt-text-input">{{ $call->address->full_address }}</p>
                    </div>
                    <div class="w-2/5 ml-3">
                        <p class="block mr-2">City:</p>
                        <p class="mdt-text-input">{{ $call->address->city }}</p>
                    </div>
                </div>
                <hr>
                <h1 class="text-xl font-semibold">Caller Info - Reporting Party</h1>
                @foreach ($reportingParties as $reportingParty)
                    <div class="">
                        <a href="{{route('mdt.civilianReturn', $reportingParty->civilian->id)}}" class="inline-block">
                            <x-civilian.card :civilian="$reportingParty->civilian"></x-civilian.card>
                        </a>
                    </div>
                @endforeach
                <hr>
                <h1 class="text-xl font-semibold">CAD Incident</h1>
                <div class="flex items-center">
                    <div class="w-3/5">
                        <p class="block mr-2">Nature:</p>
                        <select class="mdt-select-input" name="nature">
                            @foreach (\App\Enum\CallNatures::options() as $code => $name)
                                <option @selected($call->nature->code() == $code) value="{{ $code }}">
                                    {{ $code }} -
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-2/5 ml-3">
                        <p class="block mr-2">Received via:</p>
                        <p class="mdt-text-input">{{ $call->source }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-1/3">
                        <label class="block mr-2">Priority:</label>
                        <select class="mdt-select-input" name="priority">
                            <option @selected($call->priority == 1) value="1">1</option>
                            <option @selected($call->priority == 2) value="2">2</option>
                            <option @selected($call->priority == 3) value="3">3</option>
                            <option @selected($call->priority == 4) value="4">4</option>
                            <option @selected($call->priority == 5) value="5">5</option>
                        </select>
                    </div>
                    <div class="w-1/3 ml-3">
                        <label class="block mr-2">Resource:</label>
                        <select class="mdt-select-input" name="resource">
                            @foreach (\App\Enum\CallResource::options() as $code => $name)
                                <option @selected($call->resource->value == $code) value="{{ $code }}">
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-1/3 ml-3">
                        <label class="block mr-2">Status:</label>
                        <select class="mdt-select-input" name="status">
                            @foreach (\App\Enum\CallStatus::options() as $code => $name)
                                <option @selected($call->status->code() == $code) value="{{ $code }}">
                                    {{ $code }} -
                                    {{ $name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-full">
                        <label class="block mr-2">Narrative:</label>
                        <p class="mdt-textarea">{{ $call->narrative }}</p>
                    </div>
                </div>
                <button class="btn btn-md btn-gray btn-rounded" type="submit">Update
                    CALL
                </button>
            </form>
        </div>
    </div>
</div>
