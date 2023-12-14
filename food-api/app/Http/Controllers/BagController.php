<?php

namespace App\Http\Controllers;

use App\Models\Bag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BagController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
        $this->user = Auth::user();
    }

    public function create_bag(Request $request){
        $token_data = auth()->payload();

        $food = Bag::create([
            'user_id'=>$token_data['uuid'],
        ]);     

        return response()->json($food);
    }
}
