<?php

namespace App\Http\Requests\Mdt;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'report_type_id' => ['required'],
            'call_id' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
