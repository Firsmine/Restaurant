<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        $orderDetail = OrderDetail::get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get all orders detail successful',
            'data' => $orderDetail
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'OrderID' => 'required|integer|exists:orders,OrderID',
            'MenuItemID' => 'required|integer|exists:menuitems,MenuItemID',
            'Quantity' => 'required|integer|min:0',
            'Price' => 'required|numeric|min:0.01|decimal:12,2'
        ]);
        $orderDetail = OrderDetail::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Order detail created successful',
            'data' => $orderDetail
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $order = Order::when('TransactionID', $transaction->id)->get();
        $orderDetail = OrderDetail::where('OrderID', $order->id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get order detail successful',
            'data' => $orderDetail
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $transactionId)
    {
        $transaction = Transaction::findOrFail($transactionId);
        $order = Order::when('TransactionID', $transaction->id);
        $orderDetail = OrderDetail::where('OrderID', $order->id);
        $orderDetail->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Order detail deleted successful',
            'data' => $orderDetail
        ]);
    }
}
