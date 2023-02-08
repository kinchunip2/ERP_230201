<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Account\Http\Requests\ChartAccountFormRequest;
use Modules\Account\Repositories\ChartAccountRepositoryInterface;
use Modules\Account\Entities\ChartAccount;
use Brian2694\Toastr\Facades\Toastr;
class AccountController extends Controller
{
    protected $charAccountRepository;

    public function __construct(ChartAccountRepositoryInterface $charAccountRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->charAccountRepository = $charAccountRepository;
    }

    public function index()
    {
        $data['ChartOfAccountList'] = $this->charAccountRepository->parentNullAccountList();
        return view('account::chart_accounts.chart_accounts',$data);
    }

    public function chart_account()
    {
        return $this->charAccountRepository->all();
    }

    public function parent_category()
    {
        return $this->charAccountRepository->parent_category();
    }

    public function create()
    {
        $ChartOfAccountList = $this->charAccountRepository->parentNullAccountList();
        return view('account::chart_accounts.page_component.chart_accounts_list',compact('ChartOfAccountList'));
    }

    public function store(ChartAccountFormRequest $request)
    {
        $chartAccount = ChartAccount::where('name', $request->name)->first();

        if($chartAccount && $chartAccount->type == $request->type){
            return response()->json(["message" => __('account.This name already taken')], 400);
        }else{
            $this->charAccountRepository->create($request->except("_token"));

            \LogActivity::successLog("New Account Added Successfully");
            return response()->json(["message" => __("account.New Account Added Successfully")], 200);
        }

    }

    public function show($id)
    {
        return view('account::show');
    }

    public function edit($id)
    {
        try {
            return $this->charAccountRepository->find($id);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function update(ChartAccountFormRequest $request, $id)
    {
        try {
            $this->charAccountRepository->update($request->except("_token"), $id);
            \LogActivity::successLog("Chart of Account Updated Successfully");
            return response()->json(["message" => __("account.Chart Account Updated Successfully")], 200);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(["message" => __("common.Something Went Wrong"), "error" => $e->getMessage()], 503);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->charAccountRepository->delete($id);
            if ($delete){
                \LogActivity::successLog("An Account deleted Successfully");
                Toastr::success(__("account.Chart Account Deleted Successfully"));
            }

            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error("Something Went Wrong");
            return back();
        }
    }

    public function rename_account(Request $request)
    {
        try {
            $this->charAccountRepository->rename_account($request->except("_token"));
            \LogActivity::successLog("Chart of Account Updated Successfully");
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return back();
        }
    }
}
