<?php

namespace App\Http\Requests;

use App\Models\Disciplinary;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateDisciplinaryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('disciplinary_edit');
    }

    public function rules()
    {
        return [
            'officer_id' => [
                'required',
                'integer',
            ],
            'title' => [
                'string',
                'required',
            ],
            'points' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'issued_by_id' => [
                'required',
                'integer',
            ],
            'expire_at' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
        ];
    }
}
