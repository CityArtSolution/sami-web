<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ad;

class AdsController extends Controller
{
    public function index(){        
        return view('backend.Ads.index_datatable');
    }
    public function store(Request $request){
        $request->validate([
            'shop_bannar'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'serve_bannar'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'pack_bannar'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $last_ad = Ad::latest()->first();
        $ad = new Ad();
    
        if ($request->hasFile('shop_bannar')) {
            $file = $request->file('shop_bannar');
            $filename = time() . '_' . uniqid() . '_shop_bannar.' . $file->getClientOriginalExtension();
                    
            $destinationPath = '/home/city2tec/public_html/bannars_images';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            
            $file->move($destinationPath, $filename);
            $ad->shop_bannar = 'bannars_images/' . $filename;
        }else{
            $ad->shop_bannar = $last_ad->shop_bannar ?? null;
        }
        if ($request->hasFile('serve_bannar')) {
            $file = $request->file('serve_bannar');
            $filename = time() . '_' . uniqid() . '_serve_bannar.' . $file->getClientOriginalExtension();
                    
            $destinationPath = '/home/city2tec/public_html/bannars_images';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            
            $file->move($destinationPath, $filename);
            $ad->serve_bannar = 'bannars_images/' . $filename;
        }else{
            $ad->serve_bannar = $last_ad->serve_bannar ?? null;
        }
        if ($request->hasFile('pack_bannar')) {
            $file = $request->file('pack_bannar');
            $filename = time() . '_' . uniqid() . '_shop_bannar.' . $file->getClientOriginalExtension();
                    
            $destinationPath = '/home/city2tec/public_html/bannars_images';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0775, true);
            }
            
            $file->move($destinationPath, $filename);
            $ad->pack_bannar = 'bannars_images/' . $filename;
        }else{
            $ad->pack_bannar = $last_ad->pack_bannar ?? null;
        }
    
        $ad->save();
    
        return redirect()->back()->with('success', 'تم حفظ الصور بنجاح ✅');
    }
}
