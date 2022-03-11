<?php

namespace App\Http\Requests;

use App\Models\Sticker;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreStickerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sticker_create');
    }

    public function rules()
    {
        return [
            'year' => [
                'string',
                'nullable',
            ],
            'sticker_number' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
