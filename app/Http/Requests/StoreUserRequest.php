<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_create');
    }

    public function rules()
    {
        return [
            'call_sign' => [
                'string',
                'required',
                'unique:users',
            ],
            'name' => [
                'string',
                'required',
            ],
            'badge' => [
                'required',
                'string',
                'unique:users,badge',
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
                'unique:users',
            ],
            'hired_on' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'time_zone' => [
                'string',
                'nullable',
            ],
            'password' => [
                'required',
            ],
            'email' => [
                'unique:users',
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
