<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view('admin_panel.categories.index',compact('categories'));
    }

    public function store(Request $request){
        $manager = new ImageManager(new Driver());
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'required|image',
        ]);
        $image = $request->hasFile('image');
        if ($image) {
            $new_name = Auth::id() . '-' . now()->format('d-M-Y') . '-' . rand(0,999999). '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/categories/'. $new_name));
            $new_image = 'uploads/categories/'. $new_name;
        }

        Category::create([
            'name' => $request->name,
            'image' => $new_image,
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


