@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="default-color my-4 text-primary">
                    <b>{{$page->title}}</b>
                    <hr>
                    </h5>
                    <div class="page-by-cat back">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="border-custom">
                                    <aside>{!!$page->description!!}</aside>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <p></p>
@endsection