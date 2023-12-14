<?php

namespace App\Http\Controllers;

use App\Models\Foods;
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

        $food = Foods::create([
            'user_id'=>$token_data['uuid'],
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price 
        ]);     

        return response()->json($food);
    }

}
