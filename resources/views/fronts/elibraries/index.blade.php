@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="default-color my-4 text-primary">
                    <b>E-Library</b>
                    <hr>
                    </h5>
                    <div class="page-by-cat back">
                        <div class="row">
                        @foreach($elibraries as $s)
                            <div class="col-sm-6" style="margin-bottom: 18px">
                                <div class="row">
                                    <div class="col-sm-4">
                                        {{-- <a href="{{url('/elibrary/'.$s->id)}}"> --}}
                                            <img src="{{asset('uploads/ebooks/'.$s->featured_photo)}}" alt="" width="150">
                                        {{-- </a> --}}
                                    </div>
                                    <div class="col-sm-8">
                                        {{-- <a href="{{url('/elibrary/'.$s->id)}}"><strong></strong></a> --}}
                                        <strong>{{$s->title}}</strong>
                                        <p class="text-justify">
                                            {!!$s->short_description!!}
                                        </p>
                                        
                                    </div>
                                </div>
                                <p></p>
                            </div>
                        @endforeach
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                {{$elibraries->links()}}
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <p></p>
@endsection