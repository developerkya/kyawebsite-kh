@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-bold">
                    <i class="fa fa-align-justify"></i> Create New Staff&nbsp;&nbsp;
                    <a href="{{url('/admin/staff')}}" class="btn btn-link btn-sm">Back</a>
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

                    <form action="{{url('/admin/staff/save')}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                        {{csrf_field()}}
                       <div class="row">
                           <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="full_name" class="control-label col-sm-4">Full Name <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" required autofocus name="full_name" id="full_name" value="{{old('full_name')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="position" class="control-label col-sm-4">Position <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" required name="position" id="position" value="{{old('position')}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="section" class="control-label col-sm-4">Section <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="section" id="section" class="form-control">
                                            <option value="staff">Staff</option>
                                            <option value="board">Board</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="order_number" class="control-label col-sm-4">Order Number <span class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" required name="order_number" id="order_number" class="form-control" value="0">
                                    </div>
                                </div>
                                
                           </div>
                           <div class="col-sm-6">
                                <div class="form-group row">
                                    <label for="photo" class="control-label col-sm-4">Photo</label>
                                    <div class="col-sm-8">
                                        <input type="file" name="photo" id="photo" class="form-control" onchange="loadFile(event)">
                                        <p>
                                            <br>
                                            <img src="" alt="" id="preview" width="120">
                                        </p>
                                    </div>
                                    
                                </div>
                           </div>
                       </div>
                       <div class="row">
                           <div class="col-sm-12">
                                <p>
                                    Profile
                                </p>
                                <textarea name="profile" id="profile" cols="30" rows="10" class="form-control"></textarea>
                                <p><br>
                                    <button class="btn btn-primary btn-flat" type="submit">Save</button>
                                    <button class="btn btn-danger btn-flat" type="reset">Cancel</button>

                                </p>
                           </div>
                       </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/.col-->
    </div>
@endsection
@section('js')
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'profile',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});

    function loadFile(e)
    {
        var output = document.getElementById('preview');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script> 
@endsection