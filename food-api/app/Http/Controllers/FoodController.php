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

    public function get_all_food(Request $request){
        $token_data = auth()->payload();

        $food = Foods::select('id', 'name', 'description', 'price')
        ->where('user_id', $token_data['uuid'])
        ->get();  

        return response()->json($food);
    }

    public function delete_food_by_id(Request $request){
        $token_data = auth()->payload();

        $food = Foods::
        where('user_id', $token_data['uuid'])
        ->where('id', $request->id)
        ->delete();  

        return response()->json($food);
    }

    public function delete_all_food(){
        $token_data = auth()->payload();

        $food = Foods::
        where('user_id', $token_data['uuid'])
        ->delete();  

        return response()->json($food);
    }

    public function update_food_by_id(Request $request){
        $token_data = auth()->payload();

        $food = Foods::
        where('user_id', $token_data['uuid'])
        ->where('id', $request->id)
        ->first();

        $food->update([
            'name' => $request->name ?? $food->name,
            'description' => $request->description ?? $food->description,
            'price' => $request->price ?? $food->price,
        ]);

        return response()->json($food);
    }

}
