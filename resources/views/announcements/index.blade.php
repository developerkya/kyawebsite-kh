@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Up Coming Event List&nbsp;&nbsp;
                    <a href="{{url('/announcement/create')}}" class="btn btn-link btn-sm">
                        New
                    </a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Title</th>
                                <th>Location</th>
                                <th>Date Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($announcements as $ann)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$ann->title}}</td>
                                    <td>{{$ann->location}}</td>
                                    <td>{{$ann->date}} {{$ann->time}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary" href="{{url('/announcement/view/'.$ann->id)}}" title="view"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-xs btn-info" href="{{url('/announcement/edit/'.$ann->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger" href="{{url('/announcement/delete/'.$ann->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $announcements->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection