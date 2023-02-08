<?php

namespace Modules\Inventory\Http\Controllers;

use Artisan;
use App\User;
use App\Traits\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Modules\Inventory\Http\Requests\ShowRoomFormRequest;
use Modules\Inventory\Repositories\ShowRoomRepositoryInterface;

class ShowRoomController extends Controller
{
    use Notification;
    protected $showRoomRepository;

    public function __construct(ShowRoomRepositoryInterface $showRoomRepository)
    {
        $this->middleware(['auth', 'verified']);
        $this->showRoomRepository = $showRoomRepository;
    }

    public function index(Request $request)
    {
        try{
            $search_keyword = null;
            if ($request->input('search_keyword') != null) {
                $search_keyword = $request->input('search_keyword');
                $showrooms = $this->showRoomRepository->serachBased($search_keyword);
            }
            else {
                $showrooms = $this->showRoomRepository->all();
            }

            return view('inventory::showroom.index', [
                "showrooms" => $showrooms,
                "search_keyword" => $search_keyword
            ]);

        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function store(ShowRoomFormRequest $request)
    {
        try {
            $showroom = $this->showRoomRepository->create($request->except("_token"));
            $users=User::whereIn('role_id',[1,2])->where('id','!=',auth()->user()->id)
                        ->where('is_active','1')
                        ->get(['id','role_id']);
            
           
            $role_id = $request->for_whom;
            $subject = $showroom->name;
            $class = $showroom;
            $data =  __('notification.A Branch Has been Created');
            $url = "showroom.index";
            $this->sendNotification($class,null,$subject,null,null,$data,$users,$role_id,$url);

            \LogActivity::successLog('New Branch - ('.$request->name.') has been created.');
            Artisan::call('cache:clear');
            return response()->json(['message' =>__('inventory.Branch has been added Successfully')]);

        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Branch creation');
            return response()->json(['message' =>__('common.Something Went Wrong')]);
        }
    }

    public function show($id)
    {
        try {
            $showroom = $this->showRoomRepository->find($id);
            return view('inventory::showroom.show', [
                "showroom" => $showroom
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit(Request $request)
    {
        try {
            $showroom = $this->showRoomRepository->find($request->id);
            return view('inventory::showroom.edit', [
                "showroom" => $showroom
            ]);
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            return $e->getMessage();
        }
    }

    public function update(ShowRoomFormRequest $request, $id)
    {
        try {
            $showroom = $this->showRoomRepository->update($request->except("_token"), $id);
            \LogActivity::successLog($request->name.'- has been updated.');
            Toastr::success(__('inventory.Branch has been updated Successfully'));
            Artisan::call('cache:clear');
            return redirect()->route('showroom.index');
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Branch update');
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $showroom = $this->showRoomRepository->delete($id);
            \LogActivity::successLog('A Branch has been destroyed.');
            Toastr::success(__('inventory.Branch has been deleted Successfully'));
            Artisan::call('cache:clear');
            return back();
        } catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage().' - Error has been detected for Branch Destroy');
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }
    }

    public function changeShowroom(Request $request)
    {
        try{
            session()->put('showroom_id',$request->id);

            return response()->json(__('common.Success'));

        }catch (\Exception $e) {
            \LogActivity::errorLog($e->getMessage());
            Toastr::error(__('common.Something Went Wrong'), __('common.Error'));
            return back();
        }


    }
}
