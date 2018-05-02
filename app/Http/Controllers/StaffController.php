<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        $data['staffs'] = DB::table('staffs')
            ->where('active', 1)
            ->paginate(18);
        return view('staffs.index', $data);
    }
    // load create form
    public function create()
    {
        return view('staffs.create');
    }
    // save new page
    public function save(Request $r)
    {   
        $data = array(
            'full_name' => $r->full_name,
            'position' => $r->position,
            'section' => $r->section,
            'order_number' => $r->order_number,
            'profile' => $r->profile
        );
        $i = DB::table('staffs')->insertGetId($data);
        
        if ($i)
        {
            if($r->photo) {
                $file = $r->file('photo');
                $file_name = $file->getClientOriginalName();
                $ext = \File::extension($file_name);
                $file_name = $i.$ext;
                $destinationPath = 'uploads/staff/';
                $new_img = Image::make($file->getRealPath());
                $new_img->save($destinationPath . $file_name, 80);
    
                // upload 250
                $destinationPath = 'uploads/staff/250x250/';
                $new_img = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $file_name, 80);
                DB::table('staffs')->where('id', $i)->update(['photo'=>$file_name]);
            }
            $r->session()->flash('sms', "New staff has been created successfully!");
            return redirect('/admin/staff/create');
        }
        else
        {
            $r->session()->flash('sms1', "Fail to create new staff!");
            return redirect('/admin/staff/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('staffs')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/staff');
    }

    public function edit($id)
    {
        $data['staff'] = DB::table('staffs')
            ->where('id',$id)->first();
        return view('staffs.edit', $data);
    }

    public function update(Request $r)
    {
        $data = array(
            'full_name' => $r->full_name,
            'position' => $r->position,
            'section' => $r->section,
            'order_number' => $r->order_number,
            'profile' => $r->profile
        );
        if($r->photo) {
            $file = $r->file('photo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'uploads/staff/';
            $new_img = Image::make($file->getRealPath());
            $new_img->save($destinationPath . $file_name, 80);

            // upload 250
            $destinationPath = 'uploads/staff/250x250/';
            $new_img = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $data['photo'] = $file_name;
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('staffs')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/admin/staff/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/admin/staff/edit/'.$r->id);
        }
    }
    // view detail
    public function view($id) 
    {
        $data['staff'] = DB::table('staffs')
            ->where('id',$id)->first();
        return view('staffs.detail', $data);
    }
}

