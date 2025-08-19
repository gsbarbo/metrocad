<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public array $columns = [];   // ['name' => 'Name', 'email' => 'Email']
    public string $model;        // Eloquent model class e.g. App\Models\User::class
    public string $editRoute = ''; // route name like "admin.users.edit"

    public array $filters = [];
    public string $sortField = '';
    public string $sortDirection = 'asc';

    protected array $queryString = ['filters', 'sortField', 'sortDirection'];

    public function updatingFilters(): void
    {
        $this->resetPage();
    }

    public function sortBy(string $field): void
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function with(): array
    {
        $query = $this->model::query();

        foreach ($this->filters as $field => $value) {
            if (!empty($value)) {
                $query->where($field, 'like', "%{$value}%");
            }
        }

        if ($this->sortField) {
            $query->orderBy($this->sortField, $this->sortDirection);
        }

        return [
            'rows' => $query->paginate(10),
        ];
    }

    public function clearFilters(): void
    {
        $this->filters = [];
        $this->sortField = '';
        $this->sortDirection = 'asc';

        $this->resetPage();
    }
}; ?>

<div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-navbar">
            <tr>
                @foreach($columns as $key => $label)
                    <th
                        class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider cursor-pointer select-none"
                        wire:click="sortBy('{{ $key }}')"
                    >
                        <div class="flex items-center gap-1">
                            {{ $label }}
                            @if ($sortField === $key)
                                @if ($sortDirection === 'asc')
                                    <span>▲</span>
                                @else
                                    <span>▼</span>
                                @endif
                            @endif
                        </div>
                    </th>
                @endforeach
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
            <tr>
                @foreach($columns as $key => $label)
                    <th class="px-6 py-2">
                        <input
                            type="text"
                            wire:model.live.debounce.500ms="filters.{{ $key }}"
                            placeholder="Search {{ strtolower($label) }}"
                            class="form-text-input max-w-xl"
                        >
                    </th>
                @endforeach
                <th class="px-6 py-2">
                    <button class="btn btn-gray btn-sm btn-rounded" wire:click="clearFilters">Clear Filters</button>
                </th>
            </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200 dark:bg-sidebar dark:divide-gray-700">
            @forelse($rows as $row)
                <tr>
                    @foreach($columns as $key => $label)
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                            {{ data_get($row, $key) }}
                        </td>
                    @endforeach
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route($editRoute, $row->id) }}" class="text-blue-600 hover:underline">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ count($columns) + 1 }}" class="px-6 py-4 text-center text-sm text-gray-500">
                        No results found.
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $rows->links() }}
        </div>
    </div>
</div>
