<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\World\Models\State;
use Modules\Product\Models\Product;

class BookingsController extends Controller
{
    public function salon(Request $request){
        $b = $request->query('branch');
        $States = State::where('status' , 1)->get();
        $suggest = Product::with(['media' , 'categories'])->where('status', 1)->where('is_featured', 1)->where('deleted_at', null)->get();
        return view('salon.create' , compact('States','b' , 'suggest'));
    }    
}
