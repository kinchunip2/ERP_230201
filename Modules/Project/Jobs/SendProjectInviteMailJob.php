<?php

namespace Modules\Project\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Project\Emails\ProjectInviteMail;
use Mail;
use Auth;
class SendProjectInviteMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

     protected $user, $project, $authUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user, $project, $authUser)
    {
        $this->user = $user;
        $this->project = $project;
        $this->authUser = $authUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
         Mail::to($this->user->email)->send(new ProjectInviteMail($this->user, $this->project,$this->authUser));
    }
}
