<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {

        if (!User::first()) {
            User::create(['name' => 'Admin', 'user_role' => 'admin', 'email' => 'admin@admin.admin', 'password' => Hash::make('admin1001')]);
        }

        // User::create(['name' => 'Admin', 'email' => '0', 'phone' => '0', 'password' => Hash::make('a')]);


        $attr = $request->all();
        $validator = Validator::make($attr, [
            'login' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => implode(',', $validator->errors()->all()),
                'data' => []
            ]);
        }

        $success = false;
        $data = $validator->validate();
        $login = $data['login'];
        if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $_ = ['password' => $data['password'], 'email' => $login];
            if (Auth::attempt($_, request('remember') ? true : false)) {
                $success = true;
            }
        } else if (is_numeric($login)) {
            $login = (float) $login;
            if ("243" != substr($login . 0, 3)) {
                $login = "243$login";
            }
            $login = "+" . $login;
            $_ = ['password' => $data['password'], 'phone' => $login];
            if (Auth::attempt($_, request('remember') ? true : false)) {
                $success = true;
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => "Veuillez fournir votre email ou votre numéro de tel.",
                'data' => []
            ]);
        }

        if (!$success) {
            return response()->json([
                'success' => false,
                'message' => "Echec de connexion",
                'data' => []
            ]);
        }

        /** @var \App\Models\User $user **/
        $user = auth()->user();
        $user->update(['derniere_connexion' => now('Africa/Lubumbashi')]);

        return response()->json([
            'success' => true,
            'message' => "Connexion reussi",
            'data' => [
                'token' => $user->createToken('token_' . time())->plainTextToken,
                'user' => $user
            ]
        ]);
    }

    public function logout()
    {
        if (Auth::check()) {
            /** @var \App\Models\User $user **/
            $user = auth()->user();
            $user->tokens()->delete();
            Auth::guard('web')->logout();
        }
        return response()->json([]);
    }
}
