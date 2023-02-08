<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\ProductHistory;
use Modules\Purchase\Entities\CostOfGoodHistory;
use Brian2694\Toastr\Facades\Toastr;

class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        try{

            $items = ProductHistory::latest()->get();
            return view('inventory::product_movements.index', compact('items'));
        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }

    }

    public function cost_of_goods_index()
    {
        try {
            $cost_of_goods = CostOfGoodHistory::with('productSku', 'productSku.product', 'productSku.product.unit_type', 'costable', 'storeable')
                ->latest()->get();
            return view('inventory::cost_of_goods.index', compact('cost_of_goods'));
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }


}
