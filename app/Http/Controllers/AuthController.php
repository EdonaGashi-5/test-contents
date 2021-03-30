<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
/*     use ApiResponser; */


    /**
     * Long the user iin if email and password are correct, and returns an auth token.
     */
    public function login(Request $request)
    {

        $attr = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

            
        if (!Auth::attempt($attr)) {
            return $this->error('Credentials not match', 401);
        }



        return [
            'token' => auth()->user()->createToken('API Token')->plainTextToken
        ];
    }

    /**
     * Longs out an authenticated user.
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
