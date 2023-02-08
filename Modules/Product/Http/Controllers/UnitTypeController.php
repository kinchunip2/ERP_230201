<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\Http\Requests\UnitTypeFormRequest;
use Modules\Product\Repositories\UnitTypeRepositoryInterface;
use Brian2694\Toastr\Facades\Toastr;
class UnitTypeController extends Controller
{
    protected $unitTypeRepository;

    public function __construct(UnitTypeRepositoryInterface $unitTypeRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->unitTypeRepository = $unitTypeRepository;
    }

    public function index()
    {
        $unit_types = $this->unitTypeRepository->all();
        return view('product::unit_type.unit_type', compact('unit_types'));
    }

    public function getALl()
    {
        return $this->unitTypeRepository->all();
    }

    public function create(Request $request)
    {
        try{
            $search_keyword = null;
            if ($request->input('search_keyword') != null) {
                $search_keyword = $request->input('search_keyword');
                $unit_types = $this->unitTypeRepository->serachBased($search_keyword);
            }
            else {
                $unit_types = $this->unitTypeRepository->all();
            }

            return view('product::unit_type.unit_type_list', [
                "unit_types" => $unit_types
            ]);
        }catch(\Exception $e){
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return redirect()->back();
        }
    }

    public function store(UnitTypeFormRequest $request)
    {
        try {
            $this->unitTypeRepository->create($request->except("_token"));
            return response()->json(["message" => __('product.Unit Type Added Successfully')], 200);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(["message" => __('common.Something Went Wrong')], 503);
        }
    }


    public function edit($id)
    {
        try {
            return $this->unitTypeRepository->find($id);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function update(UnitTypeFormRequest $request, $id)
    {
        try {
            $this->unitTypeRepository->update($request->except("_token"), $id);
            return response()->json(["message" => __('product.Unit Type Updated Successfully')], 200);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return response()->json(["message" => __('common.Something Went Wrong')], 503);
        }
    }

    public function destroy($id)
    {
        try {
            $this->unitTypeRepository->delete($id);
            Toastr::success(__('product.Unit Type Deleted Successfully'));
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }
    public function csv_upload()
    {
        return view('product::unit_type.upload_via_csv.create');
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
            $this->unitTypeRepository->csv_upload_unit($request->except("_token"));
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
    public function csv_download()
    {
        try {
            return $this->unitTypeRepository->csv_download();
        } catch (\Exception $e) {
            return response()->json(["message" => __('common.Something Went Wrong')], 503);
        }
    }
}
