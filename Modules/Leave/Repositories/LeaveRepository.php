<?php

namespace Modules\Leave\Repositories;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Modules\Leave\Entities\ApplyLeave;
use Modules\Leave\Entities\LeaveDefine;
use App\Traits\ImageStore;
use Illuminate\Support\Arr;
use Carbon\Carbon;
use App\User;
use Twilio\TwiML\Voice\Leave;

class LeaveRepository
{
    use ImageStore;

    public function all()
    {
        if (auth()->user()->role->type == 'regular_user') {
            return ApplyLeave::with('leave_type')->where('user_id', auth()->user()->id)->latest()->get();
        }
        else {
            return ApplyLeave::with('leave_type')->latest()->get();
        }
    }

    public function create(array $data)
    {
        $to = Carbon::parse($data['start_date']);
        $from = $data['day'] == 2 ? Carbon::parse($data['end_date']) : '';
        $total_days = $data['day'] == 2 ? $to->diffInDays($from)+1 : ($data['day'] == 1 ?  1 : 0.5);
        $data['apply_date'] = Carbon::parse($data['apply_date'])->format('Y-m-d');
        $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
        $data['end_date'] = $data['day'] == 2 ?  Carbon::parse($data['end_date'])->format('Y-m-d') : '';
        $data['user_id'] = $data['user'];

        $data['leave_from'] = array_key_exists('half',$data) || ($data['from_day'] ?? 0);
        $data['leave_to'] = array_key_exists('half_to',$data) ? $data['to_day'] : 0;

        // if ($data['leave_to'] == $data['leave_from'])
        //     $data['total_days'] = $total_days;
        // elseif(array_key_exists('half',$data) && array_key_exists('half_to',$data))
        //     $data['total_days'] = $total_days - 0.5;

        // if (!array_key_exists('makeup_leave',$data))
        // {
        //     $data['makeup_date'] = null;
        //     $data['makeup_leave'] = 0;
        // }
        // else{
        //     $data['makeup_date'] = Carbon::parse($data['makeup_date'])->format('Y-m-d');
        // }

        $data['total_days'] = $total_days;

        if ($data['day'] == 2 && array_key_exists('from_day', $data) && array_key_exists('to_day', $data))
        {
            if ($data['to_day'] == 'half') {
                $data['total_days'] = $data['from_day'] == 2 ? $total_days - 0.5 : $total_days;
            }
            else {
                if ($data['from_day'] < $data['to_day']) {
                    $data['total_days'] = $total_days - 0.5;
                }
                else
                    $data['total_days'] = $total_days + 0.5;
            }
        }

        if (!array_key_exists('makeup_leave', $data)) {
            $data['makeup_date'] = null;
            $data['makeup_leave'] = 0;
        }


        $apply_leave = new ApplyLeave();
        if (isset($data['file'])) {
            $data = Arr::add($data, 'attachment', $this->saveFile($data['file']));
        }
        $data['created_by'] = Auth::id();
        $apply_leave->fill($data)->save();
        return $apply_leave;
    }

    public function find($id)
    {
        return ApplyLeave::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $to = Carbon::parse($data['start_date']);
        $from = $data['day'] == 2 ? Carbon::parse($data['end_date']) : '';
        $total_days = $data['day'] == 2 ? $to->diffInDays($from)+1 : ($data['day'] == 1 ?  1 : 0.5);

        $data['apply_date'] = Carbon::parse($data['apply_date'])->format('Y-m-d');
        $data['start_date'] = Carbon::parse($data['start_date'])->format('Y-m-d');
        $data['end_date'] = $data['day'] == 2 ?  Carbon::parse($data['end_date'])->format('Y-m-d') : '';
        $data['user_id'] = Auth::id();

        $data['leave_from'] = array_key_exists('half',$data) || ($data['from_day'] ?? 0);
        $data['leave_to'] = array_key_exists('half_to',$data) ? $data['to_day'] : 0;

        if ($data['leave_to'] == $data['leave_from'])
            $data['total_days'] = $total_days;
        elseif(array_key_exists('half',$data) && array_key_exists('half_to',$data))
            $data['total_days'] = $total_days - 0.5;

        if (!array_key_exists('makeup_leave',$data))
        {
            $data['makeup_date'] = null;
            $data['makeup_leave'] = 0;
        }

        $apply_leave = ApplyLeave::findOrFail($id);
        if (isset($data['file'])) {
            if (File::exists($apply_leave->attachment)) {
                File::delete($apply_leave->attachment);
            }
            $data = Arr::add($data, 'attachment', $this->saveFile($data['file']));
        }
        $data['updated_by'] = Auth::id();

        $apply_leave->update($data);
        return $apply_leave;
    }

