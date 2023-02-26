<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;

class LogoutController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    // public function __construct()
    // {
        // $this->middleware('jwt.auth', []);
        // $this->middleware('auth:sanctum');
    // }
    /**
     * Log the user out (Invalidate the token)
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // Invalidate current logged user token
        $user = auth()->user();
        // $user->currentAccessToken()->delete();
        
        // Return message
        return response()->json(['message' => $user->first_name . ' has been Successfully logged out']);
        $user->logout;
    }
}
