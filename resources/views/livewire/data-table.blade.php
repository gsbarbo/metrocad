<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;

new class extends Component {
    use WithPagination;

    public array $columns = [];       // column configs
    public string $model;             // e.g. App\Models\User::class
    public string $editRoute = '';    // e.g. "admin.users.edit"
    public string $editId = 'id';

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
        $colConfig = $this->columns[$field] ?? null;
        $sortable = !is_array($colConfig) || ($colConfig['sortable'] ?? true);

        if (!$sortable) return;

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

        // eager load relation columns
        foreach ($this->columns as $config) {
            if (is_array($config) && isset($config['relation'])) {
                $query->with($config['relation']);
            }
        }

        // apply filters only if searchable
        foreach ($this->filters as $field => $value) {
            if (!empty($value)) {
                $colConfig = $this->columns[$field] ?? null;
                $searchable = !is_array($colConfig) || ($colConfig['searchable'] ?? true);

                if ($searchable) {
                    if (is_array($colConfig) && isset($colConfig['relation'])) {
                        $query->whereHas($colConfig['relation'], function (Builder $q) use ($colConfig, $value) {
                            $q->where($colConfig['display'], 'like', "%{$value}%");
                        });
                    } else {
                        $query->where($field, 'like', "%{$value}%");
                    }
                }
            }
        }

        // sorting only if sortable
        if ($this->sortField) {
            $colConfig = $this->columns[$this->sortField] ?? null;
            $sortable = !is_array($colConfig) || ($colConfig['sortable'] ?? true);

            if ($sortable) {
                $query->orderBy($this->sortField, $this->sortDirection);
            }
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
};
?>

<div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-navbar">
            <tr>
                @foreach($columns as $key => $colConfig)
                    @php
                        $label = is_array($colConfig) ? $colConfig['label'] : $colConfig;
                        $sortable = !is_array($colConfig) || ($colConfig['sortable'] ?? true);
                    @endphp
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider {{ $sortable ? 'cursor-pointer' : '' }}"
                        @if($sortable) wire:click="sortBy('{{ $key }}')" @endif>
                        {{ $label }}
                        @if($sortable && $sortField === $key)
                            {{ $sortDirection === 'asc' ? '↑' : '↓' }}
                        @endif
                    </th>
                @endforeach
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                    Actions
                </th>
            </tr>
            <tr>
                @foreach($columns as $key => $colConfig)
                    @php
                        $label = is_array($colConfig) ? $colConfig['label'] : $colConfig;
                        $searchable = !is_array($colConfig) || ($colConfig['searchable'] ?? true);
                    @endphp
                    <th class="px-6 py-2">
                        @if($searchable)
                            <input type="text"
                                   wire:model.live.debounce.500ms="filters.{{ $key }}"
                                   placeholder="Search {{ strtolower($label) }}"
                                   class="form-text-input max-w-xl">
                        @endif
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
                    @foreach($columns as $key => $colConfig)
                        <td class="px-6 py-4 whitespace-nowrap text-wrap text-sm text-gray-900 dark:text-gray-100">
                            @if (is_array($colConfig) && isset($colConfig['relation']))
                                {{ $row->{$colConfig['relation']}->pluck($colConfig['display'])->join(', ') }}
                            @else
                                {{ data_get($row, $key) }}
                            @endif
                        </td>
                    @endforeach
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route($editRoute, $row->$editId) }}" class="text-blue-600 hover:underline">Edit</a>
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
