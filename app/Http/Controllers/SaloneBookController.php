<?php

namespace App\Http\Controllers;

use App\Models\HomeBookService;
use App\Models\ServiceHome;
use App\Models\StaffHome;
use Illuminate\Http\Request;
use App\Models\ServiceGroupHome;
use Modules\Package\Models\Package;
use Modules\Package\Models\PackageService;
use Illuminate\Support\Facades\DB;

class SaloneBookController extends Controller
{


    public function show($id)
    {
     $package = DB::table('packages')
        ->leftJoin('branches', 'packages.branch_id', '=', 'branches.id')
        ->select(
            'packages.*',
            'branches.name as branch_name',
            'branches.description as branch_description'  // جلب وصف الفرع
        )
        ->where('packages.id', $id)
        ->first();

        if (!$package) {
            abort(404, 'Package not found');
        }
    
        // تحويل الباكيج إلى مصفوفة
        $package = (array) $package;
        $package['name'] = json_decode($package['name'], true);
    
        // جلب الخدمات المرتبطة بالباكيج
        $services = DB::table('package_services')
            ->join('services', 'package_services.service_id', '=', 'services.id')
            ->select(
                'package_services.id as package_service_id',
                'package_services.service_price',
                'package_services.discounted_price',
                'services.id as service_id',
                'services.name as service_name',
                'services.duration_min',
                'services.default_price'
            )
            ->where('package_services.package_id', $id)
            ->get();
    

        $currentLocale = app()->getLocale();
        $services->transform(function ($service) use ($currentLocale) {
        $service->service_name = json_decode($service->service_name, true)[$currentLocale] ?? '';
        return $service;
    });


        $totalServicePrice = $services->sum('service_price');
        $totalService = $services->sum('discounted_price');
        $branchDes = $package['branch_description'] ?? '';
        $branchName = json_decode($package['branch_name'], true)[$currentLocale] ?? '';

        return view('home.details', compact('package', 'services', 'totalServicePrice','totalService',  'branchDes' , 'branchName'));
    }
}    
