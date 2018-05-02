@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="default-color my-4 text-primary">
                    <b>Up Coming Events</b>
                    </h5>
                    <div class="page-by-cat back">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <th>&numero;</th>
                                    <th>Title</th>
                                    <th>Location</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i=1)
                                @foreach($events as $e)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>
                                            <a href="{{url('/event/'.$e->id)}}">{{$e->title}}</a>
                                        </td>
                                        <td>{{$e->location}}</td>
                                        <td>{{$e->date}} {{$e->time}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{$events->links()}}
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <p></p>
@endsection