<?php

namespace App\Http\Controllers;

use App\Exports\ScoreExport;
use App\Http\Requests\StudentRequest;
use App\Models\Course;
use App\Models\User;
use Illuminate\support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\UserDetail;
use App\Notifications\StudentInvite;
use Illuminate\Support\Facades\Notification;
use App\Models\StudentVerificationToken;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    public function index()
    {
        $students = User::query()
                        ->where('invited_by', Auth::user()->getKey())
                        ->withCount('courses as counter')
                        ->with('courses')
                        ->get();

        return view('student/show-student', compact('students'));
    }

    public function create()
    {
        $courses = Course::get();
        return view('student.add-student', compact('courses'));
    }

    public function store(StudentRequest $request)
    {
        $password = bcrypt(Str::random(15));
        $token = bcrypt($password);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => $password,
            'invited_by' => Auth::user()->getKey(),
        ]);
        $userId = $user->getKey();

        UserDetail::create([
            'user_id' => $userId,
            'phone' => $request['phone'],
        ]);

        $user->roles()->attach(['role_id' => 1]);  //adding record to user_role pivot
        $user->courses()->attach(['course_id' => $request['courseId']]);
        
        StudentVerificationToken::create([
            'user_id' => $userId,
            'token' => $token,
        ]);

        Notification::send($user, new StudentInvite($password, $token));

        return redirect('students')->with('success', 'Student added successfully');
    }

    public function show(User $user)
    {
        $responses = [
            'user' => $user,
            'course' => $user->courses,
            'responses' => $user->responses,
        ];

        //chart section
        $chartDetails = [['Date', $responses['user']->name]];
        foreach ($responses['responses'] as $key => $response) {
            array_push($chartDetails, [$response->created_at, $response->total_score]);
        }
        
        $chartDetails = json_encode($chartDetails);

        return view('result.result', compact('responses', 'chartDetails'));
    }

    public function destroy(User $user)
    {
        $result = User::where('id', $user['id'])->delete();
        if ($result) {
            return redirect('students')->with('studentDeleteSuccess', 'Student deleted successfully');
        }
        return redirect('/students')->with('studentDeleteFail', 'Student deletion failed');
    }

    public function export()
    {
        return Excel::download(new ScoreExport, 'reportcard.xlsx');
    }
}
