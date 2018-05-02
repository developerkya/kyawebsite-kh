@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Detail Case Study&nbsp;&nbsp;
                    <a href="{{url('/case-study')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    <div class="form-group row">
                        <label for="title" class="control-label col-lg-6 col-sm-6">
                            <aside class="text-primary">Title</aside>
                            <aside>{{$case_study->title}}</aside>
                        </label>
                        <label for="title" class="control-label col-lg-6 col-sm-6">
                            <aside class="success"><small class="text-danger">Create Date: {{$case_study->create_at}}</small> </aside>
                        </label>
                    </div>
                    <div class="form-group row">
                        <label for="title" class="control-label col-lg-6 col-sm-12">
                            <aside class="text-primary">Short Description</aside>
                            <aside>{{$case_study->short_description}}</aside><br>
                        </label>
                        <div class="col-lg-6 col-sm-6">
                            <aside class="text-primary">Featured Image</aside>
                            @if($case_study->featured_image != null) 
                            <img src="{{asset('uploads/case-studies/250x250/'.$case_study->featured_image)}}" width="150">
                            @else 
                            <img src="{{asset('front/img/default.svg')}}" width="150">
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="control-label col-lg-12 col-sm-12">
                            <p class="text-primary">Description</p>
                            <p>{!!$case_study->description!!}</p>
                        </label>
                    </div>       
                </div>
            </div>
        </div>
    </div>
@endsection