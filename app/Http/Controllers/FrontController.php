<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
class FrontController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            app()->setLocale(Session::get("lang"));
             return $next($request);
         });
    }
    // index
    public function index()
    {
        $data['mission'] = DB::table('pages')->where('id',19)->first();
        $data['vission'] = DB::table('pages')->where('id',20)->first();
        $data['slides'] = DB::table('slides')
            ->where('active', 1)
            ->orderBy('order', 'asc')
            ->get();
        $data['news'] = DB::table('posts')
            ->orderBy('id', 'desc')
            ->where('active',1)
            ->get();

        return view('fronts.index', $data);
    }
    public function detail($id)
    {
        $data['detail'] = DB::table('posts')->where('id', $id)->first();

        return view('fronts.detail', $data);
    }
    public function page_by_category()
    {
        $data['posts'] = DB::table('posts')
            ->where('active',1)
            ->orderBy('id', 'desc')
            ->paginate(12);
        return view('fronts.page_by_categories', $data);
    }
    public function case_study()
    {
        $data['case_studies'] = DB::table('case_studies')->where('active',1)->orderBy('id','desc')->paginate(16);
        return view('fronts.case-studies.index', $data);
    }
    public function case_detail($id)
    {
        $data['page'] = DB::table('case_studies')->where('id', $id)->first();
        return view('fronts.case-studies.detail', $data);
    }
    public function elibrary()
    {
        $data['elibraries'] = DB::table('ebooks')->where('active',1)->paginate(18);
        return view('fronts.elibraries.index', $data);
    }
    public function elibrary_detail($id)
    {
        $data['page'] = DB::table('ebooks')->where('id', $id)->first();
        return view('fronts.elibraries.detail', $data);
    }
    public function event()
    {
        $data['events'] = DB::table('announcements')
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->paginate(18);
        return view('fronts.events.index', $data);
    }
    public function event_detail($id)
    {
        $data['event'] = DB::table('announcements')
            ->where('id', $id)
            ->first();
        return view('fronts.events.detail', $data);
    }
    // save subscription
    public function subscribe($id)
    {
        $data = array('email'=>$id);
        $counter = DB::table('newsletters')->where('active',1)->where('email',$id)->count();
        if($counter<=0)
        {
            DB::table('newsletters')->insert($data);
        }
        return 'សូមអរគុណ សម្រាប់ការចុះឈ្មាេះ!';
    }
}
