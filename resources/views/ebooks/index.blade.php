@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Ebook List&nbsp;&nbsp;
                    <a href="{{url('/ebook/create')}}" class="btn btn-link btn-sm">
                            New
                    </a>
                </div>
                <div class="card-block">
                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Title</th>
                                <th>Short Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($ebooks as $e)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a href="{{url('/ebook/detail/'.$e->id)}}" target="_blank">{{$e->title}}</a></td>
                                    <td>

                                    </td>
                                    <td>
                                    {{-- <a class="btn btn-xs btn-info"  href="{{url('/ebook/detail/'.$e->id)}}" title="Detail"><i class="fa fa-eye"></i></a> --}}
                                        <a class="btn btn-xs btn-primary"  href="{{url('/ebook/edit/'.$e->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger"  href="{{url('/ebook/delete/'.$e->id)}}" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{$ebooks->links()}}
                </div>
            </div>
        </div>
        
    </div>
@endsection