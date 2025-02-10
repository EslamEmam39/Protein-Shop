<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    
                              // add Tage product
    public function attachTags(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'tags' => 'required|array',
        'tags.*' => 'exists:tags,id',
    ]);
     
    $product->tags()->sync($request->tags);

    return response()->json(['message' => 'Tags updated successfully', 'product' => $product->load('tags')]);
}// End Method

                        // منتجات ذات صله
    public function relatedProducts($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = $product->relatedProducts();
    
        return response()->json($relatedProducts);
    }// End Method


    
    public function index()
    {
        $product = product::latest()->paginate(10) ;
        return response()->json([
            'status' => 200 ,
            'message' => 'all Product',
             'data' => $product 
        ], 200);
    }// End Method

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
            'discount' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => 'nullable|string' // إزالة الفراغ الزائد
        ]);
    
        // رفع الصورة وتخزين مسارها
        $imagePath = $request->file('image')->store('products', 'public');
    
        // إنشاء المنتج
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock ?? 0, // في حالة لم يتم إرسال قيمة
            'image' => config("app.url")."/storage/".$imagePath,
            'discount' => $request->discount ?? 0,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'sku' => $request->sku,
        ]);
    
        return response()->json([
            'status' => 201,
            'message' => 'تم إضافة المنتج بنجاح',
            'product' => $product
        ], 201);
    }// End Method
 
    public function show(product $product)
    {
        return response()->json($product->load('category'), 200);
    }// End Method

 
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'discount' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku' => 'nullable|string' 
        ]);
    
        // تحديث البيانات بدون الصورة
        $product->fill($request->except('image'));
    
        // إذا تم رفع صورة جديدة، احذف القديمة ثم احفظ الجديدة
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image); // حذف الصورة القديمة
            }
            $product->image = $request->file('image')->store('products', 'public');
        }
    
        // حفظ التعديلات
        $product->save();
    
        return response()->json([
            'message' => 'تم تحديث المنتج بنجاح',
            'product' => $product
        ], 200);
    }// End Method
 
    public function destroy(Product $product)
    {
           // حذف الصورة إذا كانت موجودة
    if ($product->image) {
        Storage::disk('public')->delete($product->image);
    }

    // حذف المنتج
    $product->delete();

    return response()->json([
        'message' => 'تم حذف المنتج بنجاح',
        'deleted_product' => $product // إرجاع بيانات المنتج المحذوف
    ], 200);
    }// End Method
}
