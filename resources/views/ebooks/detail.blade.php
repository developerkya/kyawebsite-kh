@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Detail Ebook&nbsp;&nbsp;
                    <a href="{{url('/ebook')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                   <div class="row">
                       <div class="col-sm-9">
                        <h4>Title</h4>
                        <div>
                            {{$ebook->title}}
                        </div>
                        <p></p>
                        <h4>Short Description</h4>
                        <div>
                            {{$ebook->short_description}}
                        </div>
                        <p></p>
                        <h4>Description</h4>
                        <div>
                            {!!$ebook->description!!}
                        </div>
                       </div>
                       <div class="col-sm-3">
                            <img src="{{asset('uploads/ebooks/'.$ebook->featured_photo)}}" alt="" width="150">
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection