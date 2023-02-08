<?php

namespace Modules\Report\Repositories;

use Modules\Account\Entities\ChartAccount;
use Modules\Account\Entities\AccountCategory;
use Modules\Account\Entities\OpeningBalanceHistory;
use Modules\Account\Entities\TimePeriodAccount;
use Modules\Account\Entities\Transaction;
use Modules\Account\Entities\TypeOpeningBalance;
use Carbon\Carbon;

class BalanceStatementReportRepository implements BalanceStatementReportRepositoryInterface
{
    public function openingBalancesList($timePeriod)
    {
        $accountingPeriod = TimePeriodAccount::where('id', '>', $timePeriod)->take(1)->first();
         return OpeningBalanceHistory::with('account')->where('time_period_account_id', $accountingPeriod->id)->where('is_default', 1)->get();
    }
}
