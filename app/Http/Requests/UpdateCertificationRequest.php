<?php

namespace App\Http\Requests;

use App\Models\Certification;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCertificationRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('certification_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
                'unique:certifications,name,' . request()->route('certification')->id,
            ],
        ];
    }
}
