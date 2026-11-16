<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;

class MenuItemsController extends Controller
{
    public function index()
    {
        $menu = MenuItem::get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get all menu item successful',
            'data' => ['menu_items' => $menu]
        ], 200);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'Name' => 'required|string|max:255',
            'Price' => 'required|numeric|min:0.01|decimal:0,2',
            'Description' => 'nullable|string',
            'CategoryID' => 'required|integer|exists:categories,CategoryID'
        ]);
        $menu = MenuItem::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Menu item created successful',
            'data' => $menu
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = MenuItem::where('MenuItemID', $id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get menu item detail successful',
            'data' => ['menu_item' => $menu]
        ], 200);
    }


    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'Name' => 'sometimes|string|max:255',
            'Price' => 'sometimes|numeric|min:0.01|decimal:0,2',
            'Description' => 'sometimes|string',
        ]);
        $menu = MenuItem::where('MenuItemID', $id)->first();
        $menu->update($data);
        $menu->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Menu item updated successful',
            'data' => $menu
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = MenuItem::find($id);
        if (!$menu) {
            return response()->json([
                'status' => 'error',
                'message' => 'Not found'
            ]);
        }
        $menu->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Menu item deleted successful'
        ], 200);
    }
}
