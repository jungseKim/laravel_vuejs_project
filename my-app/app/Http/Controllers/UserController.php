<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function logOut(Request $request)
    {

        Auth::user()->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json('Successfully logged out');
        // $value = $request->cookie('my-app-token');
        // $request->bearerToken()
    }
    public function index(Request $request)
    {

        $users = User::all();
        $currentUser = Auth::user();

        return response()->json([
            'users' => $users,
            'currentUser' => $currentUser
        ], status: 200);
    }
}
