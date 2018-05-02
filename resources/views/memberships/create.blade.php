@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> New Membership&nbsp;&nbsp;
                    <a href="{{url('/membership')}}" class="btn btn-link btn-sm">Back To List</a>
                </div>
                <div class="card-block">
                    @if(Session::has('sms'))
                        <div class="alert alert-success" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms')}}
                            </div>
                        </div>
                    @endif
                    @if(Session::has('sms1'))
                        <div class="alert alert-danger" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div>
                                {{session('sms1')}}
                            </div>
                        </div>
                    @endif

                    <form 
                    	action="{{url('/membership/save')}}" 
                    	class="form-horizontal" 
                        method="post"
                        enctype="multipart/form-data"  
                    >
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="khmer_first_name" class="control-label col-lg-2 col-sm-2">
                            	Khmer First Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <input type="text" required autofocus name="khmer_first_name" class="form-control">
                            </div>
                            <label for="khmer_family_name" class="control-label col-lg-2 col-sm-2">
                            	Khmer Family Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <input type="text" required  name="khmer_family_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="english_first_name" class="control-label col-lg-2 col-sm-2">
                                English First Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <input type="text" required  name="english_first_name" class="form-control">
                            </div>
                            <label for="engish_family_name" class="control-label col-lg-2 col-sm-2">
                             English Family Name <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <input type="text" required  name="english_family_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="english_first_name" class="control-label col-lg-2 col-sm-2">
                                Date of Birth <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <input type="text" required  name="date_of_birth"  class="form-control">
                            </div>
                            <label for="gender" class="control-label col-lg-2 col-sm-2">
                                Gender <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <select class="form-control" name="gender" required>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="place_of_birth" class="control-label col-lg-2 col-sm-2">
                                Place of Birth <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <textarea name="place_of_birth" class="form-control" required></textarea>
                            </div>
                            <label for="current_address" class="control-label col-lg-2 col-sm-2">
                                Current Address <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                            <textarea name="current_address" class="form-control"​ required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="control-label col-lg-2 col-sm-2">
                                Phone Number <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <input type="text" required  name="phone" id="phone" class="form-control">
                            </div>
                            <label for="email" class="control-label col-lg-2 col-sm-2">
                                Email <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <input type="email" required  name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="gender" class="control-label col-lg-2 col-sm-2">
                                Receive Newsletter <span class="text-danger">*</span>
                            </label>
                            <div class="col-lg-4 col-sm-4">
                                <select class="form-control" name="receive_newsletter" required>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <label for="photo" class="control-label col-sm-2">Photo <span class="text-danger">(4x6)</span></label>
                            <div class="col-sm-4">
                                <input type="file" name="photo" required accept="image/*" id="photo" class="form-control" onchange="loadFile(event)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-lg-2 col-sm-2">Social URL</label>
                            <div class="col-lg-4 col-sm-4">
                                <input type="text" class="form-control" name="social_url">
                                <p></p>
                                <p>
                                    <button class="btn btn-primary" type="submit">Save</button>
                                    <button class="btn btn-danger" type="reset">Cancel</button>
                                </p>
                               
                            </div>
                            <label class="control-label col-sm-2"></label>
                            <div class="col-sm-4">
                                <p>
                                    <img src="{{asset('public/uploads/members/member.png')}}" alt="" id="img" width="120">
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script type="text/javascript">
    function loadFile(e)
    {
        var output = document.getElementById('img');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script> 
@endsection