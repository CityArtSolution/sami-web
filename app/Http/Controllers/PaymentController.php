<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;

class PaymentController extends Controller
{
    public function index(Request $request){
        $type_page = $request->has('ids') ? 'payment' : 'cart';

        if($type_page == 'payment'){
            $cartItems = Booking::with('service.service', 'products.product' , 'service.employee')->where('created_by', auth()->user()->id)->where('status', 'pending')->where('payment_type', 'payment')->whereNull('deleted_by')->where('payment_status', 0)->get();
        }else{
            $cartItems = Booking::with('service.service', 'products.product' , 'service.employee')->where('created_by', auth()->user()->id)->where('status', 'pending')->where('payment_type', 'cart')->whereNull('deleted_by')->where('payment_status', 0)->get();
        }

        $servicePrice = $cartItems->sum(function ($item) {
            return $item->service ? ($item->service->service_price ?? 0) : 0;
        });
        $productPrice = $cartItems->sum(function ($item) {
            return $item->products ? $item->products->sum(fn($p) => ($p->product_price ?? 0) * ($p->product_qty ?? 1)): 0;
        });

        $cartTotal = $servicePrice + $productPrice ;
        
        $discountservice = $cartItems->sum(fn($item) =>
            $item->services->sum(fn($s) => $s->discount_amount ?? 0)
        );
        $discountProduct = $cartItems->sum(fn($item) =>
            $item->products->sum(fn($s) => $s->discounted_price ?? 0)
        );
    
        $discountTotal = $discountservice + $discountProduct;

        $finalPrice = $cartTotal - $discountTotal;
        
        $serviceCount = $cartItems->sum(fn($item) => $item->service ? 1 : 0);

        $productCount = $cartItems->sum(function ($item) {
            return $item->products ? collect($item->products)->count() : 0;
        });
    
        return view('frontend::payment', compact('cartItems', 'finalPrice' , 'discountTotal' , 'serviceCount' , 'productCount' , 'productPrice'));
    }
}
