<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class UpdateUser extends Component
{
    public $user;

    public $display_name;

    public $community_rank;

    public $became_member_at;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->display_name = $user->display_name;
        $this->community_rank = $user->community_rank;
        $this->became_member_at = $user->became_member_at?->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.admin.user.update-user');
    }

    public function save()
    {
        $this->user->update($this->only(['display_name', 'community_rank', 'became_member_at']));
        $this->dispatch('user-updated');
    }
}
