<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Officer extends Model
{
    use SoftDeletes;

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getFormattedNameAttribute()
    {
        switch (get_setting('mdt.officerNameFormat')) {
            case '{f}. {last}':
                $formatted_name = substr($this->first_name, 0, 1).'. '.$this->last_name;
                break;

            case '{first} {last}':
                $formatted_name = $this->fist_name.' '.$this->last_name;
                break;

            case '{first} {l}.':
                $formatted_name = $this->fist_name.' '.substr($this->last_name, 0, 1).'.';
                break;
            case '{last}, {first}':
                $formatted_name = $this->last_name.', '.$this->first_name;
                break;

            default:
                $formatted_name = $this->fist_name.' - '.$this->last_name;

                break;
        }

        return $formatted_name;
    }
}
