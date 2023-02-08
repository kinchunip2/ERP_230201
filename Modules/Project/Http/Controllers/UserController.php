<?php


namespace Modules\Project\Http\Controllers;


use App\Http\Controllers\Controller;
use Modules\Project\Services\UserService;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service, $request;

    public function __construct(
        UserService $service,
        Request $request
    ){
        $this->service = $service;
        $this->request = $request;
    }

    public function removeTeam($team){
        $status = $this->service->removeTeam($team);
        Toastr::success(__('project::workspace.remove_successfully'), __('Success'));
        return redirect()->route('dashboard');
    }

    public function suggestUserByPriority(Request $request)
    {
        return $this->service->suggestUserByPriority($request);
    }
}
