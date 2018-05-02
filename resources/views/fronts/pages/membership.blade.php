@extends('layouts.front')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <p></p>
            <h4 class="default-color my-4">
                ចុះឈ្មេាះជាសមាជិក
            </h4>
            <hr>
            
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
        </div>
    </div> 
     <form 
            action="{{url('/front/membership/save')}}" 
            class="form-horizontal" 
            method="post"
            enctype="multipart/form-data"  
        >   
        {{csrf_field()}}
       
        <div class="row text-primary">
            <div class="col-sm-6">
                <p>
                    <b>នាមជាខ្មែរ <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="khmer_first_name" required placeholder="Khmer First Name">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>ត្រកូលជាខ្មែរ <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="khmer_family_name" required placeholder="Khmer Fimily Name">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>នាមជាឡាតាំង <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="english_first_name" required placeholder="English First Name">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>ត្រកូលជាឡាតាំង <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="english_family_name" required placeholder="English Fimily Name">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>ថ្ងៃខែឆ្នាំកំណើត <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" name="date_of_birth" required placeholder="Date of Birth">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>ភេទ <span class="text-danger">*</span></b>
                    <select class="form-control" name="gender" required>
                        <option value="male">ប្រុស</option>
                        <option value="female">ស្រី</option>
                    </select>
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>អាស័យដ្ឋានបច្ចុប្បន្ន <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" required name="current_address" placeholder="Current Address">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>ទីកន្លែងកំណើត  <span class="text-danger">*</span></b>
                    <input type="text" class="form-control" required name="place_of_birth" placeholder="Place of birth">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>លេខទូរស័ព្ទ <span class="text-danger">*</span></b>
                    <input type="number" class="form-control" required name="phone" placeholder="phone number">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>អីុម៉ែល <span class="text-danger">*</span></b>
                    <input type="email" class="form-control" name="email" required placeholder="E-mail">
                </p>
            </div>
            <div class="col-sm-6">
                <p>
                    <b>តើអ្នកចង់ទទួលព្រឹត្តិប័ត្រដែរឬទេ? <span class="text-danger">*</span></b>
                    <select class="form-control" name="receive_newsletter" required> 
                        <option value="yes">បាទ</option>
                        <option value="no">ទេ</option>
                    </select>
                </p>
                <p><b>Social URL</b>
                        <input type="text" class="form-control" name="social_url">
                </p>
                <p>
                    <input type="submit" class="btn btn-primary" value="ចុះឈ្មេាះ" name="send">
                </p>
            </div>

            <div class="col-sm-6">
                <p>
                    <b>រូបថត <span class="text-danger">(4x6)</span> <span class="text-danger">*</span></b>
                    <input type="file" name="photo" required accept="image/*" id="photo" class="form-control" onchange="loadFile(event)">
                </p>
                <p>
                    <img src="{{asset('public/uploads/members/member.png')}}"  width="120" alt="" id="img">
                </p>
            </div>
        </div>   
    </form>
</div>
<p><br></p>
<script type="text/javascript">
    function loadFile(e)
    {
        var output = document.getElementById('img');
        output.src = URL.createObjectURL(e.target.files[0]);
    }
</script> 
@endsection