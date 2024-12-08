<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        $products_eight = Products::where('status','active')->latest()->paginate(8);
        $products = Products::where('status','active')->get();

        if ($request->ajax() && $request->action == 'search_product') {
            $products_eight = Products::where('sub_category_id',$request->sub_cat_id)->paginate(8);
        }

        $data['subcategories'] = SubCategory::where('status','active')->latest()->get();
        $data['products_eight'] = $products_eight;
        $data['products'] = $products;

        if ($request->ajax() && $request->action == 'search_product') {
            return view('front_products')->with($data);
        }


        return view('index')->with($data);
    }


    public function shop(Request $request){

        $perpage = 9;
        $products = Products::where('status','active')->paginate($perpage);
        if ($request->ajax()) {
            if ($request->sub_cat_id) {
                $products = Products::where('sub_category_id', $request->sub_cat_id)->paginate($perpage);

            }
            if ($request->cat_id) {
                $products = Products::where('category_id', $request->cat_id)->paginate($perpage);

            }
            if ($request->range) {
                $products = Products::where('price','<=', $request->range)->paginate($perpage);

            }
        }

        $data['subcategories'] = SubCategory::where('status','active')->latest()->get();
        $data['products'] = $products;
        $data['perpage'] = $perpage;
        $data['categories'] = Category::where('status','active')->withCount('products')->get();

        if ($request->ajax()){
            return view('product_shop')->with($data);
        }


        return view('shop')->with($data);
    }

}
