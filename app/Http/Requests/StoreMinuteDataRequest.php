<?php

namespace App\Http\Requests;

use App\Models\MinuteData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMinuteDataRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('minute_data_create');
    }

    public function rules()
    {
        return [
            'year_created' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
