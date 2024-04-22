<?php

namespace App\Http\Requests;

use App\Models\Sop;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySopRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('sop_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:sops,id',
        ];
    }
}
