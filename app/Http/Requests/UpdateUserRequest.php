<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'call_sign' => [
                'string',
                'required',
                'unique:users,call_sign,' . request()->route('user')->id,
            ],
            'name' => [
                'string',
                'required',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'array',
            ],
            'status' => [
                'required',
            ],
            'phone_number' => [
                'string',
                'required',
                'unique:users,phone_number,' . request()->route('user')->id,
            ],
            'hired_on' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time_zone' => [
                'string',
                'nullable',
            ],
            'email' => [
                'unique:users,email,' . request()->route('user')->id,
            ],
            'certifications.*' => [
                'integer',
            ],
            'certifications' => [
                'array',
            ],
            'rank_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
