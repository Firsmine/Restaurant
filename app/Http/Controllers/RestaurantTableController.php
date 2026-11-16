<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class RestaurantTableController extends Controller
{
    public function index()
    {
        $table = RestaurantTable::orderBy('TableID', 'asc')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get all restaurant tables success',
            'data' => ['tables' => $table]
        ], 200);
    }
}
