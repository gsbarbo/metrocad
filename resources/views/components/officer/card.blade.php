<div class="max-w-xl">
    <div class="bg-gray-300 text-black rounded-lg text-sm border border-blue-600">
        <div class="rounded-t-lg px-1 flex justify-between items-center text-white bg-blue-600">
            <p class="text-lg font-bold">{{ strtoupper(get_setting('names.state')) }}</p>
            <p class="text-sm">
                Public Safety Officer ID Card
            </p>
        </div>
        <div class="flex justify-between mt-1">
            <div class="p-2 mx-auto text-center">
                <div class="h-32 w-32">
                    @if (is_null($officer->picture))
                        <svg class="w-20 h-20" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"
                                stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @else
                        <img alt="" class="" src="{{ $officer->picture }}">
                    @endif
                </div>
                <p class="font-handwriting text-sm">{{ $officer->name }}</p>
            </div>
            <div class="p-2 uppercase">
                <p class="text-base font-semibold"><span class="text-xs font-light">Officer No.</span>
                    {{ $officer->id}}</p>

                <p class="text-base font-semibold">{{ $officer->last_name }}</p>
                <p class="text-base font-semibold">{{ $officer->first_name }}</p>
                @if($officer->user_department)
                    <p class="text-base font-semibold"><span class="text-xs font-light">Agency</span>
                        {{ $officer->user_department->department->name}}</p>
                @else
                    <p class="text-base font-semibold"><span class="text-xs font-light">Agency</span>
                        Not hired</p>
                @endif
            </div>
            <div class="p-2 relative">

            </div>
        </div>
    </div>
</div>
