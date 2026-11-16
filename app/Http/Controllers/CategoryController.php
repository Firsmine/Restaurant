<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::orderBy('CategoryID', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get all categories success',
            'data' => ['categories' => $category]
        ], 200);
    }
}
