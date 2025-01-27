<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadDepartmentPicture extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $photo;

    public $redirect;

    public $title;

    public $default_image = '';

    // public function save()
    // {
    //     if (is_null($this->photo)) {
    //         session()->flash('alerts', [['message' => 'Picture is not updated.', 'level' => 'error']]);
    //         $this->redirectRoute('admin.settings.department.index');
    //     } else {
    //         $path = $this->photo->storePubliclyAs('public/images/departments/', $this->department_name.'.'.$this->photo->extension());

    //         $url = url('storage/images/departments/'.$this->department_name.'.'.$this->photo->extension());
    //         $this->reset('photo');

    //         session()->flash('alerts', [['message' => $this->title.' picture updated.', 'level' => 'success']]);

    //         sleep(1);

    //         $this->redirectRoute($this->redirect);
    //     }

    // }

    public function render()
    {
        return view('livewire.admin.settings.upload-department-picture');
    }
}
