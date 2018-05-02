@extends('layouts.front')
@section('content')   
<p><br></p>
    <div class="container">
        <p align="left" style="font-size: 27px;">
            <b>{{$news->title}}</b>
            <aside class="text-info">Create date: {{$news->create_at}}</aside>
        </p><hr>
        
        <div class="row">
            <div class="col-md-12" >
                <aside class="card-text">{!!$news->description!!}</aside><hr>
            </div>
        </div>
    </div>
    <p><br></p>
    <p><br></p>
@endsection