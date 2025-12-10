<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::when(!$request->user()->isAdmin(), function ($query) {
            return $query->where('id', auth()->id());
        })
        ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $users
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:admin,user']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'data' => $user
        ], 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        
        // User biasa hanya bisa melihat profil sendiri
        if (!auth()->user()->isAdmin() && auth()->id() != $id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only view your own profile'
            ], 403);
        }

        return response()->json([
            'success' => true,
            'data' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
      
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found or has been deleted'
            ], 404);
        }

        // User biasa hanya bisa update profil sendiri
        if (!auth()->user()->isAdmin() && auth()->id() != $id) {
            return response()->json([
                'success' => false,
                'message' => 'You can only update your own profile'
            ], 403);
        }

        $rules = [
            'name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
        ];

        // Hanya admin yang bisa mengubah role
        if (auth()->user()->isAdmin()) {
            $rules['role'] = ['sometimes', 'in:admin,user'];
        }

        $request->validate($rules);

        // Update data basic
        $user->update($request->only(['name', 'email', 'role']));

        // Update password jika dikirim
        if ($request->has('password')) {
            $request->validate([
                'password' => ['required', 'confirmed', Rules\Password::defaults()]
            ]);

            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'data' => $user
        ]);
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'User not found'
            ], 404);
        }

        if (auth()->id() == $id) {
            return response()->json([
                'success' => false,
                'message' => 'You cannot delete your own account'
            ], 403);
        }

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }

}