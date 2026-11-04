<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Settings;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class SubscriptionSettings extends Controller
{
     // Return view
     public function index(Request $request){
        return view('admin.Settings.SubscriptionSettings.show',[
            'title'=>'Subscription settings',
            'settings' => Settings::where('id', '=', '1')->first(),
        ]);
    }
    
    //Update Subscription Fees
    public function updatesubfee(Request $request){
        $existingCols = array_map('strtolower', Schema::getColumnListing('settings'));
        if (!in_array('subscription_service', $existingCols, true)) {
            try {
                Schema::table('settings', function (Blueprint $table) {
                    $table->string('subscription_service')->nullable();
                });
            } catch (\Throwable $e) {}
        }
        Settings::where('id', $request['id'] ?: 1)
        ->update([
            'monthlyfee'=>$request['monthlyfee'],
            'quarterlyfee'=>$request['quaterlyfee'],
            'yearlyfee'=>$request['yearlyfee'],
            'subscription_service'=>$request['subscription_service'],
        ]);
        return response()->json(['status' => 200, 'success' => 'Subscription Settings Saved successfully']);
    }
}
