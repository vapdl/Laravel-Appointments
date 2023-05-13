@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.consultation.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.consultation.update", [$consultation->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }} d-none">
                <label for="title">{{ trans('cruds.consultation.fields.title') }}</label>
                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($consultation) ? $consultation->title : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.consultation.fields.title_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('start') ? 'has-error' : '' }}">
                <label for="start">{{ trans('cruds.consultation.fields.start') }}</label>
                <input type="text" id="start" disabled name="start" class="form-control date" value="{{ old('start', isset($consultation) ? $consultation->start : '') }}">
                @if($errors->has('start'))
                    <em class="invalid-feedback">
                        {{ $errors->first('start') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.consultation.fields.start_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('nday') ? 'has-error' : '' }}">
                <label for="nday">{{ trans('cruds.consultation.fields.nday') }}</label>
                <input type="number" id="nday" name="nday" class="form-control" value="{{ old('nday', isset($consultation) ? $consultation->nday : '') }}">
                @if($errors->has('nday'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nday') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.consultation.fields.nday_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('employee_id') ? 'has-error' : '' }} d-none">
                <label for="employee_id">{{ trans('cruds.consultation.fields.employee_id') }}</label>
                <input type="number" id="employee_id" name="employee_id" class="form-control" value="{{ old('employee_id', isset($consultation) ? $consultation->employee_id : '') }}">
                @if($errors->has('employee_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('employee_id') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.consultation.fields.employee_id_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('end') ? 'has-error' : '' }} d-none">
                <label for="end">{{ trans('cruds.consultation.fields.end') }}</label>
                <input type="text" id="end" name="end" class="form-control date" value="{{ old('end', isset($consultation) ? $consultation->end : '') }}">
                @if($errors->has('end'))
                    <em class="invalid-feedback">
                        {{ $errors->first('end') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.consultation.fields.end_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection