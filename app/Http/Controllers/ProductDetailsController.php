<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    public function index(){
        $latestproduct = Products::where('status','active')->latest()->first();
        $allproducts = Products::where('status','active')->get();
        $categories = Category::where('status','active')->withCount('products')->get();
        return view('product_details',compact('latestproduct','allproducts','categories'));
    }
}
