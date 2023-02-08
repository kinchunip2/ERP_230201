<?php

namespace Modules\Report\Http\Controllers;

use App\Traits\Accounts;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Modules\Account\Entities\TimePeriodAccount;
use Modules\Account\Repositories\ChartAccountRepositoryInterface;
use Modules\Report\Repositories\BalanceStatementReportRepository;
use Modules\Account\Repositories\OpeningBalanceHistoryRepositoryInterface;

class BalanceStatementController extends Controller
{
    use Accounts;
    protected $balanceStatementRepositories, $openingBalanceHistoryRepository, $charAccountRepository;

    public function __construct(BalanceStatementReportRepository $balanceStatementRepositories, OpeningBalanceHistoryRepositoryInterface $openingBalanceHistoryRepository, ChartAccountRepositoryInterface $charAccountRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->charAccountRepository = $charAccountRepository;
        $this->balanceStatementRepositories = $balanceStatementRepositories;
        $this->openingBalanceHistoryRepository = $openingBalanceHistoryRepository;
    }
    public function index(Request $request)
    {
        $timePeriods = $this->openingBalanceHistoryRepository->all();
        if ($request->interval) {
            $TimePeriodDetails = TimePeriodAccount::findOrFail($request->interval);
            $timePeriod = $request->interval;
            $closedBalanceList = $this->balanceStatementRepositories->openingBalancesList($timePeriod);
            
            if (count($closedBalanceList) > 0) {
                return view('report::balance_sheet_statements.index', compact('timePeriod', 'timePeriods', 'closedBalanceList'));
            }else {
                Toastr::error(__('common.No data Found'));
                return view('report::balance_sheet_statements.index', compact('timePeriods'));
            }
        }
        return view('report::balance_sheet_statements.index', compact('timePeriods'));
    }
}
