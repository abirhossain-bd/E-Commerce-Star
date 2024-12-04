<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin_panel.categories.index',compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'created_at' => now(),
        ]);
        return back()->with('success','Category created successfully');
    }


    public function status($id){
        $category = Category::where('id',$id)->first();

        if($category->status == 'active'){
            Category::find($category->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return back()->with('success','Category deactivated successfully');
        }else{
            Category::find($category->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return back()->with('success','Category activated successfully');
        }
    }
}


