<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SpeacialOffer;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SpeacialOfferController extends Controller
{

    public function index(){
        $speacial_prods = SpeacialOffer::all();
        return view('admin_panel.speacial_offers.list',compact('speacial_prods'));
    }






    public function offerCreate(){
        $categories = Category::where('status','active')->get();
        $subcategories = SubCategory::where('status','active')->get();
        return view('admin_panel.speacial_offers.create',compact('categories','subcategories'));
    }

    public function store(Request $request){
        $manager = new ImageManager(new Driver());
        $request->validate([
            'title' => 'required',
            'offer' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'image' => 'required|image',
        ]);


        $image = $request->hasFile('image');

        if($image){
            $new_name = Auth::id() . '-' . time() . rand(0,99999) . now()->format('d-M-Y') . '.' . $request->file('image')->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->toPng()->save(base_path('public/uploads/speacial/'.$new_name));
            $new_image = 'uploads/speacial/'.$new_name;

            SpeacialOffer::create([
                'title' => $request->title,
                'offer' => $request->offer,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'image' => $new_image,
                'created_at' => now(),
            ]);
            return redirect()->route('offer.list')->with('success','Special product created successfully!');
        }
    }

    public function status(Request $request,$id){
        $speacial = SpeacialOffer::where('id',$id)->first();

        if($speacial->status == 'active'){
            SpeacialOffer::find($request->id)->update([
                'status' => 'deactive',
                'updated_at' => now(),
            ]);
            return back()->with('success','Speacial product deactivated successfully!');
        }else{
            SpeacialOffer::find($request->id)->update([
                'status' => 'active',
                'updated_at' => now(),
            ]);
            return back()->with('success','Speacial product activated successfully!');
        }
    }
}
