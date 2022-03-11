<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAddressRequest;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Models\Address;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('address_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addresses = Address::with(['rental_owner'])->get();

        return view('admin.addresses.index', compact('addresses'));
    }

    public function create()
    {
        abort_if(Gate::denies('address_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rental_owners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.addresses.create', compact('rental_owners'));
    }

    public function store(StoreAddressRequest $request)
    {
        $address = Address::create($request->all());

        return redirect()->route('admin.addresses.index');
    }

    public function edit(Address $address)
    {
        abort_if(Gate::denies('address_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rental_owners = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $address->load('rental_owner');

        return view('admin.addresses.edit', compact('address', 'rental_owners'));
    }

    public function update(UpdateAddressRequest $request, Address $address)
    {
        $address->update($request->all());

        return redirect()->route('admin.addresses.index');
    }

    public function show(Address $address)
    {
        abort_if(Gate::denies('address_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->load('rental_owner', 'addressUsers', 'addressStickers', 'addressBoats');

        return view('admin.addresses.show', compact('address'));
    }

    public function destroy(Address $address)
    {
        abort_if(Gate::denies('address_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $address->delete();

        return back();
    }

    public function massDestroy(MassDestroyAddressRequest $request)
    {
        Address::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
