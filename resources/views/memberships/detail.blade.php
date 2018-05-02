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
                        <div class="form-group row">
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                               <aside class="text-primary">Khmer First Name</aside> 
                                {{$membership->khmer_first_name}}
                            </label>
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Khmer Family Name</aside> 
                                {{$membership->khmer_family_name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">English First Name</aside> 
                                {{$membership->english_first_name}}
                            </label>
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Khmer Family Name</aside> 
                                {{$membership->english_family_name}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Date of Birth</aside> 
                                {{$membership->date_of_birth}}
                            </label>
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Gender</aside> 
                                {{$membership->gender}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Place of Birth</aside> 
                                {{$membership->place_of_birth}}
                            </label>
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Current Address</aside> 
                                {{$membership->current_address}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Phone Number</aside> 
                                {{$membership->phone}}
                            </label>
                            <label for="khmer_first_name" class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">E-mail</aside> 
                                {{$membership->email}}
                            </label>
                        </div>
                        <div class="form-group row">
                            <label  class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Receive Newsletter</aside> 
                                {{$membership->receive_newsletter}}
                            </label>
                            <br>
                            <label class="col-sm-6">
                                    <aside class="text-primary">Social URL</aside> 
                                {{$membership->social_url}}
                            </label>
                            <label  class="control-label col-lg-6 col-sm-6">
                                <aside class="text-primary">Photo</aside> 
                                <img src="{{asset('public/uploads/members/'.$membership->photo)}}" width="120" alt="">
                            </label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{asset('js/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
   var roxyFileman = "{{asset('fileman/index.html?integration=ckeditor')}}"; 

  CKEDITOR.replace( 'description',{filebrowserBrowseUrl:roxyFileman, 
                               filebrowserImageBrowseUrl:roxyFileman+'&type=image',
                               removeDialogTabs: 'link:upload;image:upload'});
</script> 
@endsection