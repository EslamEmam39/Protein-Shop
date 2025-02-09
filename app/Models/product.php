<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model

{  use HasFactory;
    protected $fillable = [
        'name', 
        'description', 
        'price', 
        'stock',
         'image',
         'discount',
         'category_id',
         'brand_id',
         'sku',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand(){
      return   $this->belongsTo(Brand::class );
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }


       // استرجاع المنتجات المرتبطة بنفس الفئة أو العلامة التجارية
       public function relatedProducts()
       {
           return self::where('category_id', $this->category_id)
               ->orWhere('brand_id', $this->brand_id)
               ->where('id', '!=', $this->id) // استثناء المنتج نفسه
               ->limit(5) // تحديد عدد المنتجات المرتبطة
               ->get();
       }

       public function reviews()
{
    return $this->hasMany(Review::class);
}

// حساب متوسط التقييمات
public function averageRating()
{
    return $this->reviews()->avg('rating');
}

public function tags()
{
    return $this->belongsToMany(Tag::class);
}


public function favouritedBy()
{
    return $this->belongsToMany(User::class, 'favourites');
}
}
