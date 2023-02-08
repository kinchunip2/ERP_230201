<?php

namespace Modules\Product\Http\Controllers;

use PDF;
use App\User;
use App\Traits\PdfGenerate;
use App\Traits\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Product\Entities\PartNumber;
use Illuminate\Contracts\Support\Renderable;
use Modules\Product\Http\Requests\ProductFormRequest;
use Modules\Product\Entities\ProductSellingPriceHistory;
use Modules\Product\Repositories\BrandRepositoryInterface;
use Modules\Product\Http\Requests\ProductUpdateFormRequest;
use Modules\Product\Repositories\ProductRepositoryInterface;
use Modules\Product\Repositories\VariantRepositoryInterface;
use Modules\Product\Repositories\CategoryRepositoryInterface;
use Modules\Product\Repositories\UnitTypeRepositoryInterface;
use Modules\Product\Repositories\ModelTypeRepositoryInterface;
use Modules\Inventory\Repositories\ShowRoomRepositoryInterface;
use Modules\Inventory\Repositories\WareHouseRepositoryInterface;
use Modules\Inventory\Repositories\StockTransferRepositoryInterface;

class ProductController extends Controller
{
    use PdfGenerate,Notification;

    protected $modelRepository, $unitTypeRepository, $brandRepository, $categoryRepository, $variationRepository, $productRepository,$wareHouseRepository,
        $showRoomRepository,$stockTransferRepository;

    public function __construct(ModelTypeRepositoryInterface $modelRepository, UnitTypeRepositoryInterface $unitTypeRepository, BrandRepositoryInterface $brandRepository,
                                CategoryRepositoryInterface $categoryRepository, VariantRepositoryInterface $variationRepository, ProductRepositoryInterface $productRepository,
                                WareHouseRepositoryInterface $wareHouseRepository, ShowRoomRepositoryInterface $showRoomRepository,StockTransferRepositoryInterface $stockTransferRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->modelRepository = $modelRepository;
        $this->unitTypeRepository = $unitTypeRepository;
        $this->brandRepository = $brandRepository;
        $this->categoryRepository = $categoryRepository;
        $this->variationRepository = $variationRepository;
        $this->productRepository = $productRepository;
        $this->wareHouseRepository = $wareHouseRepository;
        $this->showRoomRepository = $showRoomRepository;
        $this->stockTransferRepository = $stockTransferRepository;
    }

