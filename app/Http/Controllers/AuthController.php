<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{   
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
            
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            
        ]);

        try {
            $token  = JWTAuth::fromUser($user);
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'mensage' => 'Error al crear el token JWT',
                'error' => $e->getMessage(),
            ], 500);
        }

    }
public function login(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8'
        ]);
        if ($Validator->fails()) {
            return response()->json([
                'succes' => false,
                'errors' => $Validator->errors(),
            ], 422);
        }
        $credentials = $request->only('email', 'password');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'succes' => false,
                    'message' => 'Credenciales invalidas'
                ], 40);
            }
            return response()->json([
                'succes' => true,
                'token' => $token
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'succes' => false,
                'message' => 'Error al crear el token JWT',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function logout(Request $request){
        try{
           $user = JWTAuth::user();
           JWTAuth::invalidate(JWTAuth::getToken());
           return response()->json([
            'success' => true,
            'message' => $user->name . 'Sesion cerrada correctamente',
           ],200);
        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Error al cerrar la sesion',
                'error' => $e->getMessage(),
            ],500);
        }   
    }

    public function me()
    {
        return response()->json([
            'success' => true,
            'user' => JWTAuth::user()
        ], 200);    
    }

  
}