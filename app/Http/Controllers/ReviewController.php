<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{

     //لجلب المنتجات الأكثر تقيما
     public function topRated()
     {
         $products = product::withAvg('reviews', 'rating')
             ->orderByDesc('reviews_avg_rating')
             ->take(10)
             ->get();
     
         return response()->json([
             'status' => 200,
             'message' => 'أعلى المنتجات تقييمًا',
             'products' => $products
         ]);
     }

    public function store(Request $request, $product_id)
    {
        $user_id = auth()->id() ;

        
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string',
        ]);

        $review = Review::create([
            'user_id' =>   $user_id,
            'product_id' => $product_id,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return response()->json($review, 201);
    }

    public function index($product_id)
    {
        $reviews = Review::where('product_id', $product_id)->with('user:id,name')->get();
        return response()->json($reviews);
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);

        if (Gate::denies('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
     

        $review->delete();
        return response()->json(['message' => 'Review deleted'], 200);
    }
}
