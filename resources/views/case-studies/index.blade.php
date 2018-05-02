@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Case Study List&nbsp;&nbsp;
                    <a href="{{url('/case-study/create')}}" class="btn btn-link btn-sm">
                        New
                    </a>
                </div>
                <div class="card-block" style="padding: 0;">
                    <table class="table tbl">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Short Description</th>
                                <th>Creation Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($case_studies as $p)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><a href="{{url('/case-study/detail/'.$p->id)}}" title="Edit">{{$p->title}}</a></td>
                                    <td>{{$p->short_description}}</td>
                                    <td>{{$p->create_at}}</td>
                                    <td>
                                        <a class="btn btn-xs btn-info"  href="{{url('/case-study/edit/'.$p->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                       <a class="btn btn-xs btn-danger"  href="{{url('/case-study/delete/'.$p->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $case_studies->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection