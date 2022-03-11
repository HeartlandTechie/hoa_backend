@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.boat.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.id') }}
                        </th>
                        <td>
                            {{ $boat->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.type') }}
                        </th>
                        <td>
                            {{ $boat->type }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.description') }}
                        </th>
                        <td>
                            {{ $boat->description }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.boat.fields.address') }}
                        </th>
                        <td>
                            @foreach($boat->addresses as $key => $address)
                                <span class="label label-info">{{ $address->address }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boats.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#boat_stickers" role="tab" data-toggle="tab">
                {{ trans('cruds.sticker.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="boat_stickers">
            @includeIf('admin.boats.relationships.boatStickers', ['stickers' => $boat->boatStickers])
        </div>
    </div>
</div>

@endsection