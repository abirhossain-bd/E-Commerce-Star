<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpeacialOffer extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'offer',
        'category_id',
        'subcategory_id',
        'image',
        'status',
    ];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function subCategory(){
        return $this->belongsTo(SubCategory::class,'subcategory_id');
    }
}
