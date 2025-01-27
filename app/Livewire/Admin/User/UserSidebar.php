<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class UserSidebar extends Component
{
    public $user;

    protected $listeners = ['user-updated' => '$refresh'];

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.admin.user.user-sidebar');
    }
}
