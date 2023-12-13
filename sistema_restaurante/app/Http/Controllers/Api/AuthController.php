<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function login(Request $request) {
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);
       
        $user = User::where('username', $fields['username'])->first();

      
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credits'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->accessToken;
        
      
        $rol_usuario=DB::table('role_user')->where('user_id',$user->id)->first();
        $roles=Role::where('id',$rol_usuario->role_id)->value('title');
       
        $response = [
            'user' => $user,
            'token' => $token,
            'rol' =>  $roles
        ];

        return response($response, 201);
       
        
    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
