<?php

namespace App\Http\Controllers;

use App\Models\GiftCard;
use Illuminate\Support\Facades\Http;
use App\Models\Service;
use Illuminate\Http\Request;
use Modules\Category\Models\Category;
use Modules\Package\Models\Package;
use Modules\World\Models\State;


use Modules\Service\Models\Service as ServiceModel;

class GiftCardController extends Controller
{

public function index(Request $request)
{

    $States = State::where('status' , 1)->get();

    return view('salon.gift', compact('States'));
}

public function store(Request $request)
{
    $data = $request->validate([
        'delivery_method'     => 'required|string',
        'sender_name'         => 'required|string',
        'recipient_name'      => 'required|string',
        'sender_phone'        => ['required'],
        'recipient_phone'     => ['required'],
        'requested_services'  => 'required|array|min:1',],
      ['delivery_method.required'     => __('messages.gift_card_delivery_method_required'),
        'sender_name.required'         => __('messages.gift_card_sender_required'),
        'recipient_name.required'      => __('messages.gift_card_recipient_required'),
        'sender_phone.required'        => __('messages.gift_card_phone_required'),
        'recipient_phone.required'     => __('messages.gift_card_phone_required'),
        'requested_services.required'  => __('messages.gift_card_service_required'),
        'requested_services.min'       => __('messages.gift_card_service_required'),
    ]);
    $selectedServices = array_map('intval', $data['requested_services']);
    $services = ServiceModel::whereIn('id', $selectedServices)->get();
    $services_total = $services->sum('default_price');


    $total_packages = 0;
    if ($request->filled('package_ids')) {
    $selectedPackage = array_map('intval', $request->package_ids);
    $packages = Package::whereIn('id', $selectedPackage)->get();
    $total_packages = $packages->sum('package_price') ?? 0;
    }

    $coupons_data = null;
    $total_coupons = 0;
    $coupon_names = [];
    if ($request->filled('coupons')) {
        $decodedCoupons = array_map(fn($c) => json_decode($c, true), $request->coupons);
        
        foreach ($decodedCoupons as $data_coupon) {
            if (isset($data_coupon['price'])) {
                $total_coupons += (float) $data_coupon['price'];
            }
            if (isset($data_coupon['name'])) {
                $coupon_names[] = $data_coupon['name'];
            }
        }
    
        $coupons_data = json_encode($decodedCoupons);
    }
    $total = $services_total + $total_packages + $total_coupons;


    $giftCard = GiftCard::create([
        'delivery_method'   => $data['delivery_method'],
        'user_id'           => auth()->id(),
        'sender_name'       => $data['sender_name'],
        'recipient_name'    => $data['recipient_name'],
        'sender_phone'      => $data['sender_phone'],
        'recipient_phone'   => $data['recipient_phone'],
        'requested_services'=> json_encode($data['requested_services']),
        'package_ids'       => json_encode($request->package_ids) ?? null,
        'coupons'           => $coupons_data,
        'subtotal'          => $total,
    ]);
    
    return redirect()->route('cart.page')->with('success', __('messages.gift_added_success'));
}
        
}