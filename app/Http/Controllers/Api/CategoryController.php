<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $category = Category::all();
        return response()->json([
            'status' => 200 ,
            'message' => 'All Categories',
            'data' =>  $category 
        ] , 200);
       }

       public function show(Category $category)
       {
         
        return response()->json([
            'status' => 200 ,
            'message' => 'Show Category',
            'data' =>  $category 
        ] , 200);
       
       }
}
