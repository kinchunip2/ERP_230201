<?php

namespace Modules\Report\Repositories;

use Modules\Purchase\Entities\ProductItemDetail;
use Modules\Inventory\Entities\ShowRoom;
use Modules\Product\Entities\ProductSku;
use Modules\Sale\Entities\Sale;
use Auth;
use Modules\Account\Entities\Transaction;

class CustomerReportRepository implements CustomerReportRepositoryInterface
{

    public function search($account_id)
    {

        return Transaction::where(['account_id' => $account_id])->latest()->get();
    }


}
