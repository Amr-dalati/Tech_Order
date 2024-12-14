<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $data = User::all();
        return $this->ApiResponse(UserResource::collection($data), 'All users successfully');
    }

    public function store(StoreUserRequest $request)
    {
        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        $data->createToken($request->userAgent())->plainTextToken;
        return $this->ApiResponse(UserResource::make($data), 'user created successfully');
    }

    public function show(string $id)
    {
        $data = User::findOrFail($id);
        return $this->ApiResponse(UserResource::make($data), 'user show successfully');
    }

    public function update(UpdateUserRequest $request, string $id)
    {
        $data = User::findOrFail($id);
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->password = $request->input('password');
        $data->role = $request->input('role');
        $data->save();
        return $this->ApiResponse(UserResource::make($data), 'user updated successfully');
    }

    public function delete(string $id)
    {
        $data = User::findOrFail($id);
        if ($data->id != Auth::user()->id && Auth::user()->role == 1) {
            $data->delete();
            return $this->ApiResponse(null, 'user deleted successfully');
        }
        return $this->ApiResponse(null, 'cant  deleted successfully');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6',
            'newPassword' => 'required|string|min:6',
        ]);
        $user = Auth::user();
        if ($user && Hash::check($request->password, $user->password)) {
            $user->password = Hash::make($request->newPassword);
            $user->save();
            return $this->ApiResponse(UserResource::make($user), 'user password updated successfully');
        } else {
            return $this->ApiResponse(null, 'old password not correct');
        }
    }
}
