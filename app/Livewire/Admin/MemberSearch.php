<?php

namespace App\Livewire\Admin;

use App\Enum\User\UserStatuses;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class MemberSearch extends Component
{
    public $name_search;

    public $discordIdSearch;

    public $statusFilter;

    public $status_search;

    public $search_count;

    public $all_users_count;

    public $all_users;

    public $users;

    public function render()
    {
        $this->all_users_count = User::count();

        $this->users = User::when($this->statusFilter > 0, fn (Builder $query) => $query->orWhere('status', $this->statusFilter))
            ->when($this->name_search !== '', fn (Builder $query) => $query->where(function (Builder $query) {
                $query->where('discord_name', 'like', '%'.$this->name_search.'%')
                    ->orWhere('display_name', 'like', '%'.$this->name_search.'%')
                    ->orWhere('discord_username', 'like', '%'.$this->name_search.'%');
            }))
            ->when($this->discordIdSearch !== '', fn (Builder $query) => $query->where('id', 'like', '%'.$this->discordIdSearch.'%'))
            ->get();

        $this->search_count = $this->users->count();

        // dd(UserStatuses::cases());

        return view('livewire.admin.member-search', ['user_statuses' => UserStatuses::cases()]);
    }

    public function resetFilters()
    {
        $this->reset();
    }
}
