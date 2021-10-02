<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class GoogleController extends Controller
{
    public function redirect()
    {

        return Socialite::driver('google')->redirect();
    }
    public function callback()
    {

        $user = Socialite::driver('google')->user();
        $users = User::firstOrCreate(
            ['email' => $user->getEmail()],
            [
                'password' => Hash::make(Str::random(24)),
                'name' => $user->getName()
            ]
        );

        $token = $users->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];
        // Cookie::queue(Cookie::make('name', 'value', $minutes));
        Auth::login($users);
        dd(Auth::user());
        return redirect('http://10.30.1.146:8081/');
        // return response($response, 201);
    }
    public function gogo(Request $request)
    {
        // if ($request->assertHeaderMissing('myHeader')) {
        //     return 1;
        // }
        dd($request);
    }
}
