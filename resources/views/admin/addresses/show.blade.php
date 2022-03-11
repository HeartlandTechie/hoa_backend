@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.address.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.addresses.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.id') }}
                        </th>
                        <td>
                            {{ $address->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.address') }}
                        </th>
                        <td>
                            {{ $address->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.street_address') }}
                        </th>
                        <td>
                            {{ $address->street_address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.street_name') }}
                        </th>
                        <td>
                            {{ $address->street_name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.lot_number') }}
                        </th>
                        <td>
                            {{ $address->lot_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.rental_flag') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $address->rental_flag ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.address.fields.rental_owner') }}
                        </th>
                        <td>
                            {{ $address->rental_owner->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.addresses.index') }}">
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
            <a class="nav-link" href="#address_users" role="tab" data-toggle="tab">
                {{ trans('cruds.user.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#address_stickers" role="tab" data-toggle="tab">
                {{ trans('cruds.sticker.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#address_boats" role="tab" data-toggle="tab">
                {{ trans('cruds.boat.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="address_users">
            @includeIf('admin.addresses.relationships.addressUsers', ['users' => $address->addressUsers])
        </div>
        <div class="tab-pane" role="tabpanel" id="address_stickers">
            @includeIf('admin.addresses.relationships.addressStickers', ['stickers' => $address->addressStickers])
        </div>
        <div class="tab-pane" role="tabpanel" id="address_boats">
            @includeIf('admin.addresses.relationships.addressBoats', ['boats' => $address->addressBoats])
        </div>
    </div>
</div>

@endsection