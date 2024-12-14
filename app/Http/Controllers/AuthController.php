<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponseTrait;

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            // $user->tokens()->delete();
            $token = $user->createToken($request->userAgent())->plainTextToken;
            $data = [
                'user' => UserResource::make($user),
                'token' => $token,
            ];
            return $this->ApiResponse($data, 'login successfully');
        }
        return $this->ApiResponse(null, 'login failed', 401);
    }

    public function logout()
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        return $this->ApiResponse(null, 'token deleted successfully');
    }
}
