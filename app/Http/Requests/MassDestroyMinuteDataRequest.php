<?php

namespace App\Http\Requests;

use App\Models\MinuteData;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyMinuteDataRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('minute_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:minute_datas,id',
        ];
    }
}
