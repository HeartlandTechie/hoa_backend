<?php

namespace App\Http\Requests;

use App\Models\Todo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateTodoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('todo_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
        ];
    }
}
