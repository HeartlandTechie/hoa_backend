@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.minuteData.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minute-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.minuteData.fields.id') }}
                        </th>
                        <td>
                            {{ $minuteData->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minuteData.fields.filename') }}
                        </th>
                        <td>
                            @if($minuteData->filename)
                                <a href="{{ $minuteData->filename->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minuteData.fields.year_created') }}
                        </th>
                        <td>
                            {{ $minuteData->year_created }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.minuteData.fields.pdf_text') }}
                        </th>
                        <td>
                            {{ $minuteData->pdf_text }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.minute-datas.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection