@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.boat.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.boats.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="type">{{ trans('cruds.boat.fields.type') }}</label>
                <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                @if($errors->has('type'))
                    <span class="text-danger">{{ $errors->first('type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.boat.fields.description') }}</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" type="text" name="description" id="description" value="{{ old('description', '') }}">
                @if($errors->has('description'))
                    <span class="text-danger">{{ $errors->first('description') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="addresses">{{ trans('cruds.boat.fields.address') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('addresses') ? 'is-invalid' : '' }}" name="addresses[]" id="addresses" multiple>
                    @foreach($addresses as $id => $address)
                        <option value="{{ $id }}" {{ in_array($id, old('addresses', [])) ? 'selected' : '' }}>{{ $address }}</option>
                    @endforeach
                </select>
                @if($errors->has('addresses'))
                    <span class="text-danger">{{ $errors->first('addresses') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.boat.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection