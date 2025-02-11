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
        $categories = Category::all();
        return view('admin.category.index' , compact('categories'));
       }
       public function add_category(){
        return view('admin.category.add');
       }
    
       public function store(Request $request)
       {
          $request->validate([
               'name' => 'required|string|max:255',
               'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048',
           ]);
      
           $imagePath = $request->file('image') ? $request->file('image')
           ->store('Category', 'public') : null;
          
           $categories = Category::create([
               'name' => $request->name,
               'image' => $imagePath,
           ]);
    
           return redirect()->route('all.categories' ,compact('categories'))
           ->with('msg' , 'Category Added Successfully');
    }
    
    public function show($id)
    {
      $category = Category::find($id) ;
     return view('admin.category.edit' ,compact('category'));
    
    }
    
  
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            Storage::delete("public/{$category->image}");
            $category->image = $request->file('image')->store('Category', 'public');
        }
    
        $category->update($request->except('image'));
    
        return redirect()->route('all.categories')->with('msg' ,'Category Updated Successfully');
    }
    
    public function destroy($id)
    {
        $category =   Category::find($id);
        Storage::delete("public/{$category->image}");
        $category->delete();
    
        return redirect()->back()->with('msg' , 'Category Deleted Successfully');
    }
}
