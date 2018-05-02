<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Khmer Youth Association">
        <meta name="keyword" content="KYA, Khmer Youth Association">

        <title>Khmer Youth Association</title>
        <link rel="icon" type="image/gif" href="{{asset('img/favicon.gif')}}" >
        <!-- Bootstrap core CSS -->
        <link href="{{asset('front/css/b.css')}}" rel="stylesheet">
        <link href="{{asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet">
    
        <!-- Custom styles for this template -->
        <link href="{{asset('front/css/4-col-portfolio.css')}}" rel="stylesheet">
       <style>
           .dropdown:hover .dropdown-menu{
               display: block;
               margin-top: 1px;
           }
       </style>
    </head>
    <body>
    <div class="container-fluit top-background">
        <div class="container">
            <div class="col-sm-12">
                <div class="row">   
                    <div class="col-md-12">  
                       <a href="{{url('/')}}"><img src="{{asset('front/img/kya-logo.png')}}" class="logo"></a> 
                       <div class="float-right c-lang">
                            <a href="#" class="text-default" onclick="chLang(event,'km')">
                                <img class="lang" src="{{asset('front/img/kh.png')}}"
                             width="40">ភាសាខ្មែរ</a>
                            <a href="#" class="text-default" onclick="chLang(event,'en')"><img class="lang" src="{{asset('front/img/en.png')}}" width="40"> English</a>
                        </div>
                    </div>
                    <div class="col-md-" style="margin-top: 50px;">
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <div class="col-sm-12" style="padding-left: 0">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav">
                        <?php 
                            $menus = DB::table('main_menus')->where('active',1)->orderBy('order_number')->get();
                        ?>
                        @foreach($menus as $m)
                            <?php $subs = DB::table('sub_menus')
                                ->where('active',1)
                                ->where('parent_id', $m->id)
                                ->orderBy('order_number')
                                ->get();
                            ?>
                            @if(count($subs)<=0)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url($m->url)}}">{{$m->name}}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle smenu" href="#" data-toggle="dropdown">
                                        {{$m->name}}
                                    </a>
                                    <div class="dropdown-menu">
                                        @foreach($subs as $s)
                                            <a class="dropdown-item" href="{{url($s->url)}}">{{$s->name}}</a>
                                        @endforeach
                                    </div>
                                </li>
                            @endif
                        @endforeach
                       
                    </ul>  
                    <ul class="ml-auto">
                        <form class="form-inline">
                            <input type="text" class="form-control mr-sm-1 search-box" placeholder="Search..." >
                            <button type="submit" class="btn btn-primary btn-c"><img src="{{asset('front/img/search-icon.png')}}"></button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    
    @yield('content')
        <?php
            $donors = DB::table('partners')->where('active',1)->orderBy('sequence')->get();
        ?>
        <div class="our-donor container">
            <div class="col-md-12 desktop"> 
                <div class="swiper-viewport">
                    <div id="carousel0" class="swiper-container">
                        <div class="swiper-wrapper"> 
                            <div class="swiper-slide text-center">
                                <?php $i=1;?>
                                @foreach($donors as $d)
                                    @if($i++==1)
                                        <img src="{{asset('partners/'.$d->logo)}}" alt="{{$d->name}}" height="100" width="130"></div>
                                    @else
                                        <div class="swiper-slide text-center"><img src="{{asset('partners/'.$d->logo)}}" alt="{{$d->name}}" height="100" width="130"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>  
                        <div class="swiper-pager">
                            <div class="swiper-button-next"></div>  
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mobile"> 
                <div class="swiper-viewport">
                    <div id="carousel1" class="swiper-container">
                        <div class="swiper-wrapper"> 
                            <div class="swiper-slide text-center">
                                <?php $i=1;?>
                                @foreach($donors as $d)
                                    @if($i++==1)
                                        <img src="{{asset('partners/'.$d->logo)}}" alt="{{$d->name}}" class="img-responsive"
                                        style="margin:0 auto;" width="150"></div>
                                    @else
                                        <div class="swiper-slide text-center"><img src="{{asset('partners/'.$d->logo)}}" alt="{{$d->name}}" class="img-responsive" width="150" style="margin: 0 auto"></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>  
                        <div class="swiper-pager">
                            <div class="swiper-button-next"></div>  
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('front/css/jq.js')}}"></script>
    <script src="{{asset('front/css/owl.carousel.min.js')}}"></script>

