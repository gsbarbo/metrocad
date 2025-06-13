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

    public function save() {}

    public function render()
    {
        return view('livewire.admin.settings.upload-department-picture');
    }
}
