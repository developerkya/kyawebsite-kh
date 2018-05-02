<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
class EbookController extends Controller
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
        $data['ebooks'] = DB::table('ebooks')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(18);
        return view('ebooks.index', $data);
    }
    // load create form
    public function create()
    {
        return view('ebooks.create');
    }
    // save 
    public function save(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'description' => $r->description,
            'short_description' => $r->short_description
        );
        $i = DB::table('ebooks')->insertGetId($data);
        if ($i)
        {
          
            if($r->featured_photo) {
                $file = $r->file('featured_photo');
                $file_name = $file->getClientOriginalName();
                $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
                $file_name = 'thumb' .$i . $ss;
                $destinationPath = 'uploads/ebooks/';
                $file->move($destinationPath, $file_name);
                $data['featured_photo'] = $file_name;
            }
            DB::table('ebooks')->where('id', $i)->update(['featured_photo'=>$file_name]);
            $sms = "The new ebook has been created successfully.";
            $r->session()->flash('sms', $sms);
            return redirect('/ebook/create');
        }
        else
        {
            $sms1 = "Fail to create the new ebook, please check again!";
            $r->session()->flash('sms1', $sms1);
            return redirect('/ebook/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('ebooks')->where('id', $id)->update(['active'=>0]);
        return redirect('/ebook');
    }
    public function edit($id)
    {
        $data['ebook'] = DB::table('ebooks')
            ->where('id',$id)->first();
        return view('ebooks.edit', $data);
    }
    public function detail($id)
    {
        $data['ebook'] = DB::table('ebooks')
            ->where('id',$id)->first();
        return view('ebooks.detail', $data);
    }
    
    public function update(Request $r)
    {
        $data = array(
            'title' => $r->title,
            'description' => $r->description,
            'short_description' => $r->short_description
        );
        if($r->featured_photo) {
            $file = $r->file('featured_photo');
            $file_name = $file->getClientOriginalName();
            $ss = substr($file_name, strripos($file_name, '.'), strlen($file_name));
            $file_name = 'thumb'.$r->id. $ss;
            $destinationPath = 'uploads/ebooks/';
            $file->move($destinationPath, $file_name);
            $data['featured_photo'] = $file_name;
        }
        DB::table('ebooks')->where('id', $r->id)->update($data);
        $r->session()->flash('sms', 'All changes have saved successfully!');
        return redirect('/ebook/edit/'.$r->id);
        
    }
}

