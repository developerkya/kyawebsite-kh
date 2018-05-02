<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
class FeaturedProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $data['products'] = DB::table('products')
        ->join('categories', "products.category_id", "categories.id")
        ->where("products.active", 1)
        ->where('products.is_featured', 1)
        ->select("products.*", "categories.name as category_name")
        ->paginate(18);
        return view('feature-products.index', $data);
    }
    public function delete($id)
    {
        DB::table('products')->where('id', $id)->update(['is_featured'=>0]);
        return redirect('/admin/feature/product');
    }
}
