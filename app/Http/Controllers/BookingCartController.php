<?php

namespace App\Http\Controllers;
use App\Models\BookingCart;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\BookingService;
use Modules\Booking\Models\BookingProduct;
use Modules\Wallet\Models\Wallet;
use App\Models\LoyaltyPoint;
use App\Services\TaqnyatSmsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;
use Modules\Booking\Models\BookingTransaction;
use Carbon\Carbon;
use App\Models\GiftCard;
use Illuminate\Support\Str;
use Modules\Product\Models\Product;
use Modules\Product\Models\Cart;



class BookingCartController extends Controller
{


    public function index(Request $request)
    {
        $cartItems = Booking::with('service.service', 'products.product' , 'service.employee')->where('created_by', auth()->user()->id)->where('status', 'pending')->where('payment_type', 'cart')->whereNull('deleted_by')->where('payment_status', 0)->get();

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
    
        return view('components.frontend.cart', compact('cartItems', 'finalPrice' , 'discountTotal' , 'serviceCount' , 'productCount'));
    }

     public function store(Request $request)
    {
        $user = auth()->user();
        $data = $request->all();
        $btn_value = $request->btn_value;
        $branch = $data['branch'];
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'يرجى تسجيل الدخول أولاً.'
                ], 401);
            }
            if (!empty($data['services'])) {
                foreach ($data['services'] as $service) {
                    if (!empty($service['subServices'])) {
                        foreach ($service['subServices'] as $sub) {
                            $subId = $sub['id'];
                            $date = $sub['date'];
                            $time = $sub['time'];
                            $duration = $sub['duration'];
                            $price = $sub['price'];
                            $staffId = $sub['staffId'];
                            $startDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $date . ' ' . $time);
                            
                            $booking = new Booking();
                            $booking->note = 'العميل: ' . $user->first_name .
                                '، الجوال: ' .  $user->mobile .
                                '، الخدمة: ' . $subId;
                            $booking->start_date_time = $startDateTime;
                            $booking->user_id         = $user->id;
                            $booking->branch_id       = $data['branch'] ?? 1;
                            $booking->created_by      = $user->id;
                            $booking->status          = 'pending';
                            $booking->location       =  null;
                            $booking->payment_type       =  $btn_value;
                            $booking->save();
                            
                            //  الحجز التاني
                            $bookingService = new BookingService();
                            $bookingService->booking_id       = $booking->id;
                            $bookingService->service_id       = $subId;
                            $bookingService->employee_id      = $staffId;
                            $bookingService->start_date_time  = $startDateTime;
                            $bookingService->service_price    = \Modules\Service\Models\Service::find($subId)->default_price ?? 0;
                            $bookingService->duration_min     = $duration;
                            $bookingService->sequance         = 1;
                            $bookingService->created_by      = $user->id;
                            $bookingService->save();

                            $loyalty = \App\Models\LoyaltyPoint::firstOrCreate(
                                ['user_id' => $user->id],
                                ['points' => 0]
                            );
                        }
                    }
                }
            }
            return response()->json([
                'success' => true,
                'message' => __('messages.booking_added_to_cart')
            ], 201);
        }
    
    public function destroy($id)
    {
        $user = auth()->user();
    
        $booking = Booking::find($id);
    
        if (!$booking) {
            return response()->json(['message' => 'Cart item not found'], 404);
        }
        
        $booking->delete();
    
        return redirect()->back()->with('success', __('messages.item_removed_from_cart'));
    } 
    
    public function destroy_All()
    {
        $user = auth()->user();
        
        $bookings = Booking::with('services', 'products')->where('user_id', $user->id)->where('payment_status', 0)->get();
        
        foreach ($bookings as $booking) {
            $booking->services()->delete();
    
            $booking->products()->delete();
    
            $booking->delete();
        }

        return redirect()->back()->with('success', __('messages.items_removed_from_cart'));
    }

    public function cartPay(Request $request)
    {
        $user = auth()->user();

        $discountAmount = $request->discount_amount;
        $loyaltyDiscount = $request->loyalty_discount;
        $finalTotal = $request->final_total;
        $totalDiscount = $discountAmount + $loyaltyDiscount;

        session([ 'discountAmount' => $discountAmount   ,   'loyaltyDiscount' => $loyaltyDiscount   ,   'finalTotal' => $finalTotal ]);

        if ($request->pay == 'card') {
            $total = $request->final_total;

            try {
                $apiKey1 = env('TAP_SECRET_KEY');
                $response = Http::withHeaders([
                    'Authorization' => "Bearer $apiKey1",
                    'Content-Type' => 'application/json',
                ])->post('https://api.tap.company/v2/charges', [
                    "amount" => $total,
                    "currency" => "SAR",
                    "threeDSecure" => true,
                    "save_card" => false,
                    "description" => "طلب دفع",
                    "statement_descriptor" => "Jospa Store",
                    "customer" => [
                        "first_name" => auth()->user()->first_name,
                        "email" => auth()->user()->email ,
                    ],
                    "source" => [
                        "id" => "src_all"
                    ],
                    "redirect" => [
                        "url" => url("/success-py-invoice")
                    ]
                ]);

                $data = $response->json();
        
                if (isset($data['transaction']['url'])) {
                    return redirect()->to($data['transaction']['url']);
                }
        
                return view('components.frontend.status.ERPAY');

            } catch (\Exception $e) {
                return redirect()->back()->with('error', __('messages.payment_failed'))->withInput();
            }

        }elseif ($request->pay == 'giftCard'){
            
            $ref = GiftCard::where('ref', $request->ref )->where('delivery_method', 'بطاقة الكترونية' )->first();
            if($ref){
                $balance = $ref->balance ?? 0.00 ;
                $amountToPay = $finalTotal;
                
                if($balance >= $amountToPay){
                    $ref->balance -= $amountToPay;
                    $ref->save();
                    
                    $cartIds = Booking::where('user_id', $user->id)
                    ->where('payment_status', 0)
                    ->pluck('id')
                    ->toArray();
                    
                $gift_ids = GiftCard::where('user_id', $user->id)
                    ->where('payment_status', 0)
                    ->pluck('id')
                    ->toArray();
                    
                    if ($loyaltyDiscount > 0) {
                    DB::table('loyalty_points')
                        ->where('user_id', $user->id)
                        ->where('points', '>=', $loyaltyDiscount)
                        ->decrement('points', $loyaltyDiscount);
                    }

                $this->addLoyaltyPoints($user->id, $amountToPay);
                $this->storeInvoice($user->id, $discountAmount, $loyaltyDiscount, $finalTotal, $cartIds , $gift_ids);
                $this->paymentSuccess( $cartIds , null , 'Gift Card');

                Booking::where('user_id', $user->id)
                    ->where('payment_status', 0)
                    ->update(['payment_status' => 1]);
                    
                $this->activateGiftCards($user->id);

                return redirect()->back()->with('success', __('messages.gift_card_payment_success'));
                }else{
                    return redirect()->back()->with('error', __('messages.gift_card_insufficient_balance'))->withInput();
                }
                
            }else{
                return redirect()->back()->with('error', __('messages.invalid_reference_number'))->withInput();
            }     
                

        } elseif ($request->pay == 'wallet') {
            $wallet = Wallet::where('user_id', $user->id)->first();
            $balance = $wallet ? $wallet->amount : 0.00;
            $amountToPay = $finalTotal;

            if ($balance >= $amountToPay) {
                // خصم المبلغ
                $wallet->amount -= $amountToPay;
                $wallet->save();

                $cartIds = Booking::where('user_id', $user->id)
                    ->where('payment_status', 0)
                    ->pluck('id')
                    ->toArray();
                    
                $gift_ids = GiftCard::where('user_id', $user->id)
                    ->where('payment_status', 0)
                    ->pluck('id')
                    ->toArray();
                    
                    if ($loyaltyDiscount > 0) {
                    DB::table('loyalty_points')
                        ->where('user_id', $user->id)
                        ->where('points', '>=', $loyaltyDiscount)
                        ->decrement('points', $loyaltyDiscount);
                    }

                $this->addLoyaltyPoints($user->id, $amountToPay);
                $this->storeInvoice($user->id, $discountAmount, $loyaltyDiscount, $finalTotal, $cartIds , $gift_ids);
                $this->paymentSuccess( $cartIds , null , 'wallet');

                Booking::where('user_id', $user->id)
                    ->where('payment_status', 0)
                    ->update(['payment_status' => 1]);
                    
                $this->activateGiftCards($user->id);

                return redirect()->back()->with('success', __('messages.wallet_payment_success'));
            } else {
                return redirect()->back()->with('error', __('messagess.wallet_insufficient_balance')); 
            }
        
            
        }else{
             return redirect()->back()->with('error', __('messages.please_select_payment_method'))->withInput();
        }
    }
    
     public function balance(Request $request)
    {
        $user = $request->user(); // المستخدم الحالي من التوكن

        $points = DB::table('loyalty_points')
                    ->where('user_id', $user->id)
                    ->sum('points'); // لو في أكثر من سجل، نجمع النقاط كلها

        return response()->json([
            'user_id' => $user->id,
            'loyalty_points' => $points,
        ]);
    }

    public function handlePaymentResult(Request $request)
    {
        $tapId = $request->get('tap_id');
    
        if (!$tapId) {
            if ($request->expectsJson()) {
                return response()->json(['status' => false, 'message' => 'No tap_id provided.'], 400);
            }
            return view('components.frontend.status.ERPAY')->with('error', 'No tap_id provided.');
        }
    
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
        ])->get("https://api.tap.company/v2/charges/{$tapId}");
    
        $charge = $response->json();
    
        if (isset($charge['status']) && $charge['status'] === 'CAPTURED') {
            $user = auth()->user();
    
            $discountAmount = session('discountAmount', 0);
            $loyaltyDiscount = session('loyaltyDiscount', 0);
            $totalDiscount = $discountAmount + $loyaltyDiscount;
            $finalTotal = session('finalTotal', 0);
    
            $cartIds = Booking::where('user_id', $user->id)
                    ->where('payment_status', 0)
                    ->pluck('id')
                    ->toArray();
                        
            $gift_ids = GiftCard::where('user_id', $user->id)
                    ->where('payment_status', 0)
                    ->pluck('id')
                    ->toArray();
                        
            if ($loyaltyDiscount > 0) {
                DB::table('loyalty_points')
                    ->where('user_id', $user->id)
                    ->where('points', '>=', $loyaltyDiscount)
                    ->decrement('points', $loyaltyDiscount);
            }
    
            $this->addLoyaltyPoints($user->id, $charge['amount']);
            $this->storeInvoice($user->id, $discountAmount, $loyaltyDiscount, $finalTotal, $cartIds , $gift_ids);
            $this->paymentSuccess( $cartIds , $tapId , 'card');
    
            Booking::where('user_id', $user->id)
                ->where('payment_status', 0)
                ->update(['payment_status' => 1]);
            
            $this->activateGiftCards($user->id);

            if ($request->expectsJson()) {
                return response()->json([
                    'status' => true,
                    'message' => 'Payment successful.',
                    'data' => $charge
                ]);
            }
    
            return view('components.frontend.status.CAPTURED');
        } else {
            if ($request->expectsJson()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Payment failed or not captured.',
                    'tap_response' => $charge
                ]);
            }
    
            return view('components.frontend.status.FAILED');
        }
}

    public function addLoyaltyPoints($userId, $paidAmount)
    {
        $pointsToAdd = floor($paidAmount / 100) * 5;

        if ($pointsToAdd <= 0) {
            return;
        }

        $loyalty = LoyaltyPoint::firstOrNew(['user_id' => $userId]);
        $loyalty->points = ($loyalty->points ?? 0) + $pointsToAdd;
        $loyalty->save();
    }

    private function storeInvoice($userId, $discountAmount, $loyaltyDiscount, $finalTotal, $cartIds , $gift_ids = null)
    {
        Invoice::create([
            'user_id' => $userId,
            'cart_ids' => json_encode($cartIds),
            'gift_ids' => json_encode($gift_ids),
            'discount_amount' => $discountAmount,
            'loyalty_points_discount' => $loyaltyDiscount,
            'final_total' => $finalTotal,
        ]);
    }

    public function checkLoyaltyPoints(Request $request)
    {
        $user = auth()->user();
        $points = LoyaltyPoint::where('user_id', $user->id)->value('points') ?? 0;

        return response()->json([
            'points' => $points,
        ]);
    }

    private function paymentSuccess( array $cartIds , $tapId = null , $paymentMethod): void
    {
        foreach ($cartIds as $bookingId) {
            BookingTransaction::create([
                'booking_id'     => $bookingId,
                'external_transaction_id' => $tapId,
                'transaction_type' => $paymentMethod,
                'payment_status' => 1,
            ]);
        }
    }
    
    private function activateGiftCards($userId)
    {
        // sms
        $smsService = new TaqnyatSmsService();
        
        $giftCards = GiftCard::where('user_id', $userId)
            ->where('payment_status', 0)
            ->get();
    
        foreach ($giftCards as $giftCard) {
            $ref = null;
            $balance = 0;
    
            if ($giftCard->delivery_method == 'بطاقة الكترونية') {
                $ref = 'REF-' . strtoupper(Str::random(8));
                $balance = $giftCard->subtotal;
            }
    
        $giftCard->update([
                'payment_status' => 1,
                'ref'            => $ref,
                'balance'        => $balance,
            ]);

        $phone = $giftCard->sender_phone;
    
        if ($phone) { $smsService->sendGift($phone, $giftCard->sender_name , 'sender');}
    
        $phone_2 = $giftCard->recipient_phone;
    
        if ($phone_2) {$smsService->sendGift($phone_2, $giftCard->recipient_name , 'recipient' , $ref);}
        }
    }
    
    public function addToCart(Request $request , $id){
        
        $qty = $request->query('qty', 1);
        
        $exist = BookingProduct::where('product_id', $id)
            ->whereHas('booking', function ($q) {
                $q->where('user_id', auth()->user()->id)->where('payment_status' , 0);
            })->first();
            
        if ($exist) {
            return response()->json(['message' => 'المنتج محجوز بالفعل في السلة الحالية',]);
        }

        $product = Product::findOrFail($id);
            
            $booking = Booking::create([
                'status' => 'pending',
                'payment_status' => 0,
                'start_date_time' => now(),
                'user_id' => auth()->user()->id,
                'branch_id' => 1,
                'created_by' => auth()->user()->id,
            ]);
            BookingProduct::create([
                'booking_id' => $booking->id,
                'employee_id' => 1,
                'product_id' => $id,
                'product_qty' => $qty,
                'product_variation_id' => 1,
                'product_price' => $product->max_price ?? $product->min_price
            ]);
            Cart::Create([
                'product_id' => $id,
                'product_variation_id' => 1,
                'qty' => $qty,
                'user_id' => auth()->user()->id,
                'location_id' => 1,
            ]);
            return response()->json(['message' => 'تم إضافة المنتج إلى السلة بنجاح']);
        }
}