<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Product\Http\Requests\VariantFormRequest;
use Modules\Product\Repositories\VariantRepositoryInterface;
use function GuzzleHttp\Promise\all;
use Brian2694\Toastr\Facades\Toastr;

class VariantController extends Controller
{
    protected $variantRepository;

    public function __construct(VariantRepositoryInterface $variantRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->variantRepository = $variantRepository;
    }

    public function index()
    {
        try{
            $variants = $this->variantRepository->all();
            return view('product::variant.variant',[
                "variants" => $variants
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function create(Request $request)
    {
        try{
            $search_keyword = null;
            if ($request->input('search_keyword') != null) {
                $search_keyword = $request->input('search_keyword');
                $variants = $this->variantRepository->serachBased($search_keyword);
            }
            else {
                $variants = $this->variantRepository->all();
            }

            return view('product::variant.variant_list', [
                "variants" => $variants
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function store(VariantFormRequest $request)
    {
        try {
            $this->variantRepository->create($request->except("_token"));
            return response()->json(["message" => __('product.Variant Added Successfully')], 200);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(["message" => __('common.Something Went Wrong')], 503);
        }
    }

    public function show($id)
    {

        try{
            $variant = $this->variantRepository->find($id);

            $values = [];
            foreach ($variant->values as $key => $value) {
                array_push($values, $value->value);
            }

            return view('product::variant.show',[
                "variant" => $variant,
                'values' => $values
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        try {
            return $this->variantRepository->find($id);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function update(VariantFormRequest $request, $id)
    {
        try {
            $this->variantRepository->update($request->except("_token"), $id);
            return response()->json(["message" => __('product.Variant Updated Successfully')], 200);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(["message" => __('common.Something Went Wrong')], 503);
        }
    }

    public function destroy($id)
    {
        try {
            $delete = $this->variantRepository->delete($id);
            if ($delete){
                Toastr::success(__('product.Variant Deleted Successfully'));
            } else{
                Toastr::error(__('product.variation_value_used'));
            }
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }
}
