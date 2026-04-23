<?php

use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public array $toasts = [];

    public function mount(): void
    {
        if (session()->has('toast')) {
            $flashed = session('toast');
            $toasts = isset($flashed['message']) ? [$flashed] : $flashed;

            foreach ($toasts as $toast) {
                $this->toasts[] = array_merge(['id' => uniqid()], $toast);
            }
        }
    }

    #[On('toast')]
    public function add(string $message, string $type = 'success'): void
    {
        $this->toasts[] = ['id' => uniqid(), 'message' => $message, 'type' => $type];
    }

    public function dismiss(string $id): void
    {
        $this->toasts = array_values(
            array_filter($this->toasts, fn (array $toast) => $toast['id'] !== $id)
        );
    }
} ?>

<div class="fixed top-4 right-4 z-50 flex flex-col gap-2 pointer-events-none" aria-live="polite">
    @foreach ($toasts as $toast)
        @php
            $colorClass = match($toast['type']) {
                'error'   => 'bg-red-600 text-white',
                'warning' => 'bg-yellow-500 text-black',
                'info'    => 'bg-blue-600 text-white',
                default   => 'bg-green-600 text-white',
            };
        @endphp
        <div
            wire:key="toast-{{ $toast['id'] }}"
            x-data="{
                show: true,
                init() {
                    setTimeout(() => {
                        this.show = false
                        setTimeout(() => $wire.dismiss('{{ $toast['id'] }}'), 350)
                    }, 4000)
                }
            }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            class="pointer-events-auto flex items-center gap-3 px-4 py-3 rounded-lg shadow-lg text-sm font-medium min-w-64 max-w-sm {{ $colorClass }}"
        >
            <span class="flex-1">{{ $toast['message'] }}</span>
            <button wire:click="dismiss('{{ $toast['id'] }}')" class="opacity-70 hover:opacity-100 text-lg leading-none">&times;</button>
        </div>
    @endforeach
</div>
