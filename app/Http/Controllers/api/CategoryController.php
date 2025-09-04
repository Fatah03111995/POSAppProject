<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $category = \App\Models\Category::all();
        return response()->json(
            [
                'message'=>'List Category',
                'data'=>$category,
            ]
            );
    }
}
