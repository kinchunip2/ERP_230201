<?php

namespace Modules\Setup\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Setup\Repositories\DepartmentRepositoryInterface;
use Brian2694\Toastr\Facades\Toastr;

class DepartmenController extends Controller
{
    protected $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->departmentRepository = $departmentRepository;
    }

    public function index()
    {
        try{
            $data['DepartmentList'] = $this->departmentRepository->all();
            return view('setup::department.index',$data);
        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function store(Request $request)
    {
        $validate_rules = [
            'name' => ['required', 'string', 'unique:departments','max:255'],
            'details' => 'nullable|string',
            'status' => 'required'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try{
           $createdItem = $this->departmentRepository->create([
                'name'      => $request->name,
                'status'    => $request->status,
                'details'   => $request->details
            ]);
            \LogActivity::successLog($request->name.' - Department created');

           return  $this->loadTableData();
        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function update(Request $request)
    {
        $validate_rules = [
            'name' => ['required', 'string', 'max:255', 'unique:departments,name,'.$request->id ],
            'details' => 'nullable|string|max:1024'
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        try{
            $createdItem = $this->departmentRepository->update([
                'name' => $request->name,
                'status' => $request->status,
                'details' => $request->details
            ],$request->id);
            \LogActivity::successLog($request->name.' - Department Updated');
            return  $this->loadTableData();
        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function delete(Request $request)
    {
        $validate_rules = [
            'id'       => 'required',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try{
            $this->departmentRepository->delete($request['id']);
            return  $this->loadTableData();
        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    private function loadTableData($action = 'create')
    {
        try{
            $DepartmentList = $this->departmentRepository->all();
            $message = __('department.Department has been created successfully!');
            if ($action == 'update'){
                $message = __('department.Department has been updated successfully!');
            } else if($action == 'update'){
                $message = __('department.Department has been deleted successfully!');
            }
            return response()->json([
                'message' => $message,
                'TableData' =>  (string)view('setup::department.components.list',compact('DepartmentList') )
            ]);
        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }
}
