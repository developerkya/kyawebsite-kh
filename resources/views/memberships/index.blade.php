@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Membership List&nbsp;&nbsp;
                    <a href="{{url('/membership/create')}}" class="btn btn-link btn-sm">
                        New
                    </a>
                    |&nbsp;&nbsp;<a href="{{url('/membership/export-excel')}}">Export Excel</a>
                </div>
                <div class="card-block">

                    <table class="tbl">
                        <thead>
                            <tr>
                                <th>&numero;</th>
                                <th>Photo</th>
                                <th>Khmer First Name</th>
                                <th>Khmer Family Name</th>
                                <th>English First Name</th>
                                <th>English Family Name</th>
                                <th>Phone</th>
                                <th>E-mail</th>
                                <th>Receive Newsletter</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php($i=1)
                            @foreach($memberships as $m)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td><img src="{{asset('public/uploads/members/'.$m->photo)}}" height="40" alt=""></td>
                                    <td>{{$m->khmer_first_name}}</td>
                                    <td>{{$m->khmer_family_name}}</td>
                                    <td>{{$m->english_first_name}}</td>
                                    <td>{{$m->english_family_name}}</td>
                                    <td>{{$m->phone}}</td>
                                    <td>{{$m->email}}</td>
                                    <td>{{$m->receive_newsletter}}</td>
                                    <td>
                                    <a class="btn btn-xs btn-info" href="{{url('/membership/detail/'.$m->id)}}" title="Edit"><i class="fa fa-eye"></i></a>
                                        <a class="btn btn-xs btn-primary" href="{{url('/membership/edit/'.$m->id)}}" title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-xs btn-danger" href="{{url('/membership/delete/'.$m->id)}}" onclick="return confirm('Do you want to delete?')" title="Delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table><br>
                    {{ $memberships->links() }}
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection