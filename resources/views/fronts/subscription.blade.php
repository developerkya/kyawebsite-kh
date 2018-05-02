@extends('layouts.shop_owner')
@section('content')

<div class="tab-pane">
        @if(Session::has('sms'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success border-radius-none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        {{session('sms')}}
                    </div>
                </div>
            </div>
        @endif
        @if(Session::has('sms1'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-danger border-radius-none" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        {{session('sms1')}}
                    </div>
                </div>
            </div>
        @endif
        @if($counter<=0)
            <div class="row">
                <div class="col-sm-12">
                    <strong class="text-danger">
                    @if(session('lang')=='en')
                        You don't have a subscription yet. Please do subscribe one of the following packages to be able post jobs.
                    @else
                        លោកអ្នកមិនទាន់បានទិញគម្រោងណាមួយនៅឡើយទេ។ សូមទិញគម្រោងណាមួយនៅខាងក្រោមនេះ។                            
                    @endif
                    </strong>
                    <p></p>
                </div>
            </div>
        @else
        <form action="{{url('/shop-owner/unsubscribe')}}" onsubmit="return confirm('You want to unsubscribe?')" method="post">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="{{$subscription->id}}">
            <input type="submit" value="Unsubscript" class="btn btn-danger">
        </form><br>
        <table class="table w-100">
            <thead>
            <tr>
                <th>Package Name</th>
                <th>Price</th>
                <th>Plan Type</th>
                <th>Expired Date</th>
                <th>Duration</th>
                <th>Total Product</th>
                <th>Product Remaining</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><span class="badge badge-secondary">{{$subscription->name}}</span></td>
                <td class="text-info">$ {{$subscription->price}}</td>
                <td>{{$subscription->type}}</td>
                <td class="text-danger">{{$subscription->expired_date}}</td>
                <td>{{$subscription->day_number}} days</td>
                <td>{{$subscription->product_number}}</td>
                <td>{{$subscription->product_number - $product_count}}</td>
                <td>{{$subscription->status==0?'Pending':'Approved'}}</td>
            </tr>
            </tbody>
        </table>
        @endif
        <hr>
        <div class="col-md-12">
            <div class="row"> 
                @foreach($packages as $package)
                    <div class="col-md-3 subscription">
                        <div class="panel-header">
                            <span class="badge badge-secondary">{{$package->name}}</span> <h5 class="text-info">$  {{$package->price}}</h5>
                        </div>
                        <div class="panel-body">
                            <aside>Number of Product : {{$package->product_number}}</aside> 
                            <aside> Number of Day: {{$package->day_number}}</aside> 
                            <aside> Type: {{$package->type}}</aside> 
                            @if($subscription)
                                <form action="{{url('/shop-owner/subscribe')}}" method="post" onsubmit="return confirm('You want to subscribe?')">
                                    {{csrf_field()}}
                                    <input type="hidden" id="package" name="package" value="{{$package->id}}">
                                    <input type="submit" class="btn btn-sm btn-secondary btn-block" value="Subscribe" {{$package->id==$subscription->package_id?'disabled':''}}>
                                </form>
                            @else
                                <form action="{{url('/shop-owner/subscribe')}}" method="post" onsubmit="return confirm('You want to subscribe?')">
                                    {{csrf_field()}}
                                    <input type="hidden" id="package" name="package" value="{{$package->id}}">
                                    <input type="submit" class="btn btn-sm btn-secondary btn-block" value="Subscribe">
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection