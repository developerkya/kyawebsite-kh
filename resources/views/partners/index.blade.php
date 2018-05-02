@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Donor List&nbsp;&nbsp;
                    <a href="{{url('/donor/create')}}" class="btn btn-link btn-sm">New</a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Name</th>
                               
                                <th>logo</th>
                                <th>URL</th>
                                <th>Order &numero;</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($partners as $par)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$par->name}}</td>
                                   
                                    <td><img src="{{URL::asset('partners/').'/'.$par->logo}}" width="65"/></td>
                                    <td>{{$par->url}}</td>
                                    <td>{{$par->sequence}}</td>
                                    <td>
                                        <a class="btn btn-info btn-xs" href="{{url('/donor/edit/'.$par->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger btn-xs"  href="{{url('/donor/delete/'.$par->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $partners->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection