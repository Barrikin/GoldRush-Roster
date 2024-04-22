<?php

namespace App\Http\Requests;

use App\Models\SopSignOff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreSopSignOffRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sop_sign_off_create');
    }

    public function rules()
    {
        return [
            'officer_id' => [
                'required',
                'integer',
            ],
            'sop_id' => [
                'required',
                'integer',
            ],
            'signed_off_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
