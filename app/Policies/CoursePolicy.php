<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Course;

class CoursePolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny()
    {
        return true;
    }

    public function view()
    {
        return true;
    }

    public function create()
    {
        return true;
    }

    public function update(User $user, Course $course)
    {
        return $user->id === $course->created_by;
    }

    public function delete(User $user, Course $course)
    {
        return $user->id === $course->created_by;
    }
}
