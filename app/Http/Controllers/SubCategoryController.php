<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        $categories = Category::where('status','active')->latest()->get();
        $subcategories = SubCategory::all();
        return view('admin_panel.sub_categories.index',compact('categories','subcategories'));
    }

    public function store(Request $request){
        $request->validate([
            '*' => 'required',
        ]);
        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'created_at' => now(),
        ]);
        return back()->with('success','Sub-Category created successfully');
    }



    public function status($id){
        $sub_category = SubCategory::where('id',$id)->first();
        if($sub_category->status == 'active'){
            SubCategory::find($sub_category->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return back()->with('success','Sub-Category deactivated successfully');
        }else{
            SubCategory::find($sub_category->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return back()->with('success','Sub-Category activated successfully');
        }
    }
}
