<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
// add Tage product
public function attachTags(Request $request, $id)
{
    $product = product::findOrFail($id);

    $request->validate([
        'tags' => 'required|array',
        'tags.*' => 'exists:tags,id',
    ]);
    
    $product->tags()->sync($request->tags);

    return response()->json(['message' => 'Tags updated successfully', 'product' => $product->load('tags')]);
}// End Method
    public function index()
    {
        return response()->json(Tag::all());
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:tags',
        ]);

        $tag = Tag::create(['name' => $request->name]);

        return response()->json($tag, 201);
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return response()->json(['message' => 'Tag deleted'], 200);
    }
}
