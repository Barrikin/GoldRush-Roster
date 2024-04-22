<?php

namespace App\Http\Requests;

use App\Models\Comment;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCommentRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('comment_create');
    }

    public function rules()
    {
        return [
            'officer_id' => [
                'required',
                'integer',
            ],
            'author_id' => [
                'required',
                'integer',
            ],
            'comment' => [
                'required',
            ],
        ];
    }
}
