@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.reservation.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.reservations.update", [$reservation->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="address_id">{{ trans('cruds.reservation.fields.address') }}</label>
                <select class="form-control select2 {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address_id" id="address_id">
                    @foreach($addresses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('address_id') ? old('address_id') : $reservation->address->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="contact_name">{{ trans('cruds.reservation.fields.contact_name') }}</label>
                <input class="form-control {{ $errors->has('contact_name') ? 'is-invalid' : '' }}" type="text" name="contact_name" id="contact_name" value="{{ old('contact_name', $reservation->contact_name) }}">
                @if($errors->has('contact_name'))
                    <span class="text-danger">{{ $errors->first('contact_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.contact_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.reservation.fields.resource') }}</label>
                <select class="form-control {{ $errors->has('resource') ? 'is-invalid' : '' }}" name="resource" id="resource">
                    <option value disabled {{ old('resource', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Reservation::RESOURCE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('resource', $reservation->resource) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('resource'))
                    <span class="text-danger">{{ $errors->first('resource') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.resource_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date">{{ trans('cruds.reservation.fields.date') }}</label>
                <input class="form-control datetime {{ $errors->has('date') ? 'is-invalid' : '' }}" type="text" name="date" id="date" value="{{ old('date', $reservation->date) }}">
                @if($errors->has('date'))
                    <span class="text-danger">{{ $errors->first('date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.reservation.fields.date_helper') }}</span>
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