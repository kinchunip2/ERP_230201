<?php

namespace Modules\Attendance\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Attendance\Entities\Holiday;
use Modules\Attendance\Http\Requests\AttendanceFormRequest;
use Modules\Attendance\Repositories\AttendanceRepositoryInterface;
use Carbon\Carbon;
use DateTime;

class AttendanceController extends Controller
{
    protected $attaendanceRepository;

    public function __construct(AttendanceRepositoryInterface $attaendanceRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->attaendanceRepository = $attaendanceRepository;
    }

    public function index()
    {
        return view('attendance::attendances.index');
    }

    public function create()
    {
        return view('attendance::create');
    }

    public function store(AttendanceFormRequest $request)
    {
        try {
            $this->attaendanceRepository->create($request->except("_token"));

            \LogActivity::successLog('Attendance has been taken.');

            Toastr::success(__('attendance.Attendance has been taken'));
            return redirect()->route('attendances.index');
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for attendance creation');
            return back()->with('message-danger', __('common.Something Went Wrong'));
        }
    }

    public function get_user_by_role(Request $request)
    {
        try {
            $users = $this->attaendanceRepository->get_user_by_role($request->except('_token'));
            \LogActivity::successLog('Attendance has been updated.');
            return view('attendance::attendances.create_attendance',[
                'users' => $users,
                'date' => $request->date,
            ]);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Role update');
            return redirect()->back();
        }
    }
}
