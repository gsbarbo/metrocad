<div class="">
    <div class="bg-gray-300 text-black rounded-lg text-sm border border-gray-600">
        <div class="rounded-t-lg px-1 flex justify-between items-center text-white bg-gray-600">
            <p class="text-lg font-bold">{{ strtoupper(get_setting('state')) }}</p>
            <p class="text-sm">{{ $license->license_type->name }}</p>
        </div>
        <div class="flex justify-between mt-1">
            <div class="p-2 mx-auto text-center">
                <div class="h-32 w-32">
                    @if (is_null($civilian->picture))
                        <svg class="h-32 w-32 border-4 border-black" fill="none" stroke-width="1.5"
                            stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    @else
                        <img alt="" class="h-32 w-32 border-4 border-black" src="{{ $civilian->picture }}">
                    @endif
                </div>
                <p class="font-handwriting mt-2">{{ $civilian->name }}</p>
            </div>
            <div class="p-2 uppercase">
                <p class="text-base font-semibold"><span class="text-xs font-light">LIC. No.</span>
                    {{ $license->number }}</p>

                <p class="text-base font-semibold"><span class="text-xs font-light">DOB</span>
                    {{ $civilian->date_of_birth->format(get_setting('date_format')) }}</p>

                <p class="text-base font-semibold">{{ $civilian->last_name }}</p>
                <p class="text-base font-semibold">{{ $civilian->first_name }}</p>
                <p class="text-sm font-semibold">{{ $civilian->address->postal }} {{ $civilian->address->street }}</p>
                <p class="text-sm font-semibold">{{ $civilian->address->city }}, {{ get_setting('state') }}</p>

                <p class="text-base font-semibold"><span class="text-xs font-light">SEX</span>
                    {{ $civilian->gender }}</p>

                <p class="text-base font-semibold"><span class="text-xs font-light">HGT</span>
                    {{ $civilian->height }}</p>

                <p class="text-base font-semibold"><span class="text-xs font-light">WGT</span>
                    {{ $civilian->weight }}</p>

            </div>
            <div class="p-2 relative">
                <p class="text-base font-semibold"><span class="text-xs font-light">ISS</span>
                    {{ $license->created_at->format(get_setting('date_format')) }}</p>
                <p class="text-base font-semibold"><span class="text-xs font-light">EXP</span>
                    {{ $license->expires_at->format(get_setting('date_format')) }}</p>
                <div class="absolute bottom-0">
                    <p class="uppercase text-lg font-bold">
                        @if ($license->status == 1)
                            @if ($license->expires_at <= now())
                                <span class="text-red-500">EXPIRED</span>
                            @else
                                <span class="text-green-500">VALID</span>
                            @endif
                        @elseif($license->status == 2)
                            <span class="text-red-500">EXPIRED</span>
                        @elseif($license->status == 3)
                            <span class="text-red-500">Suspended</span>
                        @elseif($license->status == 4)
                            <span class="text-red-500">Revoked</span>
                        @elseif($license->status == 5)
                            <span class="text-blue-500">Pending</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
