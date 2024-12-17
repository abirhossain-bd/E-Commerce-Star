<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use function PHPUnit\Framework\fileExists;

class ProductController extends Controller
{
    public function index()
    {
        $products = Products::paginate(5);
        return view('admin_panel.products.list', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('status', 'active')->get();
        $subcategories = SubCategory::where('status', 'active')->get();
        return view('admin_panel.products.create', compact('categories', 'subcategories'));
    }

    public function store(Request $request)
    {
        $manager = new ImageManager(new Driver());
        $request->validate([
            '*' => 'required',
            'price' => 'max_digits:7',
            'discount_price' => 'max_digits:7',
        ]);
        $image = $request->hasFile('image');
        if ($image) {
            $new_image = Auth::user()->id . '-' . rand(0, 99999) . now()->format('M-d-Y') . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/products/' . $new_image));
            $new_name = 'uploads/products/' . $new_image;

            Products::create([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'description' => $request->description,
                'sub_category_id' => $request->sub_category_id,
                'image' => $new_name,
                'created_at' => now(),
            ]);
            return redirect()->route('product.list')->with('success', 'Product created successfully');
        }
    }



    public function edit($id)
    {
        $product = Products::where('id', $id)->first();
        $categories = Category::where('status', 'active')->get();
        $subcategories = Category::where('status', 'active')->get();
        return view('admin_panel.products.edit', compact('product', 'categories', 'subcategories'));
    }



    public function update(Request $request, $id)
    {
        $manager = new ImageManager(new Driver());

        $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'discount_price' => 'required',
            'description' => 'required',
            'sub_category_id' => 'required',
            'image' => 'nullable|image',
        ]);



        $image = $request->hasFile('image');
        if ($image) {

            $products = Products::where('id', $id)->first();
            if ($products->image) {
                $oldpath = public_path($products->image);
                if (fileExists($oldpath)) {
                    unlink($oldpath);
                }
            }


            $new_name = Auth::user()->id . '-' . rand(0, 99999) . now()->format('M-d-Y') . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/products/' . $new_name));

            $new_image = 'uploads/products/' . $new_name;


            Products::find($request->id)->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'description' => $request->description,
                'sub_category_id' => $request->sub_category_id,
                'image' => $new_image,
                'updated_at' => now(),

            ]);
            return redirect()->route('product.list')->with('success', 'Product Updated Successfully!');
        } else {

            Products::find($request->id)->update([
                'title' => $request->title,
                'category_id' => $request->category_id,
                'price' => $request->price,
                'discount_price' => $request->discount_price,
                'description' => $request->description,
                'sub_category_id' => $request->sub_category_id,
                'updated_at' => now(),

            ]);
            return redirect()->route('product.list')->with('success', 'Product Updated Successfully!');
        }
    }


    public function destroy($id){
        $product =Products::where('id',$id)->first();
        if ($product->image) {
            $oldpath = public_path($product->image);
            if (fileExists($oldpath)) {
                unlink($oldpath);
            }
        }
        Products::find($id)->delete();
        return back()->with('success','Product Deleted Successfully!');
    }




    public function status($id)
    {
        $product = Products::where('id', $id)->first();
        if ($product->status == 'active') {
            Products::find($product->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return back()->with('success', 'Product deactivated successfully');
        } else {
            Products::find($product->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return back()->with('success', 'Product activated successfully');
        }
    }
}
