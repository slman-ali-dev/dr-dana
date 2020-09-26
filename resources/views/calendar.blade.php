
@extends(backpack_view('blank'))

@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('backpack::common.calendar') }}
    </div>

    <div class="card-body">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' />

        <div id='calendar'></div>


    </div>
</div>
@endsection

@push('after_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>
    <script>
        $(document).ready(function(){
            events = {!! json_encode($events) !!};
            $("#calendar").fullCalendar({
                events:events,
            });
        });
    </script>
@endpush