<?php

namespace App\Http\Requests;

use App\Models\Address;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreAddressRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('address_create');
    }

    public function rules()
    {
        return [
            'address' => [
                'string',
                'nullable',
            ],
            'street_address' => [
                'string',
                'nullable',
            ],
            'street_name' => [
                'string',
                'nullable',
            ],
            'lot_number' => [
                'string',
                'nullable',
            ],
        ];
    }
}
