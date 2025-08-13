<?php

use App\Models\Civilian;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;

new class extends Component {
    public array $linkedCivilians = [];
    public Collection $civilians;
    public string $civilianSearch = '';

    public function with(): array
    {
        $this->civilians = collect();
        if (!empty($this->civilianSearch)) {
            $this->civilians = Civilian::query()
                ->where('first_name', 'like', '%'.$this->civilianSearch.'%')
                ->orWhere('last_name', 'like', '%'.$this->civilianSearch.'%')
                ->get();
        }

        return [
            'civilians' => $this->civilians,
        ];
    }

    public function addCivilianToCall($civilianId, $civilianName): void
    {
        if (!in_array($civilianId, array_keys($this->linkedCivilians))) {
            $this->linkedCivilians[$civilianId] = $civilianName;
        }
        $this->civilianSearch = '';
    }

    public function removeCivilianFromCall($civilianId): void
    {
        unset($this->linkedCivilians[$civilianId]);
    }

};
?>

<div>
    <div class="flex">
        <div class="w-full text-white space-y-2">
            @forelse ($linkedCivilians as $id => $name)
                <div>
                    <input checked class="hidden" name="linked_civilians[]" type="checkbox"
                           value="{{ $id }}">
                    <label for="">
                        {{ $name }} |
                        <a class="text-red-600 hover:underline" href="#"
                           wire:click='removeCivilianFromCall("{{ $id }}")'>
                            Remove
                        </a>
                    </label>
                    <select class="mdt-select-input" id="" name="linked_civilians_types[]">
                        @foreach(\App\Enum\CallCivilianTypes::options() as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
            @empty
                <p></p>
            @endforelse
        </div>
    </div>
    <hr class="my-4">
    <div class="flex justify-between items-baseline">
        <div class="w-full">
            <label class="block mr-2">Search:</label>
            <input class="mdt-text-input" wire:model.live.debounce='civilianSearch'>
        </div>
    </div>
    <div class="flex">
        <div class="w-full my-3 text-white flex flex-wrap gap-2">
            @forelse ($civilians as $civilian)
                <a class="flex py-2 px-4 shadow-md no-underline rounded-full bg-green-600 text-white font-sans font-semibold text-sm border-green-600 btn-primary hover:text-white hover:bg-green-500 focus:outline-none active:shadow-none mr-2"
                   href="#"
                   wire:click='addCivilianToCall("{{ $civilian->id }}",
                    "{{ $civilian->name }}")'>
                    <svg class="w-4 h-4 mr-3" fill="none" stroke-width="1.5" stroke="currentColor"
                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round"
                              stroke-linejoin="round"/>
                    </svg>

                    {{ $civilian->name }}
                </a>
            @empty
                <p></p>
            @endforelse
        </div>
    </div>
</div>
