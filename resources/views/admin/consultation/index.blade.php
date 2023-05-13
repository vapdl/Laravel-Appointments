@extends('layouts.admin')
@section('content')
    @can('consultation_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route("admin.consultation.create") }}">
                    {{ trans('global.add') }} {{ trans('cruds.consultation.title_singular') }}
                </a>
            </div>
        </div>
    @endcan

    <h3 class="page-title">{{ trans('global.systemConsultation') }}</h3>

    <div class="card">
        <div class="card-header">
            {{ trans('global.systemConsultation') }}
        </div>

        <div class="card-body">
            <link rel='stylesheet'
                  href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css'/>

            <div id="consultation"></div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
    <script>
       $(document).ready(function () {
        // page is now ready, initialize the calendar...
        events ={!! json_encode($events) !!};
        $('#consultation').fullCalendar({
          // put your options and callbacks here
          events: events,
          initialView: 'dayGridMonth'
        })
      })
    </script>

@stop
