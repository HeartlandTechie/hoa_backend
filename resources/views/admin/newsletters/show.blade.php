@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.newsletter.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.newsletters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.newsletter.fields.id') }}
                        </th>
                        <td>
                            {{ $newsletter->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsletter.fields.file_name') }}
                        </th>
                        <td>
                            @if($newsletter->file_name)
                                <a href="{{ $newsletter->file_name->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsletter.fields.title') }}
                        </th>
                        <td>
                            {{ $newsletter->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsletter.fields.content') }}
                        </th>
                        <td>
                            {{ $newsletter->content }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsletter.fields.newsletter_date') }}
                        </th>
                        <td>
                            {{ $newsletter->newsletter_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.newsletter.fields.display_flag') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $newsletter->display_flag ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.newsletters.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection