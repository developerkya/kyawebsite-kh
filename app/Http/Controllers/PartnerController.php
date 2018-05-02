<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class PartnerController extends Controller
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
        
        $data['partners'] = DB::table('partners')
            ->where('active',1)
            ->paginate(18);
        return view('partners.index', $data);
    }
    // load create form
    public function create()
    {
        
        return view('partners.create');
    }
    // save new category
    public function save(Request $r)
    {
        $file_name = '';
        if($r->logo) {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'partners/';
            $file->move($destinationPath, $file_name);
        }
        $data = array(
            'name' => $r->name,
            
            'logo' => $file_name,
            'sequence' => $r->sequence,
            'url' => $r->url
        );
       
        $i = DB::table('partners')->insert($data);
        if ($i)
        {
            $r->session()->flash('sms', "Upload success!");
            return redirect('/donor/create');
        }
        else
        {
            $r->session()->flash('sms1', "Fail to upload new donor logo!");
            return redirect('/donor/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
       
        DB::table('partners')->where('id', $id)->update(['active'=>0]);
        return redirect('/donor');
    }
    public function edit($id)
    {
        $data['partner'] = DB::table('partners')
            ->where('id', $id)->first();
        return view('partners.edit', $data);
    }
    // update partner 
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'sequence' => $r->sequence,
            'url' => $r->url
        );
        if ($r->logo) {
            $file = $r->file('logo');
            $file_name = $file->getClientOriginalName();
            $destinationPath = 'partners/';
            $file->move($destinationPath, $file_name);
            $data = array(
                'logo' => $file_name
            );
        } 
       
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('partners')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/donor/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/donor/edit/'.$r->id);
        }
    }
}
