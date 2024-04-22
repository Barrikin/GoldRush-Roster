<?php

namespace App\Http\Requests;

use App\Models\Sop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateSopRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sop_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'sop' => [
                'required',
            ],
            'ranks.*' => [
                'integer',
            ],
            'ranks' => [
                'required',
                'array',
            ],
        ];
    }
}
