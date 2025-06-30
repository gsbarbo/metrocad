<div>
    <div class="grid md:grid-cols-3 gap-4">
        <div>
            <label class="label-dark" for="filterByDiscordId">Filter by Discord ID</label>
            <input class="form-text-input-dark" id="filterByDiscordId" placeholder="Discord ID" type="text"
                wire:model.live.debounce.500ms="discordIdSearch">
        </div>
        <div>
            <label class="label-dark" for="filterByName">Filter by Name</label>
            <input autofocus class="form-text-input-dark" id="filterByName"
                placeholder="Display Name/Discord Username/Discord Name" type="text"
                wire:model.live.debounce.500ms="name_search">
        </div>
        <div>
            <label class="label-dark" for="filterByStatus">Filter by Status</label>
            <select class="form-select-input-dark" id="filterByStatus" wire:model.live="statusFilter">
                <option selected value="0">All</option>
                @foreach ($user_statuses as $status)
                    <option selected value="{{ $status->value }}">{{ $status->name() }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <p class="text-sm my-2">Showing {{ $search_count }} user(s) out of {{ $all_users_count }} user(s).
        <a class="hover:underline" href="#" wire:click='resetFilters'>Click here to
            reset filters.</a>
    </p>
    <ul class="divide-y divide-gray-100" role="list">
        @forelse ($users as $user)
            @php $borderColor = 'border-'.$user->status->color().'-600'; @endphp

            <li class="flex justify-between gap-x-6 py-5 border-l-4 {{ $borderColor }} pl-2">
                <div class="flex min-w-0 gap-x-4">
                    <img alt="" class="h-12 w-12 flex-none rounded-full bg-gray-50" src="{{ $user->avatar }}">
                    <div class="min-w-0 flex-auto">
                        <p class="text-sm font-semibold leading-6 text-white">
                            <a class="hover:underline"
                                href="{{ route('admin.user.show', $user->id) }}">{{ $user->name }}
                                ({{ $user->discord_username }})
                                - {{ $user->community_rank }}</a>
                        </p>
                        <p class="mt-1 flex text-xs leading-5 text-gray-200">
                            {{ $user->id }}
                        </p>
                    </div>
                </div>
                <div class="flex shrink-0 items-center gap-x-6">
                    <div class="hidden sm:flex sm:flex-col sm:items-end">
                        <p class="text-sm leading-6 text-white">{{ $user->status->name() }}</p>
                        <p class="mt-1 text-xs leading-5 text-gray-400">Last Login
                            {{ $user->last_login_at->format('m/d/Y') }}</p>
                    </div>
                    <div @click.away="open = false" class="relative flex-none" x-data="{ open: false }">
                        <button @click="open = !open" aria-expanded="false" aria-haspopup="true"
                            class="-m-2.5 block p-2.5 text-gray-300 hover:text-white" id="options-menu-0-button"
                            type="button">
                            <span class="sr-only">Open options</span>
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM10 8.5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zM11.5 15.5a1.5 1.5 0 10-3 0 1.5 1.5 0 003 0z" />
                            </svg>
                        </button>

                        <div aria-labelledby="options-menu-0-button" aria-orientation="vertical"
                            class="absolute right-0 z-10 mt-2 w-32 origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none"
                            role="menu" tabindex="-1" x-show="open">
                            <a class="block px-3 py-1 text-sm leading-6 text-gray-900"
                                href="{{ route('admin.user.show', $user->id) }}" id="options-menu-0-item-0"
                                role="menuitem" tabindex="-1">
                                View Profile
                            </a>
                        </div>
                    </div>
                </div>
            </li>

        @empty
            <p>No users found with given search. <a class="hover:underline" href="#"
                    wire:click='resetFilters'>Click here to
                    reset filters.</a></p>
        @endforelse
    </ul>
</div>
