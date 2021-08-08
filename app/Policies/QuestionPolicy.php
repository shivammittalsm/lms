<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function __construct()
    {
        //
    }

    public function viewAny(){
        return true;
    }

    public function view(){
        return true;

    }
    public function create(){
        return true;
    }

    public function update(User $user, Question $question)
    {
        return $user->id === $question->created_by;
    }

    public function delete(User $user, Question $question)
    {
        return $user->id === $question->created_by;
    }
}
