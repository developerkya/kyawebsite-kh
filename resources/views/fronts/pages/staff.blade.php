@extends('layouts.front')
@section('content')   
<p><br></p>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h4 class="text-primary">{{$title}}</h4>
                <hr>
            </div>
        </div>
        <div class="row">
            @foreach($staffs as $s)
            <div class="col-md-3">
                <div class="card new-card h-100 text-center">
                    <a href="{{url('page/staff/detail/'.$s->id)}}"><img src="{{asset('uploads/staff/250x250/'.$s->photo)}}" width="250" style="border:1px solid #ccc"></a>
                    <div class="card-body">
                        <p></p>
                        <aside>
                            <a href="{{url('page/staff/detail/'.$s->id)}}" class="staff-name" style="text-decoration:none;">{{$s->full_name}}</a>
                        </aside>
                        <a href="{{url('page/staff/detail/'.$s->id)}}" style="text-decoration:none;">
                            <aside class="card-text">{{$s->position}}</aside>
                        </a>
                    </div>
                </div>
                <p><br></p>
            </div>
            @endforeach   
        </div>
    </div>
    <p><br></p>
@endsection