<?php

namespace App\Http\Requests;

use App\Models\SopSignOff;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySopSignOffRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sop_sign_off_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sop_sign_offs,id',
        ];
    }
}
