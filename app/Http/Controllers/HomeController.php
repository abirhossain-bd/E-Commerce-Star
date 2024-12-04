<?php

namespace App\Http\Controllers;

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

}
