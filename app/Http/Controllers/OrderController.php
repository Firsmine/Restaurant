<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get all orders successful',
            'data' => $order
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'TransactionID' => 'required|integer|exists:transactions,TransactionID',
            'EmployeeID' => 'required|integer|exists:employees,EmployeeID',
            'OrderTime' => 'required|date|date_format:Y-m-d'
        ]);
        $order = Order::create($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Order added successful',
            'data' => $order
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with('transaction.table')->where('OrderID', $id)->first();
        return response()->json([
            'status' => 'success',
            'message' => 'Get order detail successful',
            'data' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Order deleted successful',
        ]);
    }
}
