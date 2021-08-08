<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Question;

class Course extends Model
{
    use HasFactory;

    public function questions()
    {
        return $this->belongsToMany(Question::class,'course_question');
    }
}
