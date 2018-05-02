@extends('layouts.front')
@section('content')
<h5 class="default-color my-4">
    <b>News and Education / ព័ត៌មានលម្អិត </b> <a  class="text-warning float-right" href="{{url('new-and-education/')}}"><< Back</a>
    <hr>
</h5>
<br>
    <div class="border-custom">
        <h4>{{$detail->title}}</h4><br>
        <small style="color: gray;"><img src="{{asset('front/img/date.png')}}" alt="date">  : {{$detail->create_at}}</small>
        <hr>
        <p>{!!$detail->description!!}</p><br>
        <p style="color: gray;"><b>អត្ថបទ ៖ {{$detail->create_by}}</b> </p>
    </div>
<br>
@endsection