<?php

namespace App\Http\Controllers;

use App\Models\Response;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        $singleRecord = array();
        $marksObtained = null;
        $maxMarks = 0;
        $results = array();
        $role=Auth::user()->roles->pluck('role')->toArray();

        if($role[0] === "Student") {
            return view('student.home');
        }

        $records = User::query()
                        ->where('invited_by',Auth::user()->getKey())
                        ->with('courses','responses')
                        ->get();

        //calculating student marks in % and Rank
        foreach($records as $record) {
            $singleRecord['attempt']=count($record->responses);
            if($singleRecord['attempt'] > 0) {
                $singleRecord['name']=$record->name;
                $singleRecord['email']=$record->email;

                foreach($record->courses as $course)
                {
                    $singleRecord['course']=$course->course_name;
                }

                foreach ($record->responses as $key => $response)
                {
                    $marksObtained  +=  $response->total_score;
                    $maxMarks += $response->max_marks;
                }
                
                $singleRecord['percentage']=($marksObtained * 100)/$maxMarks;
                $marksObtained = $maxMarks = null;
                array_push($results, $singleRecord);
                $singleRecord = array();
            }
        }
        $results=collect($results)->sortBy('percentage')->reverse()->toArray();
        $results = array_values($results);
        return view('home',compact('results'));
    }
}
