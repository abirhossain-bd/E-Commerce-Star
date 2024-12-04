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

class ProductController extends Controller
{
    public function index(){
        $products = Products::paginate(10);
        return view('admin_panel.products.list',compact('products'));
    }

    public function create(){
        $categories = Category::where('status','active')->get();
        $subcategories = SubCategory::where('status','active')->get();
        return view('admin_panel.products.create',compact('categories','subcategories'));
    }

    public function store(Request $request){
        $manager = new ImageManager(new Driver());
        $request->validate([
            '*' => 'required',
        ]);
        $image = $request->hasFile('image');
        if($image){
            $new_image = Auth::user()->id . '-' . rand(0,99999) . now()->format('M-d-Y') . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/products/'. $new_image));
            $new_name = 'uploads/products/'. $new_image;

            Products::create([
                'title'=>$request->title,
                'category_id'=>$request->category_id,
                'price'=>$request->price,
                'discount_price'=>$request->discount_price,
                'description'=>$request->description,
                'sub_category_id'=>$request->sub_category_id,
                'image'=>$new_name,
                'created_at' => now(),
            ]);
            return redirect()->route('product.list')->with('success','Product created successfully');
        }
    }


    public function status($id){
        $product = Products::where('id',$id)->first();
        if($product->status=='active'){
            Products::find($product->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return back()->with('success','Product deactivated successfully');
        }else{
            Products::find($product->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return back()->with('success','Product activated successfully');
        }
    }
}
