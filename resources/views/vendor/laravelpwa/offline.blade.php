@extends('layouts.app')

@section('content')

    <div>
        <div class="container">
            <div class="row justify-content-center>">
                <div class="col md-8">
                    <img class="img-fluid" src="{{ asset('images/icons/offline.jpg') }}" alt="Offline">
                    <div class="alert alert-light alert-important">
                        <h1 class="text-center">{{ trans('global.offline') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection