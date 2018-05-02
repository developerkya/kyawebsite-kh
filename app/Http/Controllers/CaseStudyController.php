<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
class CaseStudyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $data['case_studies'] = DB::table('case_studies')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(18);
        return view('case-studies.index', $data);
    }
    // load create form
    public function create()
    {
        return view('case-studies.create');
    }
    // save new page
    public function save(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'short_description' => $r->short_description,
            'description' => $r->description,
        );
        if($r->feature_image) {
            $file = $r->file('feature_image');
            $file_name = $file->getClientOriginalName();

            // upload full image
            $destinationPath = 'uploads/case-studies/';
            $new_img = Image::make($file->getRealPath());
            $new_img->save($destinationPath . $file_name, 80);

            // upload 250
            $destinationPath = 'uploads/case-studies/250x250/';
            $new_img = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
        }
       
        $sms = "The new case study has been created successfully.";
        $sms1 = "Fail to create the new post, please check again!";
        $i = DB::table('case_studies')->insert($data);

        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/case-study/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/case-study/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        
        DB::table('case_studies')->where('id', $id)->update(['active'=>0]);
        return redirect('/case-study');
    }

    public function edit($id)
    {
       
        $data['case_study'] = DB::table('case_studies')
            ->where('id',$id)->first();
        return view('case-studies.edit', $data);
    }

    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'short_description' => $r->short_description,
            'description' => $r->description,
        );
        if($r->feature_image) {
            $file = $r->file('feature_image');
            $file_name = $file->getClientOriginalName();
             // upload full image
             $destinationPath = 'uploads/case-studies/';
             $new_img = Image::make($file->getRealPath());
             $new_img->save($destinationPath . $file_name, 80);

            // upload 250
            $destinationPath = 'uploads/case-studies/250x250/';
            $new_img = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $data ['featured_image'] =  $file_name;
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('case_studies')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/case-study/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/case-study/edit/'.$r->id);
        }
    }
    // view detail
    public function detail($id) 
    {
        $data['case_study'] = DB::table('case_studies')
            ->where('id',$id)->first();
        return view('case-studies.detail', $data);
    }
}
