<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            "data" => $users,
            "message" => "all data reterived successfully"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $requestedData = $request->validated();
        $requestedData['password'] = 'password';
        $user = User::create($requestedData);
        return response()->json([
            "data" => $user,
            "message" => "user added successfully"
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with('orders')->findorfail($id);
        return response()->json([
            "data" => $user,
            "orders" => $user->orders,
            "message" => "all data reterived successfully"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findorfail($id);
        $user->update($request->validated());
        return response()->json([
            "data" => $user,
            "message" => "user updated successfully"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findorfail($id);
        $user->delete();
        return response()->json([
            "data" => $user,
            "message" => "user deleted successfully"
        ]);
    }
}
