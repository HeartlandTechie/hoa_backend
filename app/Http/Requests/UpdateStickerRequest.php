<?php

namespace App\Http\Requests;

use App\Models\Sticker;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateStickerRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('sticker_edit');
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
