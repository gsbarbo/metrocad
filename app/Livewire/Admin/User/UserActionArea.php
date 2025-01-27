<?php

namespace App\Livewire\Admin\User;

use App\Models\History;
use App\Models\User;
use Livewire\Component;

class UserActionArea extends Component
{
    public $user;

    public $comment;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.admin.user.user-action-area');
    }

    public function unsuspend()
    {
        if ($this->comment == '') {
            session()->flash('alerts', [['message' => 'Comments are required to unsuspend an user.', 'level' => 'error']]);
        } else {
            if (auth()->user()->can('admin:user:unsuspend')) {
                History::create([
                    'subject_type' => 'user',
                    'subject_id' => $this->user->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'User unsuspend. Reason: '.$this->comment,
                ]);

                $this->user->update(['status' => 2]);
            }
        }

        return redirect(request()->header('Referer'));
    }

    public function unban()
    {
        if ($this->comment == '') {
            session()->flash('alerts', [['message' => 'Comments are required to unban an user.', 'level' => 'error']]);
        } else {
            if (auth()->user()->can('admin:user:unban')) {
                History::create([
                    'subject_type' => 'user',
                    'subject_id' => $this->user->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'User unban. Reason: '.$this->comment,
                ]);

                $this->user->update(['status' => 1, 'became_member_at' => null]);
            }
        }

        return redirect(request()->header('Referer'));
    }

    public function approve_member()
    {
        if ($this->comment == '') {
            session()->flash('alerts', [['message' => 'Comments are required to approve an user.', 'level' => 'error']]);
        } else {
            if (auth()->user()->can('admin:user:approve')) {
                History::create([
                    'subject_type' => 'user',
                    'subject_id' => $this->user->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'User approved. Reason: '.$this->comment,
                ]);

                $this->user->update(['status' => 2, 'became_member_at' => now()]);
            }
        }

        return redirect(request()->header('Referer'));
    }

    public function deny_member()
    {
        if ($this->comment == '') {
            session()->flash('alerts', [['message' => 'Comments are required to deny an user.', 'level' => 'error']]);
        } else {
            if (auth()->user()->can('admin:user:approve')) {
                History::create([
                    'subject_type' => 'user',
                    'subject_id' => $this->user->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'User denied. Reason: '.$this->comment,
                ]);

                $this->user->update(['status' => 6, 'became_member_at' => null]);
            }
        }

        return redirect(request()->header('Referer'));
    }

    public function reset_user()
    {
        if ($this->comment == '') {
            session()->flash('alerts', [['message' => 'Comments are required to reset an user.', 'level' => 'error']]);
        } else {
            if (auth()->user()->can('admin:user:status:reset')) {
                History::create([
                    'subject_type' => 'user',
                    'subject_id' => $this->user->id,
                    'user_id' => auth()->user()->id,
                    'description' => 'User Reset. Reason: '.$this->comment,
                ]);

                $this->user->update(['status' => 1, 'became_member_at' => null]);
            }
        }

        return redirect(request()->header('Referer'));
    }
}
