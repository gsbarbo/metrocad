<div>
    <div class="bg-gray-200 rounded-lg p-2 text-black text-sm">
        <div class="">
            <p class="text-lg text-center">{{ strtoupper(get_setting('names.state')) }}</p>
        </div>
        <div class="mt-1">
            <p class="text-3xl text-center">{{ $vehicle->plate }}</p>
        </div>
        <div class="mt-1 flex justify-between">
            <div class="flex space-x-2">
                <p class=""><span class="text-blue-500 text-xs">MK</span>
                    {{ $vehicle->vehicle_type->make }}
                </p>
                <p class=""><span class="text-blue-500 text-xs">MD</span>
                    {{ $vehicle->vehicle_type->model }}
                </p>
                <p class="ml-3"><span class="text-blue-500 text-xs">CL</span>
                    {{ $vehicle->color }}
                </p>
                <p class="ml-3">
                    <span
                        class="text-blue-500 text-xs">EX</span> {{ $vehicle->expires_at->format(get_setting('general.dateFormat')) }}
                </p>
            </div>
            <div class="uppercase text-lg font-bold">
                @if ($vehicle->status == \App\Enum\VehicleStatus::Valid)
                    @if ($vehicle->expires_at <= now())
                        <span class="text-red-500">EXPIRED</span>
                    @else
                        <span class="text-green-500">VALID</span>
                    @endif
                @elseif($vehicle->status == \App\Enum\VehicleStatus::Expired)
                    <span class="text-red-500">EXPIRED</span>
                @elseif($vehicle->status == \App\Enum\VehicleStatus::Stolen)
                    <span class="text-red-500">Stolen</span>
                @elseif($vehicle->status == \App\Enum\VehicleStatus::Impounded || $vehicle->status == \App\Enum\VehicleStatus::Booted)
                    <span class="text-red-500">Impounded/Booted</span>
                @elseif($vehicle->status == \App\Enum\VehicleStatus::Pending)
                    <span class="text-blue-500">Pending</span>
                @endif
            </div>
        </div>
        <div>
            LINKS TO RENEW
        </div>
    </div>
</div>
