<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'Name' => 'required|string|max:255',
            'Role' => 'required|in:Waitress,Cashier,Chef',
            'Phone' => 'required|string|regex:0-9',
            'Email' => 'required|email|unique:employees,Email',
            'HireDate' => 'required|date|data_format:Y-m-d',
            'Password' => 'required|string|min:6'
        ]);
        $employee = Employee::create($data);
        $token = $employee->createToken('auth_token')->plainTextToken;
        return response()->json([
            'status' => 'success',
            'message' => 'Login success',
            'data' => array_merge($employee->toArray(), ['token' => $token])
        ], 201);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:employees,Email',
            'password' => 'required|string'
        ]);

        $employee = Employee::where('email', $request->email)->first();

        if (!$employee || !Hash::check($request->password, $employee->Password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email or Password incorrect'
            ], 422);
        }

        $token = $employee->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'message' => 'Login successful',
            'data' => array_merge($employee->toArray(), ['token' => $token])
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'logout successful'
        ]);
    }
}
