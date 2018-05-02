@extends('layouts.app')
@section('content')
<h2>Dashboard</h2><hr>
    <div class="row" style="margin-top: 18px">
       
        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-primary">
                <div class="card-block pb-0">


                    <p><a href="{{url('post')}}" style="color: #fff;">Post</a></p>
                </div>
                <div class="chart-wrapper px-3" style="height:70px;">
                    <canvas id="card-chart1" class="chart" height="70"></canvas>
                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-info">
                <div class="card-block pb-0">
                   <!--  <button type="button" class="btn btn-transparent active p-0 float-right">
                        <i class="icon-location-pin"></i>
                    </button> -->
    
                    <p><a href="{{url('about-kampongcham')}}" style="color: #fff;">Member</a></p>
                </div>
                <div class="chart-wrapper px-3" style="height:70px;">
                    <canvas id="card-chart2" class="chart" height="70"></canvas>
                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-warning">
                <div class="card-block pb-0">
                    <p><a href="{{url('page')}}" style="color: #fff;">Page</a></p>
                </div>
                <div class="chart-wrapper" style="height:70px;">
                    <canvas id="card-chart3" class="chart" height="70"></canvas>
                </div>
            </div>
        </div>
        <!--/.col-->

        <div class="col-sm-6 col-lg-3">
            <div class="card card-inverse card-danger">
                <div class="card-block pb-0">
                  <!--   <div class="btn-group float-right">
                        <button type="button" class="btn btn-transparent active dropdown-toggle p-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-settings"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </div> -->
                    <p><a href="{{url('slide')}}" style="color: #fff;">Slide</a></p>
                </div>
                <div class="chart-wrapper px-3" style="height:70px;">
                    <canvas id="card-chart4" class="chart" height="70"></canvas>
                </div>
            </div>
        </div>
        <!--/.col-->

    </div>
@endsection
