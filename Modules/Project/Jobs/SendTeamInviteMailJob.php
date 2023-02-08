<?php

namespace Modules\Project\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Project\Emails\TeamInviteMail;
use Mail;
use Auth;

class SendTeamInviteMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user, $team, $authUser;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $team, $authUser)
    {
        $this->user = $user;
        $this->team = $team;
        $this->authUser = $authUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->user->email)->send(new TeamInviteMail($this->user, $this->team, $this->authUser));
    }
}
