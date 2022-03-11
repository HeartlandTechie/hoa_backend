<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMinuteDataRequest;
use App\Http\Requests\StoreMinuteDataRequest;
use App\Http\Requests\UpdateMinuteDataRequest;
use App\Models\MinuteData;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MinuteDataController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('minute_data_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minuteDatas = MinuteData::with(['media'])->get();

        return view('admin.minuteDatas.index', compact('minuteDatas'));
    }

    public function create()
    {
        abort_if(Gate::denies('minute_data_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minuteDatas.create');
    }

    public function store(StoreMinuteDataRequest $request)
    {
        $minuteData = MinuteData::create($request->all());

        if ($request->input('filename', false)) {
            $minuteData->addMedia(storage_path('tmp/uploads/' . basename($request->input('filename'))))->toMediaCollection('filename');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $minuteData->id]);
        }

        return redirect()->route('admin.minute-datas.index');
    }

    public function edit(MinuteData $minuteData)
    {
        abort_if(Gate::denies('minute_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minuteDatas.edit', compact('minuteData'));
    }

    public function update(UpdateMinuteDataRequest $request, MinuteData $minuteData)
    {
        $minuteData->update($request->all());

        if ($request->input('filename', false)) {
            if (!$minuteData->filename || $request->input('filename') !== $minuteData->filename->file_name) {
                if ($minuteData->filename) {
                    $minuteData->filename->delete();
                }
                $minuteData->addMedia(storage_path('tmp/uploads/' . basename($request->input('filename'))))->toMediaCollection('filename');
            }
        } elseif ($minuteData->filename) {
            $minuteData->filename->delete();
        }

        return redirect()->route('admin.minute-datas.index');
    }

    public function show(MinuteData $minuteData)
    {
        abort_if(Gate::denies('minute_data_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.minuteDatas.show', compact('minuteData'));
    }

    public function destroy(MinuteData $minuteData)
    {
        abort_if(Gate::denies('minute_data_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $minuteData->delete();

        return back();
    }

    public function massDestroy(MassDestroyMinuteDataRequest $request)
    {
        MinuteData::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('minute_data_create') && Gate::denies('minute_data_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MinuteData();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
