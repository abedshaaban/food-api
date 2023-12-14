<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
        $this->user = Auth::user();
    }

    public function update_profile(Request $request){
        $token_data = auth()->payload();

        $user = User::
        select('uuid', 'email', 'first_name', 'last_name', 'phone_number', 'role_id')
        ->where('email', $token_data['email'])->first();

        $user->update([
            "first_name" => $request->first_name ?? $user->first_name,
            "last_name" => $request->last_name ?? $user->last_name,
            "phone_number" => $request->phone_number ?? $user->phone_number
        ]);

        return response()->json($user);
    }

    public function get_user_by_token(Request $request){
        $token_data = auth()->payload();

        $user = User::
        select('uuid', 'email', 'first_name', 'last_name', 'phone_number', 'role_id')
        ->where('email', $token_data['email'])->first();

        return response()->json($user);
    }

}
