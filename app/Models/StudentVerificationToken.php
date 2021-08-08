<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentVerificationToken extends Model
{
    use HasFactory;
    protected $table = 'student_verification_token';

    protected $fillable = [
        'user_id',
        'token',
    ];
}
