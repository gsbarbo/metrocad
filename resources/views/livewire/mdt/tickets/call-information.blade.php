<?php

use App\Models\Address;
use App\Models\Call;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Livewire\Volt\Component;

new class extends Component {

    public int $callId;

    public Call|null $call;

    public Collection $recentCalls;

    public function with(): array
    {
        $this->recentCalls = Call::where('created_at', '>', now()->subDay(4))->orWhere('status', 'not like',
            'clo-%')->get();

        $this->call = null;
        if (!empty($this->callId) && $this->callId > 0) {
            $this->call = Call::find($this->callId);
        }

        return ['call' => $this->call];
    }
}

?>

<div class="px-5 py-2 space-y-2">

    <x-forms.select name="call_id" label="Call Number" mdt required wire:model.live="callId">
        <option value="">Choose Call</option>
        @foreach($recentCalls as $recentCall)
            <option @selected($recentCall->id == $callId) value="{{$recentCall->id}}">{{$recentCall->id}}</option>
        @endforeach
    </x-forms.select>

    @if($call)

        <x-forms.input name="call_id" label="" type="hidden"
                       mdt readonly>{{$call->id}}</x-forms.input>
        <x-forms.input name="" label="Call ID"
                       mdt readonly>{{$call->id}}</x-forms.input>
        <x-forms.input name="" label="Event Date" mdt
                       readonly>{{$call->created_at->format(get_setting('general.dateFormat') . ' H:i')}}</x-forms.input>

        <x-forms.input name="" label="Call Location"
                       mdt readonly>{{$call->full_address}}</x-forms.input>
        <x-forms.input name="" label="Call Nature"
                       mdt readonly>{{$call->nature->code()}} - {{$call->nature->label()}}</x-forms.input>
    @endif
</div>
