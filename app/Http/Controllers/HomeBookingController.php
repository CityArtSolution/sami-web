<?php

namespace App\Http\Controllers;

use App\Models\HomeBookService;
use App\Models\ServiceHome;
use App\Models\StaffHome;
use App\Models\User;
use App\Models\Branch;
use App\Models\ServiceGroupHome;
use App\Models\StaffWorkingHour;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

// To Payment & SMS
use Illuminate\Support\Facades\Http;
use Modules\Booking\Models\Booking;
use Modules\Category\Models\Category;
use Modules\Service\Models\Service;
use Illuminate\Support\Facades\Log;
use Modules\Booking\Models\BookingService;
use Modules\BussinessHour\Models\BussinessHour;


class HomeBookingController extends Controller
{

public function branchs($id)
{
    $branches = Branch::whereHas('address', function ($query) use ($id) {
        $query->where('state', $id);
    })
    ->with('address.state_data')
    ->select('id', 'name','description')
    ->get();

    return response()->json($branches);
}

public function getServiceGroups(Request $request)
{
    $query = DB::table('categories')->select('id', 'name', 'av2')->whereNull('parent_id')->whereNull('deleted_at');

    $groups = $query->get()->map(function ($item) {
        $item->av2 = $item->av2 ? asset($item->av2) : asset('images/default.jpg');
        return $item;
    });

    return response()->json($groups);
}

public function getServicesByGroup($serviceGroupId, $branchId)
{
    if($branchId != 0){
    $branch = Branch::find($branchId);

    $services = $branch->services()
        ->where('category_id', $serviceGroupId)
        ->get();
    }else{
    $services = DB::table('services')
        ->where('category_id', $serviceGroupId)
        ->whereNull('deleted_by')
        ->whereNull('deleted_at')
        ->get();
    }
    return response()->json($services);
}

public function index(Request $request)
{
    $branchId = (int) $request->get('branch_id');
    $serviceId = (int) $request->get('service_id');

    $query = DB::table('users')
        ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
        ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
        ->join('branch_employee', 'users.id', '=', 'branch_employee.employee_id')
        ->join('service_employees', 'users.id', '=', 'service_employees.employee_id')
        ->where('roles.name', 'employee')
        ->where('model_has_roles.model_type', \App\Models\User::class)
        ->where('users.is_manager', 0)
        ->whereNull('users.deleted_at');

    if ($branchId != 0) {
        $query->where('branch_employee.branch_id', $branchId);
    }

    if ($branchId == 0) {
        $query->where('show_in_home_booking', 1);
    }

    if ($serviceId != 0) {
        $query->where('service_employees.service_id', $serviceId);
    }

    $employees = $query->select('users.*')->get();

    return response()->json($employees);
}

public function getAvailableTimes(Request $request ,$date, $staffId)
{
    $user = User::find($staffId);
    if (!$user) {
        return response()->json([]);
    }
    $branchId = $user->branch->branch_id;
    $shift = $user->shift?->shift_id;
    $dayName = strtolower(Carbon::createFromFormat('Y-m-d', $date)->format('l'));
    $serve_book_min = $request->query('Increasing') ?? 30;
    $min_minutes = $serve_book_min;

    $staffWorkingHours = StaffWorkingHour::where('staff_id', $staffId)->where('day_of_week', $dayName)->orderBy('id', 'desc')->first();

    if ($staffWorkingHours) {
        
    if ($staffWorkingHours->is_holiday) {
        return response()->json([]);
    }
        
    $start = Carbon::createFromFormat('H:i', $staffWorkingHours->start_time);
    $end = Carbon::createFromFormat('H:i', $staffWorkingHours->end_time);

        $bookedTimes = BookingService::where('employee_id', $staffId)->whereDate('start_date_time', $date)
            ->whereHas('booking', function ($q) {
                $q->whereIn('status', ['pending', 'confirmed', 'check_in']);
            })
            ->get(['start_date_time', 'duration_min'])
            ->flatMap(function ($booking) {
                $times = [];
                $start = Carbon::parse($booking->start_date_time);
                $duration = $booking->duration_min ?? 0;
                $steps = floor($duration / 1);
                for ($i = 0; $i < $steps; $i++) { 
                    $times[] = $start->copy()->addMinutes($i * 1)->format('H:i');
                }
            
                return $times;
            })->unique()->values()->toArray();

    $breaks = json_decode($staffWorkingHours->breaks, true) ?? [];

    $availableTimes = [];

    $current = Carbon::parse($date . ' ' . $start->format('H:i'), 'Asia/Riyadh');
    $end = Carbon::parse($date . ' ' . $end->format('H:i'), 'Asia/Riyadh');

    $isToday = Carbon::createFromFormat('Y-m-d', $date)->isToday();
    $now = Carbon::now('Asia/Riyadh')->startOfMinute();

    while ($current <= $end) {
    $timeStr = $current->format('H:i');

    if ($isToday && $current->lt($now)) {
        $current->addMinute();
        continue;
    }

    $isInBreak = false;
    foreach ($breaks as $break) {
        $breakStart = Carbon::parse($date . ' ' . $break['start_break'], 'Asia/Riyadh');
        $breakEnd = Carbon::parse($date . ' ' . $break['end_break'], 'Asia/Riyadh');

        if ($current->between($breakStart, $breakEnd)) {
            $isInBreak = true;
            break;
        }
    }

    if (!$isInBreak && !in_array($timeStr, $bookedTimes)) {
        $availableTimes[] = $timeStr;
    }

    $current->addMinute();
}

    $availableTimes2 = $this->filterAvailableTimes($availableTimes, $serve_book_min);
    
    $availableTimes3 = $this->filterAvailableTimesNotConf($availableTimes2, $bookedTimes, $serve_book_min);


    return response()->json($availableTimes3);

    }
    else{
        $workingHours = BussinessHour::where('branch_id', $branchId)->where('day', $dayName)->where('is_holiday', 0)->where('shift_id', $shift)->orderBy('id', 'desc')->first();
        
        if (!$workingHours) {
            return response()->json([]);
        }
        
        $start = Carbon::createFromFormat('H:i', $workingHours->start_time);
        $end = Carbon::createFromFormat('H:i', $workingHours->end_time);
        
        
        $bookedTimes = BookingService::where('employee_id', $staffId)->whereDate('start_date_time', $date)
            ->whereHas('booking', function ($q) {
                $q->whereIn('status', ['pending', 'confirmed', 'check_in']);
            })
            ->get(['start_date_time', 'duration_min'])
            ->flatMap(function ($booking)  use ($min_minutes) {
                $times = [];
                $start = Carbon::parse($booking->start_date_time);
                $duration = $booking->duration_min ?? 0;
                $steps = floor($duration / $min_minutecs);
                for ($i = 0; $i < $steps; $i++) { 
                    $times[] = $start->copy()->addMinutes($i * $min_minutecs)->format('H:i');
                }
            
                return $times;
            })->unique()->values()->toArray();

        $breaks = $workingHours->breaks;
        
        $availableTimes = [];
        
        $current = Carbon::parse($date . ' ' . $start->format('H:i'), 'Asia/Riyadh');
        $end = Carbon::parse($date . ' ' . $end->format('H:i'), 'Asia/Riyadh');
        
        $isToday = Carbon::createFromFormat('Y-m-d', $date)->isToday();
        $now = Carbon::now('Asia/Riyadh')->startOfMinute();
        
        while (true) {
            $timeStr = $current->format('H:i');
        
            if ($isToday && $current->lt($now)) {
                $current->addMinutes($min_minutecs);
                if ($current->gt($end)) break;
                continue;
            }
        
            $isInBreak = false;
            foreach ($breaks as $break) {
                $breakStart = Carbon::parse($date . ' ' . $break['start_break'], 'Asia/Riyadh');
                $breakEnd = Carbon::parse($date . ' ' . $break['end_break'], 'Asia/Riyadh');
        
                if ($current->between($breakStart, $breakEnd)) {
                    $isInBreak = true;
                    break;
                }
            }
        
            if (!$isInBreak && !in_array($timeStr, $bookedTimes)) {
                $availableTimes[] = $timeStr;
            }
        
            $current->addMinutes($min_minutecs);
        
            if ($current->gt($end)) break;
        }
    
    $availableTimes2 = $this->filterAvailableTimes($availableTimes, $serve_book_min);

    return response()->json($availableTimes2);
    }
    
}

public function store(Request $request)
{
    try {
        Log::info('Booking data berfo validated successfully', $request);

        $data = $request->validate([
            'customer_name'     => 'required|string|max:255',
            'mobile_no'         => 'required|string|max:20',
            'neighborhood'      => 'required|string|max:255',
            'gender'            => 'required|in:men,women',
            'service_group_id'  => 'required|exists:service_group_homes,id',
            'service_id'        => 'required|exists:service_homes,id',
            'date'              => 'required|date',
            'time'              => 'required|string',
            'branch'            => 'required|exists:branches,id',
            'staff_id'          => 'required|exists:staff_homes,id',
        ]);
        Log::info('Booking data validated successfully', $data);

        $booking = new Booking();
        $booking->note = 'Customer: ' . $data['customer_name'] . ', Mobile: ' . $data['mobile_no'] .
            ', Neighborhood: ' . $data['neighborhood'] . ', Gender: ' . $data['gender'];
        $booking->status = 'pending';
        $booking->start_date_time = $data['date'] . ' ' . $data['time'];
        $booking->user_id = $data['staff_id'];
        $booking->branch_id = $data['branch'];
        $booking->created_by = 1;

        $booking->save();

        return response()->json(['message' => 'Booking saved successfully']);
    } catch (\Exception $e) {
        Log::error('Booking Store Error: ' . $e->getMessage(), [
            'stack' => $e->getTraceAsString(),
            'request_data' => $request->all(),
        ]);

        return response()->json([
            'message' => 'حدث خطأ أثناء حفظ الحجز',
            'error' => $e->getMessage(), 
        ], 500);
    }
}
//        Payment Methods

public function handlePaymentResult(Request $request)
{
    $tapId = $request->get('tap_id');

    if (!$tapId) {
        return response()->json([
            'status' => false,
            'message' => 'No tap_id provided.'
        ], 400);
    }

    $response = Http::withHeaders([
        'Authorization' => 'Bearer ' . env('TAP_SECRET_KEY'),
    ])->get("https://api.tap.company/v2/charges/{$tapId}");

    $charge = $response->json();

    if (isset($charge['status']) && $charge['status'] === 'CAPTURED') {
        return response()->json([
            'status' => true,
            'message' => 'Payment captured successfully.',
            'data' => $charge,
        ]);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Payment failed or was declined.',
            'data' => $charge,
        ], 402);
    }
}

