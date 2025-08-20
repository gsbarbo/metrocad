<div>
    <h2 class="text-2xl">Linked Civilians</h2>
    <div class="grid grid-cols-2">
        @forelse($call->call_civilians as $callCivilian)
            <div class="">
                <x-civilian.card :civilian="$callCivilian->civilian"></x-civilian.card>
                <h2 class="text-center text-lg">{{$callCivilian->type->label()}}</h2>
            </div>
        @empty
            <p class="text-gray-300 ml-4">No civilians have been linked to this call.</p>
        @endforelse
    </div>
    <hr class="my-3">
    <h2 class="text-2xl">Linked Vehicles</h2>
    <div class="grid grid-cols-2">
        @forelse($call->call_vehicles as $callVehicle)
            <div class="">
                <x-vehicle.card :vehicle="$callVehicle->vehicle"></x-vehicle.card>
                <h2 class="text-center text-lg">{{$callCivilian->type->label()}}</h2>
            </div>
        @empty
            <p class="text-gray-300 ml-4">No vehicles have been linked to this call.</p>
        @endforelse
    </div>
    <hr class="my-3">
    <h2 class="text-2xl">Linked Calls</h2>
    <div class="divide-y-2">
        @forelse($callsAtPostal as $callAtPostal)
            <div class="">
                <a class="text-lg hover:underline" href="{{route('mdt.calls.show', $call->id)}}">
                    {{$callAtPostal->id}} |
                    {{$callAtPostal->nature->code()}} ({{$callAtPostal->nature->label()}}) |
                    {{$callAtPostal->status->code()}} ({{$callAtPostal->status->label()}}) |
                    {{$callAtPostal->updated_at->format(get_setting('general.dateFormat'))}}
                </a>
            </div>
        @empty
            <p class="text-gray-300 ml-4">No other calls have been created at this postal.</p>
        @endforelse
    </div>
</div>
