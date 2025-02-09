<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */  public function index(){
        $category = brand::all();
        return response()->json($category , 200);
       }
    
       public function store(Request $request)
       {
           $request->validate([
               'name' => 'required|string|max:255',
               'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
           ]);
    
           $imagePath = $request->file('image') ? $request->file('image')
           ->store('brand', 'public') : null;
    
           $brand = brand::create([
               'name' => $request->name,
               'image' => $imagePath,
           ]);
    
           return response()->json($brand, 201);
    }
    
    public function show(brand $brand)
    {
      
            return response()->json($brand, 200);
      
    

    }
    
    public function update(Request $request, brand $brand)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            Storage::delete("public/{$brand->image}");
            $brand->image = $request->file('image')->store('brands', 'public');
        }
    
        $brand->update($request->except('image'));
    
        return response()->json($brand,200);
    }
    
    public function destroy(Brand $brand)
    {
        Storage::delete("public/{$brand->image}");
        $brand->delete();
    
        return response()->json(['message' => 'تم حذف الفئة بنجاح'],204);
    }
}
