<?php

use Livewire\Volt\Component;
use App\Models\CallMessage;
use Illuminate\Support\Facades\Cache;

new class extends Component {
    public int $callId;
    public string $newMessage = '';

    protected $listeners = ['messageAdded' => '$refresh'];

    public function mount(int $callId): void
    {
        $this->callId = $callId;
    }

    public function sendMessage(): void
    {
        $this->validate([
            'newMessage' => 'required|string|max:1000',
        ]);

        CallMessage::create([
            'call_id' => $this->callId,
            'officer_id' => auth()->user()->active_unit->officer->id,
            'message' => $this->newMessage,
        ]);

        $this->newMessage = '';
        $this->dispatch('messageAdded');
    }

    public function typing(): void
    {
        $officer = auth()->user()->active_unit->officer;
        $cacheKey = 'typing_users';

        // Get current array or empty
        $users = Cache::get($cacheKey, []);

        // Update this officer's timestamp
        $users[$officer->id] = now()->timestamp;

        // Save back to cache for 5 seconds
        Cache::put($cacheKey, $users, 5);
    }

    public function getActiveTypingUsersProperty(): array
    {
        $users = Cache::get('typing_users', []);

        $threshold = now()->subSeconds(5)->timestamp;

        // Only return officers who typed in the last 5 seconds
        $active = [];
        foreach ($users as $id => $ts) {
            if ($ts >= $threshold) {
                $officer = \App\Models\Officer::find($id);
                if ($officer) $active[] = $officer->name;
            }
        }

        return $active;
    }

    public function with(): array
    {
        return [
            'messages' => CallMessage::where('call_id', $this->callId)
                ->with('officer')
                ->orderBy('created_at', 'desc')
                ->get(),
            'activeTypingUsers' => $this->getActiveTypingUsersProperty(),
        ];
    }
};
?>

<div class="flex flex-col max-h-[600px] border rounded-lg dark:bg-[#0C1011]" wire:poll.visible.3s>
    <div class="flex-1 p-4 overflow-y-auto flex flex-col-reverse" id="chat-messages"
         x-init="
            const chat = $el;

            // Scroll to bottom (newest message)
            chat.scrollTop = chat.scrollHeight;

            // Auto-scroll when Livewire updates
            Livewire.hook('message.processed', () => {
                setTimeout(() => { chat.scrollTop = chat.scrollHeight }, 50);
            });
         "
    >
        <div class="text-sm text-gray-500 italic mt-2">
            @php $count = count($activeTypingUsers); @endphp
            @if($count === 1)
                {{ $activeTypingUsers[0] }} is typing...
            @elseif($count > 1)
                {{ implode(', ', array_slice($activeTypingUsers, 0, -1)) }}
                and {{ $activeTypingUsers[$count - 1] }} are typing...
            @endif
        </div>

        @forelse($messages as $msg)
            @php $isMe = $msg->officer_id === auth()->user()->active_unit->officer->id; @endphp
            <div class="mb-2 flex {{ $isMe ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-xs px-4 py-2 rounded-lg break-words
                    {{ $isMe ? 'bg-blue-600 text-white rounded-br-none' : 'bg-gray-200 text-gray-900 rounded-bl-none dark:bg-gray-700 dark:text-gray-200' }}">
                    <div class="text-sm">{{ $msg->message }}</div>
                    <div class="text-xs text-gray-300 mt-1 text-right">
                        {{ $msg->officer->name }} • {{ $msg->created_at->diffForHumans() }}
                    </div>
                </div>
            </div>
        @empty
            <div class="text-gray-400 text-sm text-center">No messages yet</div>
        @endforelse

    </div>

    <div class="p-2 border-t border-gray-200 dark:border-gray-700">
        <form wire:submit.prevent="sendMessage" class="space-y-2">
            <input type="text"
                   wire:model.defer="newMessage"
                   @keydown.debounce.500ms="$wire.typing()"
                   placeholder="Type a message..."
                   class="mdt-text-input"
            >
            <button type="submit"
                    class="btn btn-blue btn-md btn-rounded">
                Send
            </button>
        </form>
    </div>
</div>
