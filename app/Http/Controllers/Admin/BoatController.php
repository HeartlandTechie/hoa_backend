<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBoatRequest;
use App\Http\Requests\StoreBoatRequest;
use App\Http\Requests\UpdateBoatRequest;
use App\Models\Address;
use App\Models\Boat;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoatController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('boat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boats = Boat::with(['addresses'])->get();

        return view('admin.boats.index', compact('boats'));
    }

    public function create()
    {
        abort_if(Gate::denies('boat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addresses = Address::get()->pluck('address', 'id');

        return view('admin.boats.create', compact('addresses'));
    }

    public function store(StoreBoatRequest $request)
    {
        $boat = Boat::create($request->all());
        $boat->addresses()->sync($request->input('addresses', []));

        return redirect()->route('admin.boats.index');
    }

    public function edit(Boat $boat)
    {
        abort_if(Gate::denies('boat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addresses = Address::get()->pluck('address', 'id');

        $boat->load('addresses');

        return view('admin.boats.edit', compact('addresses', 'boat'));
    }

    public function update(UpdateBoatRequest $request, Boat $boat)
    {
        $boat->update($request->all());
        $boat->addresses()->sync($request->input('addresses', []));

        return redirect()->route('admin.boats.index');
    }

    public function show(Boat $boat)
    {
        abort_if(Gate::denies('boat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->load('addresses', 'boatStickers');

        return view('admin.boats.show', compact('boat'));
    }

    public function destroy(Boat $boat)
    {
        abort_if(Gate::denies('boat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boat->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoatRequest $request)
    {
        Boat::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
