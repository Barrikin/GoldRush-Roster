<?php

namespace App\Http\Requests;

use App\Models\Training;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTrainingRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('training_edit');
    }

    public function rules()
    {
        return [
            'officer_id' => [
                'required',
                'integer',
            ],
            'course_id' => [
                'required',
                'integer',
            ],
            'understood_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
            'executed_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
