<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{

    public function index()
    {
        $transaction = Transaction::get();

        return response()->json([
            'status' => 'success',
            'message' => 'Get all transaction successful',
            'data' => $transaction
        ]);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'TableID' => 'required|integer|exists:restauranttables,tableID',
            'CustomerName' => 'required|string|max:255',
            'TransactionDate' => 'nullable|date',
            'Status' => 'nullable|in:Completed,Cancelled'
        ]);
        $transaction = Transaction::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Transaction added successful',
            'data' => $transaction
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $transaction = Transaction::with('table')->findOrFail($id);
        $transaction->with('table');
        return response()->json([
            'status' => 'success',
            'message' => 'Get transaction detail successful',
            'data' => $transaction
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Transaction deleted successful',
        ]);
    }
}