    public function index()
    {
        try{
            $models = $this->modelRepository->all()->where('status', 1);
            $units = $this->unitTypeRepository->all()->where('status', 1);
            $brands = $this->brandRepository->all()->where('status', 1);
            $categories = $this->categoryRepository->category()->where('status', 1);
            $sub_categories = $this->categoryRepository->allSubCategory()->where('status', 1);
            $variants = $this->variationRepository->all()->where('status', 1);
            $productSkus = $this->productRepository->allProduct();
            $services = $this->productRepository->service();
            $showrooms = $this->showRoomRepository->all()->where('status', 1);
            $wareHouses = $this->wareHouseRepository->all()->where('status', 1);
            return view('product::product.add_product', [
                "models" => $models,
                "units" => $units,
                "brands" => $brands,
                "categories" => $categories,
                "sub_categories" => $sub_categories,
                "productSkus" => $productSkus,
                "variants" => $variants,
                "wareHouses" => $wareHouses,
                "showrooms" => $showrooms,
                "services" => $services
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function category_wise_subcategory($category)
    {
        return $this->categoryRepository->subcategory($category);
    }

    public function variation_list($variant)
    {
        return $this->variationRepository->variantValues($variant);
    }

    public function variant_with_values($variant)
    {
        return $this->variationRepository->variantWithValues($variant);
    }

    public function create(Request $request)
    {
        try{
            $comboProducts = $this->productRepository->allComboProduct();
            return view('product::product.list_products', [
                "comboProducts" => $comboProducts
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function get_regular_product(Request $request)
    {
        $search_keyword =  $request['search']['value'];
        $data['search']['value'] = null;
        $request->merge($data);

        try{
            return DataTables::of($this->productRepository->allQuery($search_keyword))
                ->addIndexColumn()
                ->addColumn('image',function($productSkus){
                    return view('product::product.product_components.image',compact('productSkus'));
                })
                ->addColumn('product_name',function($productSkus){
                    return view('product::product.product_components.product_name',compact('productSkus'));
                })
                ->addColumn('origin', function($productSkus){
                    return (app('general_setting')->origin == 1) ? $productSkus->product->origin : $productSkus->sku;
                })
                ->addColumn('brand', function($productSkus){
                    return @$productSkus->product->brand->name;
                })
                ->addColumn('model', function($productSkus){
                    return @$productSkus->product->model->name;
                })
                ->addColumn('purchase_price', function($productSkus){
                    return single_price($productSkus->purchase_price);
                })
                ->addColumn('selling_price', function($productSkus){
                    return single_price($productSkus->selling_price);
                })
                ->addColumn('min_selling_price', function($productSkus){
                    return single_price($productSkus->min_selling_price);
                })
                ->addColumn('stock', function($productSkus){
                    return ($productSkus->stock()->exists()) ? $productSkus->stock->stock : '';
                })
                ->addColumn('supplier', function($productSkus){
                    return ($productSkus->item()->exists()) ? @$productSkus->item->itemable->supplier->name : '';
                })
                ->addColumn('product_type', function($productSkus){
                    return __('product.'.(@$productSkus->product->product_type == 'Variable') ? 'Variant' : 'Single');
                })
                ->addColumn('category', function($productSkus){
                    return @$productSkus->product->category->name;
                })
                ->addColumn('stock_alert', function($productSkus){
                    return $productSkus->alert_quantity.' '.@$productSkus->product->unit_type->name;
                })
                ->addColumn('action',function($productSkus){
                    return view('product::product.product_components.action',compact('productSkus'));
                })
                ->rawColumns(['action'])
                ->make(true);

        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function service(Request $request)
    {
        try{
            $products = $this->productRepository->service ();
            return view('product::product.list_service', [
                "products" => $products,
            ]);
        }catch(\Exception $e){

            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function serial_key_index($id)
    {
        try{
            $items = PartNumber::where('product_sku_id', $id)->get();
            $product = $this->productRepository->findSku($id);
            return view('product::product.serial_key', [
                "items" => $items,
                "product" => $product
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function store(ProductFormRequest $request)
    {

        DB::beginTransaction();
        try {
            $product = $this->productRepository->create($request->except("_token"));
            
            $users=User::whereIn('role_id',[1,2])
                    ->where('id','!=',auth()->user()->id)->where('is_active','1')
                    ->get(['id','role_id']);
               
            $subject = $request->product_name;
            $class = $product;
            $data = __('notification.A Product Has been Created');
            $url = route('add_product.create');

            $this->sendNotification($class,null,$subject,null,null,$data,$users,$role_id=null,$url);

                

            DB::commit();
            \LogActivity::successLog('New Product - ('.$request->product_name.') has been created.');
            if ($request->ajax()) {
                return response()->json(['message' => __('product.Product has been added Successfully'), 'goto' => route('add_product.index')]);
            }
            else{
                Toastr::success(__('product.Product has been added Successfully'));
                return back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Product creation');
            if ($request->ajax()) {
                return $e;
            }
            else{
                Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
                return back();
            }

        }
    }

    public function show($id)
    {
        try {
            $productCombo = $this->productRepository->findCombo($id);
            $productSkus = $this->productRepository->allProduct();
            return view('product::product.edit_combo_product', [
                "productCombo" => $productCombo,
                "productSkus" => $productSkus
            ]);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(["error" => $e->getMessage()], 503);
        }
    }

    public function edit($id)
    {
        try{
            $product = $this->productRepository->find($id);
            $product_variant_type = json_decode(collect($product->variations)->pluck("variant_id")->first());
            $units = $this->unitTypeRepository->all();
            $brands = $this->brandRepository->all();
            $categories = $this->categoryRepository->category();
            $variants = $this->variationRepository->all();
            $variant_values = $variants->pluck("values")->flatten()->toArray();
            $models = $this->modelRepository->all();
            $showrooms = $this->showRoomRepository->all();
            $wareHouses = $this->wareHouseRepository->all();
            return view('product::product.edit_product', [
                "models" => $models,
                "product" => $product,
                "units" => $units,
                "brands" => $brands,
                "categories" => $categories,
                "variants" => $variants,
                "variant_values" => $variant_values,
                "product_variant_type" => $product_variant_type,
                "wareHouses" => $wareHouses,
                "showrooms" => $showrooms
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function update(ProductUpdateFormRequest $request, $id)
    {


        DB::beginTransaction();

        try {
            $this->productRepository->update($request->except("_token"), $id);
            DB::commit();

            Toastr::success(__('product.Product has been updated Successfully'));
            if ($request->product_type == 'Service') {
                return redirect()->route("add_product.service");
            }

            return redirect()->route("add_product.create");

        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Product creation');
            DB::rollBack();
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->productRepository->delete($id);
            Toastr::success(__('product.Product has been deleted Successfully'));
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Product creation');
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function destroyCombo($id)
    {
        try {
            $this->productRepository->deleteCombo($id);
            Toastr::success(__('product.Product has been deleted Successfully'));
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Product creation');
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function product_Detail(Request $request)
    {
        try {
            if ($request->type != "combo") {
                $product = $this->productRepository->find($request->id);
                $product_variant_type = json_decode(collect($product->variations)->pluck("variant_id")->first());
                $variants = $this->variationRepository->all();
                $variant_values = $variants->pluck("values")->flatten()->toArray();
                return view('product::product.product_details', [
                    "product" => $product,
                    "variants" => $variants,
                    "variant_values" => $variant_values,
                    "product_variant_type" => $product_variant_type,
                    "range" => $request->range,
                ]);
            }else {
                $product = $this->productRepository->findCombo($request->id);
                return view('product::product.combo_product_details', [
                    "product" => $product
                ]);
            }

        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(["error" => $e->getMessage()], 503);
        }
    }

    public function product_sku_get_price(Request $request)
    {
        try {
            return $this->productRepository->getPrice($request->sku_id, $request->purchase_price, $request->selling_price);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(["error" => $e->getMessage()], 503);
        }
    }

    public function comboStatus(Request $request)
    {
        try{
            $language = $this->productRepository->findCombo($request->id);
            $language->status = $request->status;
            if($language->save()){
                return 1;
            }
            return 0;

        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return __('common.Operation failed');
        }

    }

    public function printLabels(Request $request)
    {
        $price = 0;
        $sku = $this->productRepository->findSku($request->id);
        if ($request->product_price)
        {
            if ($request->tax == 1)
                $price = $sku->selling_price + (($sku->price *20)/100);
            else
                $price = $sku->selling_price;
        }
        $data = [
            'sku' => $sku,
            'name' => $request->name,
            'variation' => $request->variation,
            'business' => $request->business_name,
            'price' => $price,
            'label' => $request->label,
            'page' => $request->page,
        ];

        return view('product::product.labels')->with($data);
    }

    public function pdfLabels()
    {
        $price = 0;
        $sku = $this->productRepository->findSku($request->id);
        if ($request->product_price)
        {
            if ($request->tax == 1)
                $price = $sku->selling_price + (($sku->price *20)/100);
            else
                $price = $sku->selling_price;
        }
        $data = [
            'sku'       => $sku,
            'name'      => $request->name,
            'variation' => $request->variation,
            'business'  => $request->business_name,
            'price'     => $price,
            'label'     => $request->label,
            'page'      => $request->page,
        ];
        $pdf = PDF::loadView('product::product.labels',compact('data'));
        $pdf->setPaper('a4')->setOrientation('landscape')->setOption('margin-bottom', 0);
        return $pdf->download('invoice.pdf');
    }

    public function add_opening_stock_create()
    {
        try{
            $products = $this->productRepository->all();
            $showrooms = $this->showRoomRepository->all();
            $wareHouses = $this->wareHouseRepository->all();
            $stockProducts = $this->stockTransferRepository->allStockProductShowroom();
            return view('product::product.add_opening_stock_create', [
                "products" => $products,
                "wareHouses" => $wareHouses,
                "showrooms" => $showrooms,
                "stockProducts" => $stockProducts,
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }


    public function productDetailForStock(Request $request)
    {
        try{
            $product = $this->productRepository->findSku($request->id);
            return view('product::product.stock_add_product_details', [
                "product" => $product
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function productDetailForPacking(Request $request)
    {
        try{
            $product = $this->productRepository->findSku($request->id);
            return $product;
        }catch(\Exception $e){
            return 0;
        }
    }

    public function selling_price_history($id)
    {
        $data['sell_histories'] = ProductSellingPriceHistory::with('purchase_order', 'productSku', 'user')->where('product_sku_id', $id)->latest()->get();
        return view('product::product.selling_price_history', $data);
    }

    public function csv_upload()
    {
        return view('product::product.upload_via_csv.create');
    }

    public function csv_upload_store(Request $request)
    {
        $validate_rules = [
            'file' => 'required|mimes:csv,xls,xlsx|max:2048'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        ini_set('max_execution_time', 0);
        DB::beginTransaction();
        try {
            $this->productRepository->csv_upload_single_product($request->except("_token"));
            DB::commit();
            Toastr::success(__('common.Successfully Uploaded !!!'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();
            if ($e->getCode() == 23000) {
                Toastr::error(__('common.Duplicate entry is exist in your file !!!'), __('common.Error'));
            }
            else {
                Toastr::error(__('common.Something went wrong. Upload again !!!'), __('common.Error'));
            }
            return back();
        }

    }
}
