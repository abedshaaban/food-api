<?php

namespace App\Http\Controllers;

use App\Models\ItemBag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
        $this->user = Auth::user();
    }

    public function add_item_to_bag(Request $request){
        $item = ItemBag::create([
            'quantity' => $request->quantity,
            'food_id' => $request->food_id,
            'bag_id' => $request->bag_id,
        ]);

        return response()->json($item);
    }

    public function get_items_from_bag(Request $request){
        $item = ItemBag::select('id', 'quantity', 'foods.name', 'foods.description', 'foods.price')
        ->join('foods', 'bag_items.food_id','=','foods.id')
        ->where('bag_id', $request->id)
        ->get();  

        return response()->json($item);
    }

    public function remove_item_from_bag(Request $request){
        $item = ItemBag::
        where('id', $request->id)
        ->delete(); 

        return response()->json($item);
    }
}