    public function delete($id)
    {
        return ApplyLeave::destroy($id);
    }

    public function approved_all()
    {
        return ApplyLeave::with('leave_type')->where('status', 1)->latest()->get();
    }

    public function pending_all()
    {
        return ApplyLeave::with('leave_type')->where('status', 0)->latest()->get();
    }

    // public function user_leave_history($id)
    // {
    //     return ApplyLeave::where('user_id', $id)->latest()->get();
    // }

    public function user_leave_history($id,$year = null)
    {
        if ($year == null) {
            $year = date('Y');
        }
        return ApplyLeave::with('leave_type')->where('user_id', $id)->whereYear('apply_date',$year)->latest()->get();
    }

    public function total_leave($id)
    {
        $user = User::find($id);
        return LeaveDefine::where('role_id', $user->role_id)->latest()->get();
    }

    public function change_approval(array $data)
    {
        $apply_leave = ApplyLeave::findOrFail($data['id']);
        $apply_leave->status = $data['status'];
        $apply_leave->approved_by = auth()->id();
        $apply_leave->save();

        return $apply_leave;
    }

    public function generate()
    {
        $repo = new UserRepository();
        $users = $repo->user()->whereNotIn('id',[1,2]);
        foreach ($users as $user)
        {
            if ($user->staff != null) {
                $user->staff->update([
                    'carry_forward' => $user->CarryForward,
                ]);
            }
        }

        return $users;
    }

    public function updateCarryForward($data)
    {
        $repo = new UserRepository();
        $staff = $repo->find($data['id']);
        $staff->carry_forward = $data['status'] == 1 ? $data['day'] : 0;
        $staff->is_carry_active = $data['status'] ;
        $staff->save();
        return $staff;
    }

    // public function totalLeave($user)
    // {
    //     // $user = User::find($id);
    //     $now = date('Y');
    //     $leaves = LeaveDefine::where('user_id', $user->id)->where('year',$now)->latest()->get();
    //     $leaves_types = $leaves->pluck('leave_type_id')->toArray();
    //     $user_leave = LeaveDefine::where('user_id', $user->id)->where('year',null)->whereNotIn('leave_type_id',$leaves_types)->latest()->get();
    //     $user_leaves_types = $user_leave->pluck('leave_type_id')->toArray();
    //     $role_leave =  LeaveDefine::where('role_id', $user->role_id)->where('user_id',0)
    //         ->whereNotIn('leave_type_id',$leaves_types)->whereNotIn('leave_type_id',$user_leaves_types)->sum('total_days');
    //     $total_user_leave = count($leaves) > 0 ? $leaves->sum('total_days') + $role_leave : $user_leave->sum('total_days') + $role_leave;

    //     return $total_user_leave;
    // }

    public function totalLeave($staffDetails)
    {
        $now = date('Y');
        $leaves = LeaveDefine::where('user_id', $staffDetails->id)->where('year', $now)->latest()->get();
        $leaves_types = $leaves->pluck('leave_type_id')->toArray();
        $user_leave = LeaveDefine::where('user_id', $staffDetails->id)->where('year', null)->whereNotIn('leave_type_id', $leaves_types)->latest()->get();
        $user_leaves_types = $user_leave->pluck('leave_type_id')->toArray();
        $role_leave = LeaveDefine::where('role_id', $staffDetails->role_id)->where(function ($q){
            $q->where('user_id', 0)->orWhere('user_id', null);
        })->whereNotIn('leave_type_id', $leaves_types)->whereNotIn('leave_type_id', $user_leaves_types)->sum('total_days');

        return count($leaves) > 0 ? $leaves->sum('total_days') + $role_leave : $user_leave->sum('total_days') + $role_leave;
    }

    public function monthlyLeave($id, $payroll_month, $payroll_year)
    {
        return ApplyLeave::whereMonth('start_date',$payroll_month)->whereYear('start_date',$payroll_year)->where('user_id',$id)
            ->where('makeup_leave',0)->where('status',1)->get();
    }
}
