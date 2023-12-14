<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FoodController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
        $this->user = Auth::user();
    }

    public function create_food(Request $request){
        $token_data = auth()->payload();

        return response()->json($token_data);
    }

}
