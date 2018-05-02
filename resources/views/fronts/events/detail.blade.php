@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="default-color my-4 text-primary">
                    <b>Up Coming Event</b>
                    <hr>
                    </h5>
                    <div class="page-by-cat back">
                        <h5>{{$event->title}}</h5>
                        <p></p>
                        <div>
                            {!!$event->description!!}
                        </div>
                        <p></p>
                        <div>
                            Location: {{$event->location}}, Date-Time: {{$event->date}} {{$event->time}}
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <p></p>
@endsection