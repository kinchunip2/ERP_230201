<?php

namespace Modules\Project\Http\View\Composers;

use Modules\Project\Services\WorkSpaceService;
use Modules\Project\Services\UserService;
use Illuminate\View\View;

class AppComposer
{
    /**
     * The user repository implementation.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $workspace;
    protected $user;

    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct(WorkSpaceService $workspace, UserService $user)
    {
        $this->workspace = $workspace;
        $this->user = $user;
    }

    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('global_workspaces', $this->workspace->getUserWorkspace());
        $view->with('global_teams', $this->workspace->currentWorkspaceTeams());
        $view->with('user_favourite', $this->user->currentUserFavouriteProject());
    }
}
