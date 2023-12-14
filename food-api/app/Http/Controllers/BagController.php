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

    public function create_bag(){
        $token_data = auth()->payload();

        $bag = Bag::create([
            'user_id'=>$token_data['uuid'],
        ]);     

        return response()->json($bag);
    }

    public function get_all_bags(){
        $token_data = auth()->payload();

        $bag = Bag::select('id')
        ->where('user_id', $token_data['uuid'])
        ->get();    

        return response()->json($bag);
    }
}
