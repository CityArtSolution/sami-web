<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TemporaryBooking;
use Modules\Booking\Models\Booking;
use Modules\Booking\Models\BookingService;
use Illuminate\Support\Facades\Validator;
use App\Models\GiftCard;
use Modules\Service\Models\Service as ServiceModel;
use App\Services\TaqnyatSmsService;
use Modules\Package\Models\Package;

class TempBookingController extends Controller
{
    public function saveTemporary(Request $request)
    {
        $bookingData = $request->all();

        $token = $request->cookie('guest_token') ?? (string) Str::uuid();

        TemporaryBooking::updateOrCreate(
            ['guest_token' => $token],
            [
                'booking_data' => $bookingData,
                'expires_at' => now()->addDays(7)
            ]
        );

        return response()->json([
            'redirect' => '/signin',
            'message'  => 'تم تسجيل البيانات مؤقتاً، يرجى تسجيل الدخول'
        ])->cookie('guest_token', $token, 60 * 24 * 7);
        
    }

    public function finalize(Request $request)
    {
        $token = $request->cookie('guest_token');
        if (! $token) return response()->json(['error' => 'no_guest_token'], 404);

        $temp = TemporaryBooking::where('guest_token', $token)->first();
        if (! $temp) return response()->json(['error' => 'no_temp_booking'], 404);

        $bookingData = $temp->booking_data;
        if(isset($bookingData['delivery_method'])) {
            $selectedServices = array_map('intval', $bookingData['requested_services']);
            $services = ServiceModel::whereIn('id', $selectedServices)->get();
            $services_total = $services->sum('default_price');
            
            
            $selectedPackage = array_map('intval', is_array($bookingData['package_ids']) ? $bookingData['package_ids'] : []);
            $packages = Package::whereIn('id', $selectedPackage)->get();
            $total_packages = $packages->sum('package_price') ?? 0;

            $total = $services_total + $total_packages;

            $smsService = new TaqnyatSmsService();
                
            $phone = $smsService->validatePhoneNumber($bookingData['sender_phone']);
            
            if (!$phone) { return redirect()->back()->with('error', __('messages.invalid_sender_phone'))->withInput();}
            if ($phone) { $smsService->sendGift($phone, $bookingData['sender_name'] , 'sender');}
            
            $phone_2 = $smsService->validatePhoneNumber($bookingData['recipient_phone']);
            
            if (!$phone_2) {return redirect()->back()->with('error', __('messages.invalid_recipient_phone'))->withInput();}
            if ($phone_2) {$smsService->sendGift($phone_2, $bookingData['recipient_name'] , 'recipient');}
            
            $giftCard = GiftCard::create([
                'delivery_method'   => $bookingData['delivery_method'],
                'user_id'           => auth()->id(),
                'sender_name'       => $bookingData['sender_name'],
                'recipient_name'    => $bookingData['recipient_name'],
                'sender_phone'      => $bookingData['sender_phone'],
                'recipient_phone'   => $bookingData['recipient_phone'],
                'requested_services'=> json_encode($bookingData['requested_services']),
                'package_ids'       => json_encode($bookingData['package_ids'] ?? []),
                'subtotal'          => $total,
            ]);
        }else{
            //  التاريخ والوقت
            $startDateTime = \Carbon\Carbon::createFromFormat('Y-m-d H:i', $bookingData['date'] . ' ' . $bookingData['time']);
            //  الحجز
            $booking = new Booking();
            $booking->note = 'العميل: ' . $bookingData['n_name'] .
                '، الجوال: ' . $bookingData['mobile_no'] .
                '، الحي: ' . $bookingData['neighborhood'] .
                '، الجنس: ' . $bookingData['gender'] .
                '، مجموعة الخدمة: ' . $bookingData['service_group_id'] .
                '، الخدمة: ' . $bookingData['service_id'];
                
            $booking->start_date_time = $startDateTime;
            $booking->user_id         = auth()->user()->id;
            $booking->branch_id = $bookingData['branch'] ?? 1;
            $booking->created_by      = auth()->user()->id;
            $booking->status          = 'pending';
            $booking->location          = $bookingData['location'];
            $booking->save();
            //  إنشاء السطر المرتبط في جدول booking_services
            $bookingService = new BookingService();
            $bookingService->booking_id       = $booking->id;
            $bookingService->service_id       = $bookingData['service_id'];
            $bookingService->employee_id      = $bookingData['staff_id'];
            $bookingService->start_date_time  = $startDateTime;
            $bookingService->service_price    = \Modules\Service\Models\Service::find($bookingData['service_id'])->default_price ?? 0;
            $bookingService->duration_min     = $bookingData['service_duration_min']; 
            $bookingService->sequance         = 1;
            $bookingService->change_staff     = $bookingData['auto_change_staff'];
            $bookingService->created_by       = auth()->id(); // أو 1
            $bookingService->save();
        }


        $temp->delete();

        return response()->json(['success' => true])->withoutCookie('guest_token');
    }
    
}