/*-----------------------Helper function to filter time---------------------------*/
function filterAvailableTimes($availableTimes, $serviceDuration) {
    $filtered = [];
    $count = count($availableTimes);

    for ($i = 0; $i < $count; ) {
        $startTime = $availableTimes[$i];
        $filtered[] = $startTime;

        // اقفز بعدد الدقايق الخاصة بالخدمة
        $nextIndex = $i;
        $targetTime = Carbon::createFromFormat('H:i', $startTime)
            ->addMinutes($serviceDuration)
            ->format('H:i');

        // دور على أقرب وقت يساوي أو أكبر من target
        while ($nextIndex < $count && $availableTimes[$nextIndex] < $targetTime) {
            $nextIndex++;
        }

        $i = $nextIndex;
    }

    return $filtered;
}


/*-----------------------Helper function to filter time---------------------------*/
function filterAvailableTimesNotConf($availableTimes, $bookedTimes, $serve_book_min) {
    $result = [];

    foreach ($availableTimes as $time) {
        $start = strtotime($time);
        $end   = $start + ($serve_book_min * 60);

        $conflict = false;

        foreach ($bookedTimes as $booked) {
            $bookedTimestamp = strtotime($booked);

            // لو وقت الحجز داخل الفترة [start, end]
            if ($bookedTimestamp >= $start && $bookedTimestamp < $end) {
                $conflict = true;
                break;
            }
        }

        if (!$conflict) {
            $result[] = $time;
        }
    }

    return $result;
}

}
