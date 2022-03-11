@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.minuteData.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.minute-datas.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="filename">{{ trans('cruds.minuteData.fields.filename') }}</label>
                <div class="needsclick dropzone {{ $errors->has('filename') ? 'is-invalid' : '' }}" id="filename-dropzone">
                </div>
                @if($errors->has('filename'))
                    <span class="text-danger">{{ $errors->first('filename') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minuteData.fields.filename_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="year_created">{{ trans('cruds.minuteData.fields.year_created') }}</label>
                <input class="form-control date {{ $errors->has('year_created') ? 'is-invalid' : '' }}" type="text" name="year_created" id="year_created" value="{{ old('year_created') }}">
                @if($errors->has('year_created'))
                    <span class="text-danger">{{ $errors->first('year_created') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minuteData.fields.year_created_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="pdf_text">{{ trans('cruds.minuteData.fields.pdf_text') }}</label>
                <textarea class="form-control {{ $errors->has('pdf_text') ? 'is-invalid' : '' }}" name="pdf_text" id="pdf_text">{{ old('pdf_text') }}</textarea>
                @if($errors->has('pdf_text'))
                    <span class="text-danger">{{ $errors->first('pdf_text') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.minuteData.fields.pdf_text_helper') }}</span>
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
    Dropzone.options.filenameDropzone = {
    url: '{{ route('admin.minute-datas.storeMedia') }}',
    maxFilesize: 50, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 50
    },
    success: function (file, response) {
      $('form').find('input[name="filename"]').remove()
      $('form').append('<input type="hidden" name="filename" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="filename"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($minuteData) && $minuteData->filename)
      var file = {!! json_encode($minuteData->filename) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="filename" value="' + file.file_name + '">')
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