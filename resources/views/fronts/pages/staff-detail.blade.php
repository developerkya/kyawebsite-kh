@extends('layouts.front')
@section('content')   
<p><br></p>
    <div class="container">
        <p align="left" style="font-size: 27px;">
            <b>{{$s->full_name}}</b>
        </p>
        <div class="row">
            <div class="col-md-4">
                <img class="card-img-top" src="{{asset('uploads/staff/'.$s->photo)}}" width="100%"></a>
            </div>
            
            <div class="col-md-8" >
                <aside class="card-text" style="font-size: 27px;">{{$s->position}}</aside><hr>
                <p>{!!$s->profile!!}</p>
            </div>
        </div>
    </div>
    <p><br></p>
    <p><br></p>
@endsection