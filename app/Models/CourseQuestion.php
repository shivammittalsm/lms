<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseQuestion extends Model
{
    protected $table = 'course_question';
    use HasFactory;


    protected $fillable = [
        'course_id',
        'question_id',
    ];
}
