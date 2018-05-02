<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;

use Auth;
class NewsletterController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');

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
        $data['newsletters'] = DB::table('newsletters')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(18);
        return view('newsletters.index', $data);
    }
    // load create form
    public function create()
    {
        return view('newsletters.create');
    }
    // save new newsletter
    public function save(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email,
        );
        $sms = "The new newsletter has been created successfully.";
        $sms1 = "Fail to create the new newsletter, please check again!";
        $i = DB::table('newsletters')->insert($data);

        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/newsletter/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/newsletter/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        DB::table('newsletters')->where('id', $id)->update(['active'=>0]);
        return redirect('/newsletter');
    }

    public function edit($id)
    {
        $data['newsletter'] = DB::table('newsletters')
            ->where('id',$id)->first();
        return view('newsletters.edit', $data);
    }

    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'email' => $r->email
        );
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('newsletters')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/newsletter/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/newsletter/edit/'.$r->id);
        }
    }
}

