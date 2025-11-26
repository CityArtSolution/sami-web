<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GiftCard; // تأكد من وجود هذا الموديل أو عدل المسار حسب مشروعك

class GiftController extends Controller
{
    public function index()
    {
        $module_action = 'List';
        $module_title = 'Gift Cards';
        $gifts = GiftCard::all();
        return view('backend.gift.index_datatable', compact('module_action', 'gifts' , 'module_title'));
    }




    public function destroy($id)
    {
        $gift = GiftCard::findOrFail($id);
        $gift->delete();
        return redirect()->back()->with('success', __('messages.gift_deleted_successfully'));
    }

}
