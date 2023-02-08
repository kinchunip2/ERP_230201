<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Setting\Model\BusinessSetting;
use Modules\Setting\Model\EmailTemplate;
use Modules\Setting\Model\SmsGateway;
use Modules\Setting\Model\GeneralSetting;
use Modules\Setting\Model\DateFormat;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','permission']);
    }

    public function index()
    {
        try {
            $data['business_settings'] = BusinessSetting::where('category_type', null)->get();
            $data['email_templates'] = EmailTemplate::all();
            $data['setting'] = GeneralSetting::first();
            Cache::rememberForever('sms_gateway' , function() {
                   return SmsGateway::all();
                });
            Cache::rememberForever('date_format' , function() {
                   return DateFormat::all();
                });
            return view('setting::index', $data);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error('Something happend Wrong!', 'Error!!');
            return redirect()->back();
        }
    }


    public function update_activation_status(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);
        session()->forget('g_set');
        session()->forget('sms_set');
        session()->forget('smtp_set');
        try {
            $business_setting = BusinessSetting::findOrFail($request->id);
            if ($business_setting != null) {
                $business_setting->status = $request->status;
                $business_setting->save();
                \LogActivity::successLog($business_setting->type.' has been upddated.');
                return 1;
            }
            \LogActivity::errorLog('Error has been detected for BusinessSetting');
            return 0;
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error('Something happend Wrong!', 'Error!!');
            return redirect()->back();
        }
    }
}
