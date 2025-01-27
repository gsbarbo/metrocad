<?php

namespace App\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;

class UpdateUserPermissions extends Component
{
    public $user;

    public $is_protected_user;

    public $is_super_user;

    public $is_owner;

    public function mount(User $user)
    {
        $this->user = $user;
        $this->is_protected_user = $user->is_protected_user;
        $this->is_super_user = $user->is_super_user;
        $this->is_owner = $user->is_owner;
    }

    public function render()
    {
        return view('livewire.admin.user.update-user-permissions');
    }

    public function updated($name, $value)
    {
        $this->user->update([
            $name => $value,
        ]);
        $this->dispatch('user-updated');
    }
}
