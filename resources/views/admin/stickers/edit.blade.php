@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.sticker.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.stickers.update", [$sticker->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="year">{{ trans('cruds.sticker.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="text" name="year" id="year" value="{{ old('year', $sticker->year) }}">
                @if($errors->has('year'))
                    <span class="text-danger">{{ $errors->first('year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sticker.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="sticker_number">{{ trans('cruds.sticker.fields.sticker_number') }}</label>
                <input class="form-control {{ $errors->has('sticker_number') ? 'is-invalid' : '' }}" type="number" name="sticker_number" id="sticker_number" value="{{ old('sticker_number', $sticker->sticker_number) }}" step="1">
                @if($errors->has('sticker_number'))
                    <span class="text-danger">{{ $errors->first('sticker_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sticker.fields.sticker_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address_id">{{ trans('cruds.sticker.fields.address') }}</label>
                <select class="form-control select2 {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address_id" id="address_id">
                    @foreach($addresses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('address_id') ? old('address_id') : $sticker->address->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sticker.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="boat_id">{{ trans('cruds.sticker.fields.boat') }}</label>
                <select class="form-control select2 {{ $errors->has('boat') ? 'is-invalid' : '' }}" name="boat_id" id="boat_id">
                    @foreach($boats as $id => $entry)
                        <option value="{{ $id }}" {{ (old('boat_id') ? old('boat_id') : $sticker->boat->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('boat'))
                    <span class="text-danger">{{ $errors->first('boat') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.sticker.fields.boat_helper') }}</span>
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