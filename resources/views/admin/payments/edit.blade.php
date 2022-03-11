@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.payment.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payments.update", [$payment->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="address_id">{{ trans('cruds.payment.fields.address') }}</label>
                <select class="form-control select2 {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address_id" id="address_id">
                    @foreach($addresses as $id => $entry)
                        <option value="{{ $id }}" {{ (old('address_id') ? old('address_id') : $payment->address->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="year">{{ trans('cruds.payment.fields.year') }}</label>
                <input class="form-control {{ $errors->has('year') ? 'is-invalid' : '' }}" type="text" name="year" id="year" value="{{ old('year', $payment->year) }}">
                @if($errors->has('year'))
                    <span class="text-danger">{{ $errors->first('year') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.year_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('paid_in_full') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="paid_in_full" value="0">
                    <input class="form-check-input" type="checkbox" name="paid_in_full" id="paid_in_full" value="1" {{ $payment->paid_in_full || old('paid_in_full', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="paid_in_full">{{ trans('cruds.payment.fields.paid_in_full') }}</label>
                </div>
                @if($errors->has('paid_in_full'))
                    <span class="text-danger">{{ $errors->first('paid_in_full') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.payment.fields.paid_in_full_helper') }}</span>
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