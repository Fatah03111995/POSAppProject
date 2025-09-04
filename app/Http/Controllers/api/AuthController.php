<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required|email', // apakah email memiliki format email
            'password'=>'required|string', // apakah password berupa string
        ]);

        //Memastikan apakah user dengan email yang dikirm terdaftar
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        //Jika user ridak ditemukan, kembalikan response error
        if(!$user){
            return response()->json(
                [
                    'message'=>'User not found',
                ], 404
                );
        }

        //Jika user ditemukan, periksa apakah password sesuai, jika tidak sesuai kembalikan response error
        if(!Hash::check($credentials['password'], $user->password))
        {
            return response()->json(
                [
                    'message'=>'Invalid Credentials',
                ], 401
            );
        }

        //Jika email dan password sesuai, buat token baru
        $token = $user->createToken('auth_token')->plainTextToken;
        //createToken adalah method dari trait HasApiTokens
        //plainTextToken adalah token dalam bentuk string

        //Kembalikan response berisi data user dan token
        return response()->json(
            [
                'message'=>'Login Success',
                'token'=>$token,
                'user'=>$user,
            ], 200
        );
    }

    //LOGOUT
    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json(
            [
                'message' => 'Logout success',
            ], 200
            )
        ;
    }
}
