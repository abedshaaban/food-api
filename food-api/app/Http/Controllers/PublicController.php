<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function get_public_food(){
        $food = Foods::select('id', 'name', 'description', 'price')
        ->get();   

        return response()->json($food);
    }

}
