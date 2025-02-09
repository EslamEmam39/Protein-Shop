<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    public function index()
    {
        return response()->json(Auth::user()->favourites);
    }

    public function store($id)
    {
        $product = product::findOrFail($id);
        Auth::user()->favourites()->attach($product);

        return response()->json(['message' => 'Product added to favourites'], 201);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        Auth::user()->favourites()->detach($product);

        return response()->json(['message' => 'Product removed from favourites'], 200);
    }
}
