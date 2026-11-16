<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
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
        ]);
        $menuItem = MenuItem::findOrFail($data['MenuItemID']);
        $data['Price'] = $menuItem->Price * $data['Quantity'];
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
        $order = Order::where('TransactionID', $transaction->TransactionID)->pluck('OrderID');
        $orderDetail = OrderDetail::whereIn('OrderID', $order)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'Get order detail successful',
            'data' => $orderDetail
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $orderDetail = OrderDetail::findOrFail($id);
        $orderDetail->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Order detail deleted successful',
        ]);
    }
}
