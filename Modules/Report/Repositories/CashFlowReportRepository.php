<?php

namespace Modules\Report\Repositories;

use Modules\Account\Entities\ChartAccount;
use Modules\Account\Entities\Voucher;
use Modules\Account\Entities\AccountCategory;
use Modules\Account\Entities\OpeningBalanceHistory;
use Modules\Account\Entities\TimePeriodAccount;
use Modules\Account\Entities\Transaction;
use Modules\Account\Entities\TypeOpeningBalance;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class CashFlowReportRepository implements CashFlowReportRepositoryInterface
{
    public function payments($dateFrom,$dateTo)
    {
        $payments = Transaction::whereHasMorph('voucherable', '*', function(Builder $query) use($dateFrom,$dateTo){
            $query->where('payment_type', 'voucher_payment')->whereBetween('date' , array($dateFrom, $dateTo))->whereHas('transactions');
        })
        ->with(['voucher', 'voucher.transactions', 'account'])
        ->latest()->get();
        
        return $payments;
    }

    public function recieves($dateFrom,$dateTo)
    {
        $recieves = Transaction::whereHasMorph('voucherable', '*', function(Builder $query) use($dateFrom,$dateTo){
            $query->where('payment_type', 'voucher_recieve')->whereBetween('date' , array($dateFrom, $dateTo))->whereHas('transactions');
        })
        ->with(['voucher', 'voucher.transactions', 'account'])
        ->latest()->get();

        return $recieves;
    }
}
