<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyStickerRequest;
use App\Http\Requests\StoreStickerRequest;
use App\Http\Requests\UpdateStickerRequest;
use App\Models\Address;
use App\Models\Boat;
use App\Models\Sticker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StickerController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('sticker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $stickers = Sticker::with(['address', 'boat'])->get();

        return view('admin.stickers.index', compact('stickers'));
    }

    public function create()
    {
        abort_if(Gate::denies('sticker_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addresses = Address::get()->pluck('address', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.stickers.create', compact('addresses', 'boats'));
    }

    public function store(StoreStickerRequest $request)
    {
        $sticker = Sticker::create($request->all());

        return redirect()->route('admin.stickers.index');
    }

    public function edit(Sticker $sticker)
    {
        abort_if(Gate::denies('sticker_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $addresses = Address::get()->pluck('address', 'id')->prepend(trans('global.pleaseSelect'), '');

        $boats = Boat::pluck('type', 'id')->prepend(trans('global.pleaseSelect'), '');

        $sticker->load('address', 'boat');

        return view('admin.stickers.edit', compact('addresses', 'boats', 'sticker'));
    }

    public function update(UpdateStickerRequest $request, Sticker $sticker)
    {
        $sticker->update($request->all());

        return redirect()->route('admin.stickers.index');
    }

    public function show(Sticker $sticker)
    {
        abort_if(Gate::denies('sticker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sticker->load('address', 'boat');

        return view('admin.stickers.show', compact('sticker'));
    }

    public function destroy(Sticker $sticker)
    {
        abort_if(Gate::denies('sticker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sticker->delete();

        return back();
    }

    public function massDestroy(MassDestroyStickerRequest $request)
    {
        Sticker::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
