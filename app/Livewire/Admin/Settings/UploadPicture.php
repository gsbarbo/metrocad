<?php

namespace App\Livewire\Admin\Settings;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadPicture extends Component
{
    use WithFileUploads;

    #[Validate('image|max:1024')] // 1MB Max
    public $photo;

    public $title;

    public $help_text;

    public $setting_name;

    public function save()
    {
        if (is_null($this->photo)) {
            session()->flash('alerts', [['message' => 'Picture is not updated.', 'level' => 'error']]);
            $this->redirectRoute('admin.settings.general');
        } else {
            $path = $this->photo->storePubliclyAs('images', $this->setting_name.'.'.$this->photo->extension(), 'public');

            $url = url('storage/images/'.$this->setting_name.'.'.$this->photo->extension());
            $this->reset('photo');

            Setting::where('name', $this->setting_name)->first()->update(['value' => $url]);
            Cache::forget('settings');
            session()->flash('alerts', [['message' => $this->title.' picture updated.', 'level' => 'success']]);

            sleep(1);

            $this->redirectRoute('admin.settings.general');
        }

    }

    public function render()
    {
        return view('livewire.admin.settings.upload-picture');
    }
}
