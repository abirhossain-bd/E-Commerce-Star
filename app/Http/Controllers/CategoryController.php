<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use function PHPUnit\Framework\fileExists;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin_panel.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'required|image',
        ]);
        $image = $request->hasFile('image');
        if ($image) {
            $new_name = Auth::id() . '-' . now()->format('d-M-Y') . '-' . rand(0, 999999) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/categories/' . $new_name));
            $new_image = 'uploads/categories/' . $new_name;
        }

        Category::create([
            'name' => $request->name,
            'image' => $new_image,
            'created_at' => now(),
        ]);
        return back()->with('success', 'Category created successfully');
    }


    public function status($id)
    {
        $category = Category::where('id', $id)->first();

        if ($category->status == 'active') {
            Category::find($category->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return back()->with('success', 'Category deactivated successfully');
        } else {
            Category::find($category->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return back()->with('success', 'Category activated successfully');
        }
    }

    public function edit($id)
    {
        $category = Category::where('id', $id)->first();
        return view('admin_panel.categories.edit', compact('category'));
    }





    public function update(Request $request, $id)
    {
        $manager = new ImageManager(new Driver());


        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $category = Category::where('id', $id)->first();

        if ($request->hasFile('image')) {

            if ($category->image) {
                $old_path = public_path($category->image);
                if (file_exists($old_path)) {
                    unlink($old_path);
                }
            }


            $new_name = Auth::id() . '-' . now()->format('d-M-Y') . '-' . rand(0, 999999) . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(public_path('uploads/categories/' . $new_name));
            $new_image = 'uploads/categories/' . $new_name;
        } else {

            $new_image = $category->image;
        }


        $category->update([
            'name' => $request->name,
            'image' => $new_image,
            'updated_at' => now(),
        ]);

        return redirect()->route('category.index')->with('success', 'Category Updated Successfully!');
    }



    public function destroy($id){
        $category = Category::where('id',$id)->first();

        if($category->image){
            $old_path = public_path($category->image);
            if (fileExists($old_path)) {
                unlink($old_path);
            }
        }

        Category::find($id)->delete();
        return back()->with('success','Category Deleted Successfully');

    }
}
