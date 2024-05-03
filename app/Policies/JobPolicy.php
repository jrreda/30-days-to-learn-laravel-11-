<?php

namespace App\Policies;

use App\Models\Job;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class JobPolicy
{

    /**
     * authentication method #6 (for large scale applications)
     * Determine whether the user can view the job.
     */
    public function edit(User $user, Job $job): bool
    {
        return $job->employer->user->is($user);
    }
}
