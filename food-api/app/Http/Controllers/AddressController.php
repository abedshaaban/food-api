<?php

namespace App\Http\Controllers;

use AddressInfo;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AddressController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
        $this->user = Auth::user();
    }

    public function create_address(Request $request){
        $token_data = auth()->payload();

        $address = Address::create([
            'user_id'=>$token_data['uuid'],
            'country' => $request->country ,
            'city' => $request->city ,
            'zip_code' => $request->zip_code 
        ]);       

        return response()->json($address);
    }

    public function get_addresses(Request $request){
        $token_data = auth()->payload();

        $addresses_list = Address::
        select('id', 'country', 'city', 'zip_code')
        ->where('user_id', $token_data['uuid'])
        ->get();

        return response()->json($addresses_list);
    }

    public function delete_address_by_id($id){
        $token_data = auth()->payload();

        $address = Address::
        where('user_id', $token_data['uuid'])
        ->where('id', $id)
        ->delete();

        return response()->json($address);
    }
}
