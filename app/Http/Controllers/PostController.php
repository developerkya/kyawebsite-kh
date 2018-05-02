<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use Session;
use Auth;
use Intervention\Image\ImageManagerStatic as Image;
class PostController extends Controller
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
        $data['posts'] = DB::table('posts')
            ->orderBy('id', 'desc')
            ->where('active', 1)
            ->paginate(18);
        return view('posts.index', $data);
    }
    // load create form
    public function create()
    {
        return view('posts.create');
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
            $destinationPath = 'uploads/fulls/';
            $new_img = Image::make($file->getRealPath());
            $new_img->save($destinationPath . $file_name, 80);

            // upload 250
            $destinationPath = 'uploads/posts/250x250/';
            $new_img = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $data['featured_image'] = $file_name;
        }
       
        $sms = "The new post has been created successfully.";
        $sms1 = "Fail to create the new post, please check again!";
        $i = DB::table('posts')->insert($data);

        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/post/create/new');
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/post/create/new')->withInput();
        }
    }
    // delete
    public function delete($id)
    {
        
        DB::table('posts')->where('id', $id)->update(['active'=>0]);
        return redirect('/post');
    }

    public function edit($id)
    {
        $data['categories'] = DB::table('categories as a')
            ->join('categories as b', 'b.id', '=', 'a.id')
            ->where('b.active', 1)->where('b.parent_id', 0)->get();

        $data['post'] = DB::table('posts')
            ->where('id',$id)->first();
        return view('posts.edit', $data);
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
             $destinationPath = 'uploads/fulls/';
             $new_img = Image::make($file->getRealPath());
             $new_img->save($destinationPath . $file_name, 80);

            // upload 250
            $destinationPath = 'uploads/posts/250x250/';
            $new_img = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                $con->aspectRatio();
            });
            $new_img->save($destinationPath . $file_name, 80);
            $data ['featured_image'] =  $file_name;
        }
        $sms = "All changes have been saved successfully.";
        $sms1 = "Fail to to save changes, please check again!";
        $i = DB::table('posts')->where('id', $r->id)->update($data);
        if ($i)
        {
            $r->session()->flash('sms', $sms);
            return redirect('/post/edit/'.$r->id);
        }
        else
        {
            $r->session()->flash('sms1', $sms1);
            return redirect('/post/edit/'.$r->id);
        }
    }
    // view detail
    public function view($id) 
    {
        $data['post'] = DB::table('posts')
            ->where('id',$id)->first();
        return view('posts.detail', $data);
    }
}

