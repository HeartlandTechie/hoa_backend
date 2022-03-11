@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sticker.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.stickers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sticker.fields.id') }}
                        </th>
                        <td>
                            {{ $sticker->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sticker.fields.year') }}
                        </th>
                        <td>
                            {{ $sticker->year }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sticker.fields.sticker_number') }}
                        </th>
                        <td>
                            {{ $sticker->sticker_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sticker.fields.address') }}
                        </th>
                        <td>
                            {{ $sticker->address->address ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sticker.fields.boat') }}
                        </th>
                        <td>
                            {{ $sticker->boat->type ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.stickers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection