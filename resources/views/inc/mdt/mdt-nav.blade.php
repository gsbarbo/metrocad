<header class="z-50 shadow-md  bg-[#171B1C] uppercase">
    <div class="text-white text-center flex items-center justify-between px-2 mx-auto py-1">
        <div class="flex gap-3 items-center">
            <img src="{{auth()->user()->active_unit->user_department->department->logo}}" class="size-10" alt="">
            <p class="font-bold text-center">
                {{ auth()->user()->active_unit->user_department->department->name }} |
                Mobile Data Terminal |
            </p>

            @livewire('mdt.components.dispatchStatus')

        </div>
        <form action="{{route('mdt.offDuty')}}" method="POST">
            @csrf
            <button class="flex" type="submit">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12"/>
                </svg>
            </button>
        </form>
    </div>
</header>

