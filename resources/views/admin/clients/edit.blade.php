@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.client.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.clients.update", [$client->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('document') ? 'has-error' : '' }}">
                <label for="document">{{ trans('cruds.client.fields.document') }}</label>
                <input type="text" id="document" name="document" class="form-control" value="{{ old('document', isset($client) ? $client->document : '') }}">
                @if($errors->has('document'))
                    <em class="invalid-feedback">
                        {{ $errors->first('document') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.document_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                <label for="name">{{ trans('cruds.client.fields.name') }}</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($client) ? $client->name : '') }}">
                @if($errors->has('name'))
                    <em class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('age') ? 'has-error' : '' }}">
                <label for="age">{{ trans('cruds.client.fields.age') }}</label>
                <input type="text" id="age" name="age" class="form-control" value="{{ old('age', isset($client) ? $client->age : '') }}">
                @if($errors->has('age'))
                    <em class="invalid-feedback">
                        {{ $errors->first('age') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.age_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                <label for="gender">{{ trans('cruds.client.fields.gender') }}</label>
                <input type="text" id="gender" name="gender" class="form-control" value="{{ old('gender', isset($client) ? $client->gender : '') }}">
                @if($errors->has('gender'))
                    <em class="invalid-feedback">
                        {{ $errors->first('gender') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.gender_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.client.fields.phone') }}</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', isset($client) ? $client->phone : '') }}">
                @if($errors->has('phone'))
                    <em class="invalid-feedback">
                        {{ $errors->first('phone') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.phone_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.client.fields.email') }}</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($client) ? $client->email : '') }}">
                @if($errors->has('email'))
                    <em class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                <label for="city">{{ trans('cruds.client.fields.city') }}</label>
                <input type="text" id="city" name="city" class="form-control" value="{{ old('city', isset($client) ? $client->city : '') }}">
                @if($errors->has('city'))
                    <em class="invalid-feedback">
                        {{ $errors->first('city') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.city_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('pathology') ? 'has-error' : '' }}">
                <label for="pathology">{{ trans('cruds.client.fields.pathology') }}</label>
                <input type="text" id="pathology" name="pathology" class="form-control" value="{{ old('pathology', isset($client) ? $client->pathology : '') }}">
                @if($errors->has('pathology'))
                    <em class="invalid-feedback">
                        {{ $errors->first('pathology') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.client.fields.pathology_helper') }}
                </p>
            </div>
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>


    </div>
</div>
@endsection