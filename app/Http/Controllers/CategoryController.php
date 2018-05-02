<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {

        $data['categories'] = DB::table('categories as a')
            ->leftjoin('categories as b','b.id','=','a.parent_id')
            ->select('a.*', 'b.name as parent_name')
            ->where('a.active',1)
            ->paginate(18);
        return view('categories.index', $data);
    }
    // load create form
    public function create()
    {

        $data['categories'] = DB::table('categories as a')
            ->join('categories as b', 'b.id', '=', 'a.id')
            ->where('b.active', 1)->where('b.parent_id', 0)->get();
        return view('categories.create', $data);
    }
    // save new category
    public function save(Request $r)
    {

        $data = array(
            'name' => $r->name,
            'parent_id' => $r->parent
        );
        $sms = "The new category has been created successfully.";
        $sms1 = "Fail to create the new category, please check again!";
        $i = DB::table('categories')->insertGetId($data);
        if ($i)
        {
            if($r->icon)
            {
               
                $file = $r->file('icon');
                $file_name = $i . '-' . $file->getClientOriginalName();
                $destinationPath = 'uploads/icons/'; // usually in public folder
                $file->move($destinationPath, $file_name);
                DB::table('categories')->where('id', $i)->update(['icon'=>$file_name]);
            }
            $r->session()->flash('sms', $sms);
            return redirect('/category/create');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/category/create')->withInput();
        }
    }
    // delete
    public function delete($id)
    {

        DB::table('categories')->where('id', $id)->update(['active'=>0]);
        return redirect('/category');
    }

    public function edit($id)
    {

        $data['cat'] = DB::table('categories as a')
            ->join('categories as b', 'b.id', '=', 'a.id')
            ->where('b.active', 1)->where('b.parent_id', 0)->get();
        $data['categories'] = DB::table('categories as a')
            ->join('categories as b', 'b.id', '=', 'a.id')
            ->where([['b.active', 1],['a.id',$id]])->first();
            
        return view('categories.edit', $data);
    }
    public function update(Request $r)
    {

        $data = array(
            'name' => $r->name, 
            'parent_id' => $r->parent
        );
        if($r->icon)
        {
            
            $file = $r->file('icon');
            $file_name = $r->id . '-' . $file->getClientOriginalName();
            $destinationPath = 'uploads/icons/'; // usually in public folder
            $file->move($destinationPath, $file_name);
            $data['icon'] = $file_name;
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('categories')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/category/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/category/edit/'.$r->id);
        }
    }
}
