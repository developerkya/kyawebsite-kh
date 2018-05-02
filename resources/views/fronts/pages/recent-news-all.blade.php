@extends('layouts.front')
@section('content') 
<div class="container">
<div class="col-md-12">
    <div class="row">
        <div class="col-md-12">
            <h4 class="my-3">
                <img src="{{asset('front/img/Insights.png')}}" width="40"> 
                <b class="re-news">Recent News</b> 
            </h4>
            <hr class="hr-c">
        </div>
    </div>
</div>
</div>  
    <div class="container">
        <div class="col-md-12">
            <div class="row">
                @foreach($news as $n)
                <div class="col-md-3 portfolio-item">
                    <div class="card card-c h-100 mb-2">
                        <a href="{{url('recent-news/detail/'.$n->id)}}"><img class="img-fluid" src="{{asset('uploads/posts/250x250/'.$n->featured_image)}}" width="100%" alt=""></a>
                        <div class="card-body">
                            <a style="text-decoration:none;" href="{{url('recent-news/detail/'.$n->id)}}"><aside class="title">{{$n->title}}</aside></a>
                        <p class="card-text"> <a style="text-decoration:none; color: #666;" href="{{url('recent-news/detail/'.$n->id)}}">{{$n->short_description}}</a></p>
                            <a class="btn btn-info btn-readmore" href="{{url('recent-news/detail/'.$n->id)}}">Read More</a>
                        </div>
                    </div>
                    <p></p>
                </div>
                @endforeach
            </div>
            {{$news->links()}}
      </div>
    </div>
    <p><br></p>
    <p><br></p>
@endsection