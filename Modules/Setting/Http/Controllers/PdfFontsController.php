<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Modules\UserActivityLog\Traits\LogActivity;
use Modules\Setting\Repositories\PdfFontRepository;

class PdfFontsController extends Controller
{
    protected $pdfFontRepository;

    public function __construct(PdfFontRepository $pdfFontRepository)
    {
        $this->pdfFontRepository = $pdfFontRepository;
    }

    public function index()
    {
        try {
            $data = [
                'fonts' => $this->pdfFontRepository->index()
            ];

            return view('setting::pdfFont.index', $data);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }

    }


    public function store(Request $request)
    {
        $request->validate([
            "name" => "required|unique:pdf_fonts,name",
            "font_file" => "required",
        ]);

        try {
            $this->pdfFontRepository->create($request->except("_token"));

            return response()->json([
                'success' => trans('pdf.PDF Pont Added Successfully'),
                'TableData' => $this->loadTableData(),
            ]);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => trans('common.Something Went Wrong'),
            ]);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            "name" => "required|unique:pdf_fonts,name," . $request->id,
            "font_file" => "required",
        ]);

        try {
            $this->pdfFontRepository->update($request->all());
            LogActivity::successLog(trans('pdf.Font Updated Successfully'));

            return response()->json([
                'success' => trans('pdf.Font Updated Successfully'),
                'TableData' => $this->loadTableData(),
            ]);

        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return response()->json([
                'error' => trans('common.Something Went Wrong'),
            ]);
        }
    }


    public function updateFontStatus(Request $request)
    {
        try {
            $this->pdfFontRepository->statusUpdate($request->except("_token"));
            LogActivity::successLog('Active Status has been updated.');
            return response()->json([
                'success' => trans('leave.Status has been updated Successfully'),
                'TableData' => $this->loadTableData(),
            ]);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());

            return response()->json([
                'error' => trans('common.Something Went Wrong')
            ]);
        }
    }

    private function loadTableData()
    {

        $data = [
            'fonts' => $this->pdfFontRepository->index()
        ];
        return (string)view('setting::pdfFont.components.list', $data);
    }


    public function destroy(Request $request)
    {
        try {
            $this->pdfFontRepository->delete($request->id);

            return response()->json([
                'success' => trans('pdf.PDF Font has been deleted Successfully'),
                'TableData' => $this->loadTableData(),
            ]);
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }
}
