<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class AudioController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()==null)
            {
                return redirect("/login");
            }
            return $next($request);
        });
    }
    // index
    public function index()
    {
        $data['audios'] = DB::table('audios')
            ->orderBy('id', 'desc')
            ->where('active',1)
            ->paginate(18);
        return view('audios.index', $data);
    }
    // load create form
    public function create()
    {
        // if(!Right::check('Logo', 'i'))
        // {
        //     return view('permissions.no');
        // }
        return view('audios.create');
    }
    // save new Audio
    public function save(Request $r)
    {  
        $data = array(
            'title' => $r->title,
            'order' => $r->order,
        );
        if($r->file) {
            $file = $r->file('file');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'front/audios/';
            $file->move($destinationPath, $file_name);
            $data['file'] = $file_name;
        }
        $sms = "The new audio has been created successfully.";
        $sms1 = "Fail to create the new audio, please check again!";
        $i = DB::table('audios')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/audio/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/audio/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('audios')->where('id', $id)->update(['active'=>0]);
        return redirect('/audio');
    }
    public function edit($id)
    {
        $data['audio'] = DB::table('audios')
            ->where('id',$id)->first();
        return view('audios.edit', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'order' => $r->order,
        );
        if($r->file) {
            $file = $r->file('file');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'front/audios/';
            $file->move($destinationPath, $file_name);
            $data['file'] = $file_name;
          
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('audios')->where('id', $r->id)->update($data);
        if ($i)
            {
                $r->session()->flash('sms', $sms);
                return redirect('/audio/edit/'.$r->id);
            }
            else
            {
                $r->session()->flash('sms1', $sms1);
                return redirect('/audio/edit/'.$r->id);
            }
        }

}