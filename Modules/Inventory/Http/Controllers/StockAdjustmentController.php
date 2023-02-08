<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\VariantValues;
use Modules\Inventory\Entities\ShowRoom;
use Modules\Product\Repositories\VariantRepositoryInterface;
use Modules\Product\Repositories\ProductRepositoryInterface;
use Modules\Inventory\Repositories\ShowRoomRepositoryInterface;
use Modules\Inventory\Repositories\WareHouseRepositoryInterface;
use Modules\Inventory\Repositories\StockAdjustmentRepositoryInterface;

class StockAdjustmentController extends Controller
{
    protected $stockAdjustment, $productRepository, $wareHouseRepository, $showRoomRepository;

    public function __construct(StockAdjustmentRepositoryInterface $stockAdjustment , ProductRepositoryInterface $productRepository, WareHouseRepositoryInterface $wareHouseRepository, ShowRoomRepositoryInterface $showRoomRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->stockAdjustment = $stockAdjustment;
        $this->productRepository = $productRepository;
        $this->showRoomRepository = $showRoomRepository;
        $this->wareHouseRepository = $wareHouseRepository;
    }

    public function index()
    {
        try{
            $items = $this->stockAdjustment->all();
            return view('inventory::stock_adjustment.index', [
                "items" => $items,
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function create()
    {
        try{
            $ProductList = $this->productRepository->stockProductList(null, session()->get('showroom_id'), ShowRoom::class);
            $warehouses = $this->wareHouseRepository->all();
            $showrooms = $this->showRoomRepository->all();
            return view('inventory::stock_adjustment.create', [
                "products" => $ProductList,
                "showrooms" => $showrooms,
                "warehouses" => $warehouses,
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $validate_rules = [
            "ref_no" => "required",
            "date" => "required",
            "recovery_amount" => "required",
            "warehouse_id" => "required",
            "product" => "required",
            "product_id" =>'required',
            "quantity*" => 'required',
            "notes" => "nullable"
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        try {
            $this->stockAdjustment->create($request->except("_token"));
            \LogActivity::successLog('Stock Adjustment has been Added Successfully');
            Toastr::success(__('inventory.Stock Adjustment has been Added Successfully'));
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function show($id)
    {
        try {
            $ProductList = $this->productRepository->stockProductList(null, session()->get('showroom_id'), ShowRoom::class);

            $stockAdjustment = $this->stockAdjustment->find($id);
            return view('inventory::stock_adjustment.show', [
                "products" => $ProductList,
                "stockAdjustment" => $stockAdjustment,
            ]);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function edit($id)
    {
        try {
            $ProductList = $this->productRepository->stockProductList(null, session()->get('showroom_id'), ShowRoom::class);

            $stockAdjustment = $this->stockAdjustment->find($id);
            $warehouses = $this->wareHouseRepository->all();
            $showrooms = $this->showRoomRepository->all();
            return view('inventory::stock_adjustment.edit', [
                "products" => $ProductList,
                "showrooms" => $showrooms,
                "warehouses" => $warehouses,
                "stockAdjustment" => $stockAdjustment,
            ]);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $validate_rules = [
            "ref_no" => "required",
            "date" => "required",
            "recovery_amount" => "required",
            "warehouse_id" => "required",
            "product" => "required",
            "product_id" =>'required',
            "quantity*" => 'required',
            "notes" => "nullable"
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try {
            $this->stockAdjustment->update($request->except("_token"), $id);
            \LogActivity::errorLog('Stock Adjustment Updated Successfully');
            Toastr::success(__('inventory.Stock Adjustment Updated Successfully'));
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->stockAdjustment->delete($id);
            \LogActivity::errorLog('Stock Adjustment Deleted Successfully');
            Toastr::success(__('product.Stock Adjustment Deleted Successfully'));
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function statusChange($id)
    {

        try {
            $this->stockAdjustment->statusChange($id);
            Toastr::success(__('sale.Sale has Been Approved'), __('common.Success'));
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function product_modal_for_select(Request $request)
    {
        try {
            $type = explode('-', $request->id);
            if ($type[1] == "Single") {
                $data['product_id'] =  $type[0];
                $data['product_type'] =  $type[1];
            }elseif ($type[1] == "Combo") {
                $data['product_id'] =  $type[0];
                $data['product_type'] =  $type[1];
            }else {
                $data['product_id'] =  $type[0];
                $data['product_type'] =  $type[1];
                $data['html'] = (string)view('inventory::stock_adjustment.product_details', [
                    "product" => $this->productRepository->find($type[0])
                ]);
            }
            return response()->json($data);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
        }
    }

    //Ajax Request for Storing Products in Sale,Purchase,Pos
    public function storeProduct(Request $request,VariantRepositoryInterface $variationRepository)
    {
        try {
            $tax = 0;
            $productSku = $this->productRepository->findSku($request->id);

            $sub_total = $productSku->purchase_price;

            $variantName = $variationRepository->variantName($productSku);

            $type = $productSku->id . ",'sku'";
            $output = '';
            $output .= '<tr>
                        <td><input type="hidden" name="product_id[]" value="' . $productSku->id . '" class="primary_input_field sku_id' . $productSku->id . '">' . $productSku->product->product_name . '</br>' . $variantName . '</td>

                        <td class="product_sku' . $productSku->id . '">' . $productSku->sku . '</td>

                        <td><input name="product_price[]" min="0" step="0.01" onkeyup="priceCalc(' . $type . ')" class="primary_input_field product_price product_price_sku' . $productSku->id . '" type="number"
                        value="' . $productSku->purchase_price . '"></td>

                        <td>
                            <input type="number" name="product_quantity[]" value="1" onfocusout="addQuantity(' . $type . ')" class="primary_input_field quantity quantity_sku' . $productSku->id . '">
                        </td>


                        <td class="product_subtotal product_subtotal_sku' . $productSku->id . '">' . $sub_total . '</td>
                        <td><a data-id="' . $productSku->id . '" data-product="' . $productSku->id . '-Normal" class="delete_product primary-btn primary-circle fix-gr-bg new_delete_product" href="javascript:void(0)"><i class="ti-trash"></i></a></td>
                        </tr>

                        ';

            return response()->json($output);

        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return trans('common.Something Went Wrong');
        }
    }

    public function checkQuantity(Request $request)
    {
        try{

            $msg ='';
            if (!$request->house){
                $msg = trans('sale.Select Warehouse or Branch');
                return response()->json($msg);
            }
            $quantity = $this->stockAdjustment->checkQuantity($request->all());
            if (!$quantity || $quantity == null){
                $msg = trans('product.Oops,product not available');
                return response()->json($msg);
            }

            if ($request->quantity > $quantity->stock)
                $msg = trans('product.In your stock you have only').' '. $quantity->stock.' '.trans('product.items left');

            return response()->json($msg);
        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(['error' => __('common.Something Went Wrong')]);
        }


    }
}
