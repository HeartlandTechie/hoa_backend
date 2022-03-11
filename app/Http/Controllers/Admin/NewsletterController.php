<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNewsletterRequest;
use App\Http\Requests\StoreNewsletterRequest;
use App\Http\Requests\UpdateNewsletterRequest;
use App\Models\Newsletter;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class NewsletterController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('newsletter_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsletters = Newsletter::with(['media'])->get();

        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function create()
    {
        abort_if(Gate::denies('newsletter_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.create');
    }

    public function store(StoreNewsletterRequest $request)
    {
        $newsletter = Newsletter::create($request->all());

        if ($request->input('file_name', false)) {
            $newsletter->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_name'))))->toMediaCollection('file_name');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $newsletter->id]);
        }

        return redirect()->route('admin.newsletters.index');
    }

    public function edit(Newsletter $newsletter)
    {
        abort_if(Gate::denies('newsletter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.edit', compact('newsletter'));
    }

    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        $newsletter->update($request->all());

        if ($request->input('file_name', false)) {
            if (!$newsletter->file_name || $request->input('file_name') !== $newsletter->file_name->file_name) {
                if ($newsletter->file_name) {
                    $newsletter->file_name->delete();
                }
                $newsletter->addMedia(storage_path('tmp/uploads/' . basename($request->input('file_name'))))->toMediaCollection('file_name');
            }
        } elseif ($newsletter->file_name) {
            $newsletter->file_name->delete();
        }

        return redirect()->route('admin.newsletters.index');
    }

    public function show(Newsletter $newsletter)
    {
        abort_if(Gate::denies('newsletter_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.newsletters.show', compact('newsletter'));
    }

    public function destroy(Newsletter $newsletter)
    {
        abort_if(Gate::denies('newsletter_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newsletter->delete();

        return back();
    }

    public function massDestroy(MassDestroyNewsletterRequest $request)
    {
        Newsletter::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('newsletter_create') && Gate::denies('newsletter_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Newsletter();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
