<?php

namespace App\Http\Controllers;

use App\Models\StudentVerificationToken;
use App\Models\User;
use Carbon\Carbon;

class StudentVerificationController extends Controller
{
    public function studentVerification($token)
    {
        $student = StudentVerificationToken::query()
                                            ->where('token', $token)
                                            ->first();

        if ($student) {
            $tokenCreationTime = $student['created_at'];
            $currentTime = Carbon::now()->toDateTimeString();
            $diffInMinute = $tokenCreationTime->diffInMinutes($currentTime);
            $recordId = $student['id'];

            if ($diffInMinute <= 1440) {
                $userId = $student['user_id'];

                /*
                *   updating email verified time
                */
                $user = User::find($userId);
                $user->email_verified_at = date('Y-m-d H:i:s');
                $user->save();

                /*
                *   deleting record from token table
                */
                $token = StudentVerificationToken::find($recordId);
                $token->delete();
                return redirect('/login');
            } else {
                //deleting expired token

                echo "Token expired \n Please request for another token";
                $token = StudentVerificationToken::find($recordId);
                $token->delete();
                return redirect('/login');
            }
        } else {
            echo "Invalid link";
        }
    }
}
