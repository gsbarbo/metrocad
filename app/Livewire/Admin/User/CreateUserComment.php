<?php

namespace App\Livewire\Admin\User;

use App\Models\History;
use App\Models\User;
use Livewire\Component;

class CreateUserComment extends Component
{
    public $comment;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;

    }

    public function render()
    {
        return view('livewire.admin.user.create-user-comment');
    }

    public function save()
    {
        History::create([
            'subject_type' => 'user',
            'subject_id' => $this->user->id,
            'user_id' => auth()->user()->id,
            'description' => 'Comment Added: '.$this->comment,
        ]);

        $this->reset();
        $this->dispatch('user-updated');
    }
}
