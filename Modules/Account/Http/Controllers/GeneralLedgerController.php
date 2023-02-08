<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Account\Repositories\LedgerReportRepositoryInterface;
use Modules\Account\Repositories\ChartAccountRepositoryInterface;
use Carbon\Carbon;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Account\Entities\ChartAccount;
use Modules\Account\Entities\OpeningBalanceHistory;


class GeneralLedgerController extends Controller
{

    protected $charAccountRepository, $leadgerRepository;

    public function __construct(ChartAccountRepositoryInterface $charAccountRepository, LedgerReportRepositoryInterface $leadgerRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->charAccountRepository = $charAccountRepository;
        $this->leadgerRepository = $leadgerRepository;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        try{

            $rangeArr = $request->date_range ? explode('-', $request->date_range) : "".date('m/d/Y')." - ".date('m/d/Y')."";

            if($request->date_range){
                $dateFrom = new \DateTime(trim($rangeArr[0]), new \DateTimeZone('Asia/Dhaka'));
                $dateTo =  new \DateTime(trim($rangeArr[1]), new \DateTimeZone('Asia/Dhaka'));
            }


            $accounts = $this->charAccountRepository->all();

            $openingBalance = 0;
            $beforedateAccount = null;
            $accont_type = null;
            $dateFrom = ($request->date_range != null) ? Carbon::parse($dateFrom)->format('Y-m-d') : null;
            $dateTo = ($request->date_range != null) ? Carbon::parse($dateTo)->format('Y-m-d') : null;
            $account_id = ($request->account_id != null) ? $request->account_id : null;
            if ( $request->account_id != null) {
                $beforedateAccount = ChartAccount::findOrFail($request['account_id']);
                $balance = $this->leadgerRepository->balanceBeforeDate($dateFrom, $beforedateAccount);
                $accont_type = $beforedateAccount->type;

                $openingBalance = OpeningBalanceHistory::where('account_id', $account_id)->first()->amount??0;
            }
            else {
                $balance = 0;
            }

            //
            if (!$account_id) {
                $transactions = Null;
            } else{
                $transactions = $this->leadgerRepository->search($dateFrom, $dateTo, $account_id);
            }

            return view('account::statement.index', compact('transactions', 'accont_type', 'accounts', 'dateFrom', 'dateTo', 'account_id', 'balance', 'beforedateAccount','openingBalance'));

        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }


    public function filterAccountBytype($id)
    {
        $accounts = ChartAccount::where('type', $id)->get();


        return response()->json([
            'accounts' => $accounts
        ]);
    }


}
