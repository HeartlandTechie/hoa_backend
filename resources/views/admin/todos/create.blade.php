@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.todo.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.todos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <div class="form-check {{ $errors->has('complete') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="complete" value="0">
                    <input class="form-check-input" type="checkbox" name="complete" id="complete" value="1" {{ old('complete', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="complete">{{ trans('cruds.todo.fields.complete') }}</label>
                </div>
                @if($errors->has('complete'))
                    <span class="text-danger">{{ $errors->first('complete') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.todo.fields.complete_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title">{{ trans('cruds.todo.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}">
                @if($errors->has('title'))
                    <span class="text-danger">{{ $errors->first('title') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.todo.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="user_id">{{ trans('cruds.todo.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id">
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <span class="text-danger">{{ $errors->first('user') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.todo.fields.user_helper') }}</span>
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