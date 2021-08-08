<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseDetail extends Model
{
    protected $table = "response_details";
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'question',
        'option',
        'checked',
        'true_answer',
    ];


}
