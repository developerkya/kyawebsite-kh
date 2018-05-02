<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Session;
use Intervention\Image\ImageManagerStatic as Image;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['products'] = DB::table('products')
            ->join('categories', "products.category_id", "categories.id")
            ->where("products.active", 1)
            ->select("products.*", "categories.name as category_name")
            ->paginate(18);
        return view('products.index', $data);
    }
    public function create()
    {
        $data['categories'] = DB::table('categories')->where('active', 1)->orderBy('name')->get();
        $data['shops'] = DB::table('shops')->where('active',1)->orderBy('name')->get();
        return view('products.create', $data);
    }

    public function save(Request $r)
    {
            $i = "";
            $data = array(
                'name' => $r->name,
                'quantity' => $r->quantity,
                'in_price' => $r->in_price,
                'discount' => $r->discount,
                'description' => $r->description,
                'short_description' => $r->short_description,
                'category_id' => $r->category,
                'out_price' => $r->out_price,
                'is_featured' => $r->is_featured
            );

            // if ($r->has('btn_save')) {
                // get last id with insert
                $i = DB::table('products')->insertGetId($data);
            // }

            if($i){
                $r->session()->flash('sms', "Product has been inserted successfully!");
                 return redirect('/admin/product/detail/'.$i);
            }
                $r->session()->flash('sms1',"Failed to insert product!");
                return redirect('/admin/product/create');
            
    }
    /*
    * @pro_detail: passed last id
    * $id:last insert id
    */
    public function pro_detail($id)
    {
        $data['product'] = DB::table('products')->where('id', $id)->first();
        $data['categories'] = DB::table('categories')->where('active', 1)->orderBy('name')->get();
        $data['photos'] = DB::table('photos')->where('product_id', $id)->get();
        return view('products.product_detail',$data);
    }
    public function update(Request $r)
    {
        $data = array(
            'name' => $r->name,
            'quantity' => $r->quantity,
            'in_price' => $r->in_price,
            'discount' => $r->discount,
            'description' => $r->description,
            'short_description' => $r->short_description,
            'category_id' => $r->category,
            'out_price' => $r->out_price,
            'is_featured' => $r->is_featured
        );
        $i = DB::table('products')->where('id', $r->id)->update($data);

        $r->session()->flash('sms', "All changes have saved successfully!");
        return redirect('/admin/product/detail/'.$r->id);

    }
    public function delete($id)
    {
        DB::table('products')->where('id', $id)->update(['active'=>0]);
        return redirect('/admin/product');
    }
    public function upload_photo(Request $r)
    {
        if($r->file('photo')) {
            $files = $r->file('photo');
            foreach ($files as $file) {
                $counter = DB::table('photos')->where('product_id', $r->product_id)->count();
                if($counter>=10)
                {
                    break;
                }
                $name = $r->product_id . "-" . $file->getClientOriginalName();
                // upload 540
                $destinationPath = 'uploads/products/540x540/';
                $new_img = Image::make($file->getRealPath())->resize(540, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $name, 80);

                // upload 250
                $destinationPath = 'uploads/products/250x250/';
                $new_img = Image::make($file->getRealPath())->resize(250, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $name, 80);
                // upload 41
                $destinationPath = 'uploads/products/41x41/';
                $new_img = Image::make($file->getRealPath())->resize(41, null, function ($con) {
                    $con->aspectRatio();
                });
                $new_img->save($destinationPath . $name, 80);
                $photos = array(
                    'file_name' => $name,
                    'product_id' => $r->product_id
                );
               DB::table('photos')->insert($photos);
            }
            return redirect('/admin/product/detail/'.$r->product_id);
        }

    }
    public function delete_photo($id)
    {
        $i = DB::table('photos')->where('id', $id)->delete();
        return $i;
    }
}
