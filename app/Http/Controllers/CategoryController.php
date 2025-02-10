<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $category = Category::all();
        return response()->json($category , 200);
       }
    
       public function store(Request $request)
       {
           $request->validate([
               'name' => 'required|string|max:255',
               'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
           ]);
    
           $imagePath = $request->file('image') ? $request->file('image')
           ->store('Category', 'public') : null;
    
           $product = Category::create([
               'name' => $request->name,
               'image' => config("app.url")."/storage/".$imagePath,
           ]);
    
           return response()->json($product, 201);
    }
    
    public function show(Category $category)
    {
      
            return response()->json($category, 200);
      
    

    }
    
  
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            Storage::delete("public/{$category->image}");
            $category->image = $request->file('image')->store('Category', 'public');
        }
    
        $category->update($request->except('image'));
    
        return response()->json($category,200);
    }
    
    public function destroy(Category $category)
    {
        Storage::delete("public/{$category->image}");
        $category->delete();
    
        return response()->json(['message' => 'تم حذف الفئة بنجاح'],204);
    }
}
