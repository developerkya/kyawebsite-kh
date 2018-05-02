@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Newsletter List&nbsp;&nbsp;
                    <a href="{{url('/newsletter/create')}}" class="btn btn-link btn-sm">
                        New
                    </a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($newsletters as $n)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$n->name}}</td>
                                    <td>{{$n->email}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-info" href="{{url('/newsletter/edit/'.$n->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger" href="{{url('/newsletter/delete/'.$n->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $newsletters->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection