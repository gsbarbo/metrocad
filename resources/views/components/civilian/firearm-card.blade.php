<div class="bg-gray-200 rounded-lg p-2 text-black text-sm">
    <div class="">
        <p class="text-lg text-center">Serial Number</p>
    </div>
    <div class="mt-1 flex items-center justify-around">
        <p class="text-3xl text-center">{{ $firearm->serial_number }}</p>
    </div>
    <div class="mt-1 flex justify-between">
        <div class="flex space-x-2">
            <p class=""><span class="text-blue-500 text-xs">MK</span>
                {{ $firearm->model }}
            </p>
        </div>
        <div class="uppercase text-lg font-bold">
            @if ($firearm->status == App\Enum\FirearmStatus::Valid)
                <span class="text-green-500">VALID</span>
            @elseif($firearm->status == App\Enum\FirearmStatus::Stolen)
                <span class="text-red-500">Stolen</span>
            @elseif($firearm->status == App\Enum\FirearmStatus::ForSale)
                <span class="text-red-500">For Sale</span>
            @elseif($firearm->status == App\Enum\FirearmStatus::Impounded)
                <span class="text-red-500">Impounded</span>
            @elseif($firearm->status == App\Enum\FirearmStatus::Pending)
                <span class="text-blue-500">Pending</span>
            @endif
        </div>
    </div>
    <div class="border-t-2 border-black flex justify-between">

        <div>
            @if ($firearm->status == App\Enum\FirearmStatus::Valid)
                <span class="text-green-500">VALID</span>
            @elseif($firearm->status == App\Enum\FirearmStatus::Stolen)
                <span class="text-red-500">Stolen</span>
            @elseif($firearm->status == App\Enum\FirearmStatus::ForSale)
                <span class="text-red-500">For Sale</span>
            @elseif($firearm->status == App\Enum\FirearmStatus::Impounded)
                <span class="text-red-500">Impounded</span>
            @elseif($firearm->status == App\Enum\FirearmStatus::Pending)
                <span class="text-blue-500">Pending</span>
            @endif
        </div>

        <form
            action="{{ route('civilians.firearm.destroy', ['civilian' => $civilian->id, 'firearm' => $firearm->id]) }}"
            method="POST">
            @csrf
            @method('delete')
            <button type="submit" class="text-red-500">
                Delete
            </button>
        </form>
    </div>
</div>
