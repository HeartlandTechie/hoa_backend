<?php

namespace App\Http\Requests;

use App\Models\Boat;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBoatRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('boat_edit');
    }

    public function rules()
    {
        return [
            'type' => [
                'string',
                'nullable',
            ],
            'description' => [
                'string',
                'nullable',
            ],
            'addresses.*' => [
                'integer',
            ],
            'addresses' => [
                'array',
            ],
        ];
    }
}
