
@extends(backpack_view('blank'))


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.0.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@5.0.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/timegrid@5.0.0/main.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@5.0.0/main.min.css"/>


@php



@endphp

@section('content')

    {!! $calendar->calendar() !!}
    {!! $calendar->script() !!}

@endsection

