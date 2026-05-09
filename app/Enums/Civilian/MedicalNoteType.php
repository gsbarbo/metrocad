<?php

namespace App\Enums\Civilian;

use App\Traits\BaseEnumTrait;

enum MedicalNoteType: string
{
    use BaseEnumTrait;

    case Allergy = 'allergy';
    case Condition = 'condition';
    case Medication = 'medication';
    case Injury = 'injury';
    case Note = 'note';

}
