@extends('layouts.front')
@section('content')
<?php 
    $j = 1;
    $i = 1;
?>
<div id="demo" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <?php $v = 1; ?>
        @foreach($slides as $s)
            @if($v == 1) 
         
            <div class="carousel-item active">
            <a href="{{$s->url}}">
                <img src="{{asset('front/slides/'.$s->photo)}}" alt="{{$s->name}}" width="100%">
              
                </a>
            </div>
          
            @else
            
            <div class="carousel-item">
            <a href="{{$s->url}}">
                <img src="{{asset('front/slides/'.$s->photo)}}" alt="{{$s->name}}" width="100%">
               
                </a> 
            </div>
           
            @endif
        <?php $v++;?>
        @endforeach
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
        <span class="carousel-control-next-icon"></span>
    </a>
</div>
    <div class="container-fluit b-image">
        <div class="container">
            <div class="row"> 
                <div class="col-md-6">  
                    <div class="greennature-action-ads-item-1">
                        <h4 class="text-primary mm">{{$mission->title}}</h4>
                        <hr class="hr-m">  
                        {!!$mission->description!!}
                    </div>
                </div>
                <div class="col-md-6 ">  
                    <div class="greennature-action-ads-item">
                        <h4 class="text-success mm">{{$vission->title}}</h4>
                        <hr class="hr-v">  
                        {!!$vission->description!!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row"> 
            <div class="col-md-12">
                <h4 class="my-3">
                    <img src="{{asset('front/img/Insights.png')}}" width="30"> 
                    <span class="re-news">ព័ត៌មានថ្មីៗ</span> 
                    <a href="{{url('recent-news/all')}}"><span class="more">មើលព័ត៌មានទាំងអស់ >></span></a>
                </h4>
                <hr class="hr-c">
                <!--Carousel Wrapper-->
<div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="col-md-c">
                <div class="row">
                    @for($i=0;$i<count($news);$i++)
                        <div class="col-md-3 portfolio-item">
                            <div class="card h-100 card-c mb-2">
                                <a href="{{url('recent-news/detail/'.$news[$i]->id)}}"><img class="img-fluid" src="{{asset('uploads/posts/250x250/'.$news[$i]->featured_image)}}" width="100%" alt=""></a>
                                <div class="card-body">
                                    <a style="text-decoration:none;" href="{{url('recent-news/detail/'.$news[$i]->id)}}"><aside class="title">{{$news[$i]->title}}</aside></a>
                                    <p class="card-text"><a  style="text-decoration:none;color: #333;"  href="{{url('recent-news/detail/'.$news[$i]->id)}}">{{$news[$i]->short_description}}</a></p>
                                    <a class="btn btn-info btn-readmore" href="{{url('recent-news/detail/'.$news[$i]->id)}}">អានបន្ត</a>
                                </div>
                            </div>
                        </div>
                        <?php 
                            if($i==3)
                            {
                                break;
                            }
                        ?>
                    @endfor
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="col-md-c">
                <div class="row">
                @if(count($news)>4)
                    @for($i=4;$i<count($news);$i++)
                    <div class="col-md-3 portfolio-item">
                        <div class="card h-100 card-c mb-2">
                            <a href="{{url('recent-news/detail/'.$news[$i]->id)}}"><img class="img-fluid" src="{{asset('uploads/posts/250x250/'.$news[$i]->featured_image)}}" alt="" width="100%"></a>
                            <div class="card-body">
                                <a style="text-decoration:none;" href="{{url('recent-news/detail/'.$news[$i]->id)}}"><aside class="title">{{$news[$i]->title}}</aside></a>
                                <p class="card-text"><a  style="text-decoration:none; color: #333;"  href="{{url('recent-news/detail/'.$news[$i]->id)}}">{{$news[$i]->short_description}}</a></p>
                                <a class="btn btn-info btn-readmore" href="{{url('recent-news/detail/'.$news[$i]->id)}}">អានបន្ត</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        if($i==7)
                        {
                            break;
                        }
                    ?>
                    @endfor
                @endif
                </div>
            </div>
        </div>
        <div class="controls-top">
            <div class="row">
                <div class="col-md-12 text-center">
                &nbsp;<a class="btn-floating btn-info text-white btn btn-sm-c" href="#multi-item-example" data-slide="prev"><</a>
                    <a class="btn-floating btn-info text-white  btn btn-sm-c" href="#multi-item-example" data-slide="next">></a></a>
                </div>
            </div>
        </div>
        <p></p>
    </div>

</div>
 </div>
</div>
    </div>
    <div class="container-fluit d-image">
        <div class="container">
            <div class="row"> 
                <div class="col-md-12 text-center">  
                   <div class="donate-box">
                        <h1 class="text-donate">The only way to make this happened is to take action!</h1>
                        <hr class="hr-d">
                        <a href="{{url('/page/21')}}" class="btn btn-lg-c btn-warning-c">
                            <b>ចូលរួមបរិច្ចាគ</b>
                        </a>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <?php $comings = DB::table('announcements')->orderBy('id','desc')->where('active', 1)->limit(15)->get(); $i = 1; ?>
    <div class="container-fluit announcements">
        <div class="container">
            <h4 class="text-center text-primary mm">ព្រឹត្តិការណ៍ថ្មីៗដែលនឹងមកដល់</h4> <hr class="hr-d">
            <div class="row">
                
                <div class="col-sm-12">
                    <?php 
                        $events = DB::table('announcements')->where('active',1)->orderBy('id', 'desc')->paginate(5);
                        $i=1;
                    ?>
                    <p></p>
                    @foreach($events as $e)
                    <p class="text-primary txt">{{$i++}}. <a href="{{url('/event/'.$e->id)}}">{{$e->title}}</a>
                        <br>
                        <span class="text-danger txt-small"><i class="fa fa-map-marker"></i> {{$e->location}} </span>
                        <span class="text-success txt-small"><i class="fa fa-calendar"></i> {{$e->date}} {{$e->time}}</span>
                    </p>
                    @endforeach
                    
                    
                </div>
                
               
            </div>
        </div>
    </div>
</div>
@endsection