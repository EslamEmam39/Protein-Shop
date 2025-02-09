<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function attachTags(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $request->validate([
        'tags' => 'required|array',
        'tags.*' => 'exists:tags,id',
    ]);
     
    $product->tags()->sync($request->tags);

    return response()->json(['message' => 'Tags updated successfully', 'product' => $product->load('tags')]);
}
    public function relatedProducts($id)
    {
        $product = Product::findOrFail($id);
        $relatedProducts = $product->relatedProducts();
    
        return response()->json($relatedProducts);
    }


    
    public function index()
    {
        return response()->json(Product::with('category')->get(), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'discount' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku ' =>'nullable|string'
        ]);
    
        $data = $request->except('image');
    
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }
    
        $product = Product::create($data);
    
        return response()->json(['message' => 'تم إضافة المنتج بنجاح', 'product' => $product], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(product $product)
    {
        return response()->json($product->load('category'), 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
            'discount' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'sku ' =>'nullable|string'
        ]);

        $data = $request->except('image');
    
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::delete("public/{$product->image}");
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
    
        $product->update($data);
    
        return response()->json(['message' => 'تم تحديث المنتج بنجاح', 'product' => $product], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::delete("public/{$product->image}");
        }
    
        $product->delete();
    
        return response()->json(['message' => 'تم حذف المنتج بنجاح'], 200);
    }
}
