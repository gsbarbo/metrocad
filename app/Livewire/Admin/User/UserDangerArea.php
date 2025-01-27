<?php

namespace App\Livewire\Admin\User;

use App\Models\History;
use App\Models\User;
use Livewire\Component;

class UserDangerArea extends Component
{
    public $comment;

    public $type;

    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.admin.user.user-danger-area');
    }

    public function save()
    {
        if ($this->comment == '') {
            session()->flash('alerts', [['message' => 'Comments are required to retire/suspend/ban an user.', 'level' => 'error']]);
        } else {

            if ($this->type === 'suspend') {
                if (auth()->user()->can('admin:user:suspend')) {
                    History::create([
                        'subject_type' => 'user',
                        'subject_id' => $this->user->id,
                        'user_id' => auth()->user()->id,
                        'description' => 'User Suspended. Reason: '.$this->comment,
                    ]);

                    $this->user->update(['status' => 3]);
                }
            } elseif ($this->type === 'ban') {
                if (auth()->user()->can('admin:user:ban')) {
                    History::create([
                        'subject_type' => 'user',
                        'subject_id' => $this->user->id,
                        'user_id' => auth()->user()->id,
                        'description' => 'User banned. Reason: '.$this->comment,
                    ]);

                    $this->user->update(['status' => 4, 'became_member_at' => null]);
                }
            } elseif ($this->type === 'retire') {
                if (auth()->user()->can('admin:user:retire')) {
                    History::create([
                        'subject_type' => 'user',
                        'subject_id' => $this->user->id,
                        'user_id' => auth()->user()->id,
                        'description' => 'User Retired. Reason: '.$this->comment,
                    ]);

                    $this->user->update(['status' => 5, 'became_member_at' => null]);
                }
            } else {
                dd('There has been a huge mistake.');
            }
        }

        return redirect(request()->header('Referer'));
    }
}
