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


    public function edit($id){
        $sub_category = SubCategory::where('id',$id)->first();
        $categories = Category::where('status','active')->get();
        return view('admin_panel.sub_categories.edit',compact('sub_category','categories'));
    }


    public function update(Request $request,$id){
        $request->validate([
            'name' => 'required',
            'category_id' => 'nullable',
        ]);
        $sub_category = SubCategory::where('id',$id)->first();
        if ($request->category_id) {
            SubCategory::find($request->id)->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'updated_at' => now(),
            ]);
            return redirect()->route('subcategory.index')->with('success','Sub-Category Updated Successfully!');
        }else{
            SubCategory::find($request->id)->update([
                'name' => $request->name,
                'category_id' => $sub_category->category_id,
                'updated_at' => now(),
            ]);
            return redirect()->route('subcategory.index')->with('success','Sub-Category Updated Successfully!');
        }
    }



    public function destroy($id){
        SubCategory::find($id)->delete();
        return back()->with('success','Sub-Category Deletede Successfully!');

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
