@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="default-color my-4 text-primary">
                    <b>ករណីសិក្សា</b>
                    <hr>
                    </h5>
                    <div class="page-by-cat back">

                        <div class="row">
                            

                        @foreach($case_studies as $s)
                            <div class="col-sm-3" style="margin-bottom: 18px">
                                <div class="card">
                                    <a href="{{url('/case/study/'.$s->id)}}">
                                        <img src="{{asset('uploads/case-studies/250x250/'.$s->featured_image)}}" alt="">
                                    </a>
                                    <div class="card-body">
                                        <a href="{{url('/case/study/'.$s->id)}}"><strong>{{$s->title}}</strong></a>
                                        <p></p>
                                        <p class="card-text text-justify">
                                            {{$s->short_description}}
                                        </p>
                                        <a href="{{url('/case/study/'.$s->id)}}">អានបន្ត</a>
                                    </div>
                                </div>
                            </div>
                        
                        @endforeach
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                {{$case_studies->links()}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <p></p>
@endsection