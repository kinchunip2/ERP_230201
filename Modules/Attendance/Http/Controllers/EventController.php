<?php

namespace Modules\Attendance\Http\Controllers;

use App\User;
use App\Traits\ImageStore;
use Illuminate\Support\Arr;
use App\Traits\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Attendance\Entities\Event;
use Illuminate\Contracts\Support\Renderable;
use Modules\Attendance\Repositories\EventRepositoryInterface;
use Modules\RolePermission\Repositories\RoleRepositoryInterface;

class EventController extends Controller
{
    use ImageStore,Notification;

    protected $eventRepository,$roleRepository;

    public function __construct(EventRepositoryInterface $eventRepository,RoleRepositoryInterface $roleRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index()
    {
        try {
            $events = $this->eventRepository->all();
            $roles = $this->roleRepository->normalRoles();
            return view('attendance::events.index', compact('events','roles'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }

    public function create()
    {
        abort(404);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'from_date' => 'required',
        ]);
        try {
            if (!empty($request->image)) {
                 $this->saveAvatar($request->image);
            }
            $event = $this->eventRepository->create($request->except('_token'));
         
            $users=User::whereIn('role_id',[1,2])->where('id','!=',auth()->user()->id)
            ->where('is_active','1')
            ->get(['id','role_id']);

            $subject = $request->title;
            $class = $event;
            $data = $request->description ?? 'A Event Has been Created';
            $url = route('events.index');
            $this->sendNotification($class,null,$subject,null,null,$data,$users,$role_id=null,$url);
            Toastr::success(trans('event.Event Has Been Created Successfully'));
            return back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }

    public function show($id)
    {
        return view('attendance::show');
    }

    public function edit($id)
    {
        try {
            $events = $this->eventRepository->all();
            $editData = $this->eventRepository->find($id);
            $roles = $this->roleRepository->normalRoles();
            return view('attendance::events.index', compact('events','editData','roles'));
        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $validate_rules = [
            'title' => 'required',
            'from_date' => 'required',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));
        try {
            $event = $this->eventRepository->update($request->except('_token'),$id);

            Toastr::success(trans('event.Event Has Been Updated Successfully'));
            return redirect()->route('events.index');
        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->eventRepository->delete($id);
            Toastr::success(trans('event.Event Has Been Deleted Successfully'));
            return back();
        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }
}
