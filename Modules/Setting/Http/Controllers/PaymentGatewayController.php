<?php

namespace Modules\Setting\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Setting\Entities\PaymentGateway;


class PaymentGatewayController extends Controller
{
    public function index()
    {
        $data['paymeny_gateways'] = PaymentGateway::all();
        return view('setting::payment-method', $data);
    }


    public function update(Request $request, $id)
    {
        try {

            $paymentGateway = PaymentGateway::findOrFail($id);
            $paymentGateway->gateway_name = $request->gateway_name;
            $paymentGateway->gateway_username = $request->gateway_username;
            $paymentGateway->gateway_api_key = $request->gateway_api_key;
            $paymentGateway->gateway_secret_key = $request->gateway_secret_key;
            $paymentGateway->redirect_url = $request->redirect_url;
            $paymentGateway->save();

            Toastr::success(__('common.Successfully Updated'), __('common.Success'));
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }

    }


    public function updateActive(Request $request)
    {

        try {
            $allPaymentGateWay = PaymentGateway::all();

            $reqArr = $request->gateways;

            if (is_null($reqArr)) {
                foreach ($allPaymentGateWay as $key => $value) {
                    PaymentGateway::where('id', $value->id)->update(['active_status' => 0]);
                }

            } else {
                foreach ($allPaymentGateWay as $key => $value) {

                    if (in_array($value->id, $reqArr)) {
                        PaymentGateway::where('id', $value->id)->update(['active_status' => 1]);
                    } else {
                        PaymentGateway::where('id', $value->id)->update(['active_status' => 0]);
                    }
                }
            }

            Toastr::success(__('common.Successfully Updated'), __('common.Success'));
            return redirect()->back();
        } catch (Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }


    }
}
