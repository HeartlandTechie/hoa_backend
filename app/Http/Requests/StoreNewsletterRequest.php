<?php

namespace App\Http\Requests;

use App\Models\Newsletter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreNewsletterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('newsletter_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'nullable',
            ],
            'content' => [
                'string',
                'nullable',
            ],
            'newsletter_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}
