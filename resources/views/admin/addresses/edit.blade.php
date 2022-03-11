@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.address.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.addresses.update", [$address->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="address">{{ trans('cruds.address.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', $address->address) }}">
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="street_address">{{ trans('cruds.address.fields.street_address') }}</label>
                <input class="form-control {{ $errors->has('street_address') ? 'is-invalid' : '' }}" type="text" name="street_address" id="street_address" value="{{ old('street_address', $address->street_address) }}">
                @if($errors->has('street_address'))
                    <span class="text-danger">{{ $errors->first('street_address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.street_address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="street_name">{{ trans('cruds.address.fields.street_name') }}</label>
                <input class="form-control {{ $errors->has('street_name') ? 'is-invalid' : '' }}" type="text" name="street_name" id="street_name" value="{{ old('street_name', $address->street_name) }}">
                @if($errors->has('street_name'))
                    <span class="text-danger">{{ $errors->first('street_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.street_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="lot_number">{{ trans('cruds.address.fields.lot_number') }}</label>
                <input class="form-control {{ $errors->has('lot_number') ? 'is-invalid' : '' }}" type="text" name="lot_number" id="lot_number" value="{{ old('lot_number', $address->lot_number) }}">
                @if($errors->has('lot_number'))
                    <span class="text-danger">{{ $errors->first('lot_number') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.lot_number_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('rental_flag') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="rental_flag" value="0">
                    <input class="form-check-input" type="checkbox" name="rental_flag" id="rental_flag" value="1" {{ $address->rental_flag || old('rental_flag', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="rental_flag">{{ trans('cruds.address.fields.rental_flag') }}</label>
                </div>
                @if($errors->has('rental_flag'))
                    <span class="text-danger">{{ $errors->first('rental_flag') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.rental_flag_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="rental_owner_id">{{ trans('cruds.address.fields.rental_owner') }}</label>
                <select class="form-control select2 {{ $errors->has('rental_owner') ? 'is-invalid' : '' }}" name="rental_owner_id" id="rental_owner_id">
                    @foreach($rental_owners as $id => $entry)
                        <option value="{{ $id }}" {{ (old('rental_owner_id') ? old('rental_owner_id') : $address->rental_owner->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('rental_owner'))
                    <span class="text-danger">{{ $errors->first('rental_owner') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.address.fields.rental_owner_helper') }}</span>
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