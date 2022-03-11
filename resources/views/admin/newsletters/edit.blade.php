@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.newsletter.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.newsletters.update", [$newsletter->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="file_name">{{ trans('cruds.newsletter.fields.file_name') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file_name') ? 'is-invalid' : '' }}" id="file_name-dropzone">
                </div>
                @if($errors->has('file_name'))
                    <span class="text-danger">{{ $errors->first('file_name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.newsletter.fields.file_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.newsletter.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $newsletter->title) }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.newsletter.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="content">{{ trans('cruds.newsletter.fields.content') }}</label>
                <input class="form-control {{ $errors->has('content') ? 'is-invalid' : '' }}" type="text" name="content" id="content" value="{{ old('content', $newsletter->content) }}">
                @if($errors->has('content'))
                    <span class="text-danger">{{ $errors->first('content') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.newsletter.fields.content_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="newsletter_date">{{ trans('cruds.newsletter.fields.newsletter_date') }}</label>
                <input class="form-control date {{ $errors->has('newsletter_date') ? 'is-invalid' : '' }}" type="text" name="newsletter_date" id="newsletter_date" value="{{ old('newsletter_date', $newsletter->newsletter_date) }}">
                @if($errors->has('newsletter_date'))
                    <span class="text-danger">{{ $errors->first('newsletter_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.newsletter.fields.newsletter_date_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('display_flag') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="display_flag" value="0">
                    <input class="form-check-input" type="checkbox" name="display_flag" id="display_flag" value="1" {{ $newsletter->display_flag || old('display_flag', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="display_flag">{{ trans('cruds.newsletter.fields.display_flag') }}</label>
                </div>
                @if($errors->has('display_flag'))
                    <span class="text-danger">{{ $errors->first('display_flag') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.newsletter.fields.display_flag_helper') }}</span>
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

@section('scripts')
<script>
    Dropzone.options.fileNameDropzone = {
    url: '{{ route('admin.newsletters.storeMedia') }}',
    maxFilesize: 40, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 40
    },
    success: function (file, response) {
      $('form').find('input[name="file_name"]').remove()
      $('form').append('<input type="hidden" name="file_name" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file_name"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($newsletter) && $newsletter->file_name)
      var file = {!! json_encode($newsletter->file_name) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file_name" value="' + file.file_name + '">')
      this.options.maxFiles = this.options.maxFiles - 1
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection