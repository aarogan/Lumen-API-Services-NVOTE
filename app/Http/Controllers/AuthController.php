<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|string|min:5|max:255',
            'email' => 'required|string|max:255|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        if($validator->fails()){
            return response()->json([
                'error' => $validator->errors()
            ]);
        } else {
            $user = User::create([
                'device_id' => $data['device_id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'token' => Str::random(60)
            ]);

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'token' => $user->token,
                'vote' => $user->vote
                ]);
            }
        }
        
        public function login(Request $request)
        {
            $email = $request->email;
            $password = $request->password;
            
            $user = User::where('email', $email)->first();
            if(!$user){
                return response()->json(['message' => 'Login failed'], 401);
            }
            
            $isValidatePassword = Hash::check($password, $user->password);
            if(!$isValidatePassword){
                return response()->json(['message' => 'Login failed'], 401);
            }
            
        return response()->json([
            'id' => $user->id,
            'name' => $user->name,
            'token' => $user->token,
            'vote' => $user->vote,
        ]);
    }
}