<script type="text/javascript">
    $('#carousel0').swiper({
        mode: 'horizontal',
        slidesPerView: 5,
        pagination: '.carousel0',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        autoplay: 3000,
        loop: true
        
    });
    $('#carousel1').swiper({
        mode: 'horizontal',
        slidesPerView: 1,
        pagination: '.carousel0',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        autoplay: 3000,
        loop: true
        
    });
</script>
<div class="container-fluit b">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-jutify">
                <div class="foot">
                    <h6 class="footer-title">ទំនាក់ទំនង</h6><p></p>
                    <i class="fa fa-map-marker"></i><span style='font-size:12px'>&nbsp;&nbsp;ផ្ទះ.​ ៣២D, ផ្លូវ. ៥៦២, សង្កាត់ បឹងកក់I, ខ័ណ្ឌទួលគោក, ភ្នំពេញ, ប្រទេសកម្ពុជា</span><br>
                    <i class="fa fa-phone"></i>&nbsp;&nbsp;+855 23 884 306<br>
                    <i class="fa fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:admin@kya-cambodia.org" style="color:#fff">admin@kya-cambodia.org</a>
                </div>
            </div>
            <div class="col-md-4 text-jutify">
                <div class="foot">
                    <h6 class="footer-title">ស្វែងរកពួកយើង</h6><p></p>
                    <p>
                        <a href="https://www.facebook.com/khmeryouthassociationkh" target="_blank">
                            <img src="{{asset('front/img/f.png')}}" height="35"> 
                        </a>
                        <a href="https://www.youtube.com/channel/UCTllsqUT494yi7__zFRHmhg/videos?view_as=subscriber" target="_blank">
                            <img src="{{asset('front/img/youtube.png')}}" height="35"> 
                        </a>
                       
                        <a href="https://twitter.com/intent/tweet?text=Khmer%20Youth%20Association&source=sharethiscom&related=sharethis&url=http%3A%2F%2Fkya-cambodia.org%2Fsite%2F%23sthash.ra2zGiVV.uxfs" target="_blank">
                            <img src="{{asset('front/img/t.png')}}" height="35">
                        </a>
                        <a href="https://www.flickr.com/photos/156488675@N08/" target="_blank">
                            <img src="{{asset('front/img/fl.png')}}" height="35"> 
                        </a>
                        
                        
                    </p>
                </div>
            </div>
            <div class="col-md-4 text-jutify">
                <div class="foot">
                        <h6 class="footer-title">ចូលទៅកាន់ WEB MAIL</h6> <p></p>
                        <form action="#" class="form-horizontal" method="post" >
                            
                            {{-- <div class="input-group mb-3 subscription">
                                <input type="email" class="form-control" placeholder="Email" id="email" required aria-label="Email" aria-describedby="basic-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn btn-success text-white" type="button" onclick="subscribe()">យល់ព្រម</button>
                                </div>
                               
                            </div>
                            <p id="sms" class="text-success" style="margin-top:8px"></p> --}}
                            <p>
                                សូមចុចប៊ូតុងខាងក្រោម ដើម្បីចូលទៅកាន់ Web Mail របស់អ្នក!
                            </p>
                            <p>
                                <a href="http://kya-cambodia.org/webmail" target="_blank" class="btn btn-success btn-sm">Web Mail</a>
                            </p>
                        </form>
            </div>
           

        </div>
    </div>
</div>
<script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('front/vendor/jquery/menu-hover.js')}}"></script>
<script>
    
     function chLang(evt, ln)
        {
            evt.preventDefault();
            $.ajax({
                type: "GET",
                url: "{{url('/')}}" + "/language/" + ln,
                success: function(sms){
                    if(sms>0)
                    {
                        location.reload();
                    }
                }
            });
        }
    function subscribe()
    {
        var id = $("#email").val();
        $.ajax({
            type: "GET",
            url: "{{url('/subscribe')}}/" + id,
            success: function(sms){
                $("#sms").html(sms);
                $("#email").val("");
            }
        });
    }
</script>
</body>
</html>