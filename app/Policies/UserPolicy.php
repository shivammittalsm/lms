<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        $role=Auth::user()->roles->pluck('role')->toArray();

        if($role[0] == "Teacher")
        {
            return true;
        }
        return false;
    }

    public function view(User $user)
    {
        $role=Auth::user()->roles->pluck('role')->toArray();

        if($role[0] == "Teacher")
        {
            return true;
        }
        return false;
    }

    public function create(User $user)
    {
        $role=Auth::user()->roles->pluck('role')->toArray();

        if($role[0] == "Teacher")
        {
            return true;
        }
        return false;
    }

    public function update(User $user, User $model)
    {
        //
    }

    public function delete(User $user,User $student)
    {
        $role=Auth::user()->roles->pluck('role')->toArray();
        
        if($role[0] === "Teacher" and $student['invited_by'] === $user['id'])
        {
            return true;
        }
        return false;
    }


}
