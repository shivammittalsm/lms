<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Http\Requests\ResponseRequest;
use App\Models\Response;
use App\Models\ResponseDetail;

class StudentResponseController extends Controller
{
    public function index()
    {
        foreach (Auth::user()->courses as $course) {
            return view('student-response.home', compact('course'));
        }
    }

    public function create()
    {
        //
    }

    public function store(ResponseRequest $request)
    {
        $questions = $request->input('question_title');
        $getSelectedOptions = $request->input('correctOptions');

        $score = 0;
        $totalQuestions = 0;

        $response = Response::create([
            'user_id' => Auth::user()->id,
            'total_score' => $score,
            'max_marks' => $totalQuestions,
        ]);

        $exam_id = $response->id;

        foreach ($questions as $question) {
            $options = Question::find($question)->options;

            foreach ($options as $option) {
                $answer = $getSelectedOptions[$question];
                $correctAnswer = 0;
                if ($option['answer'] == 1) {
                    $this->$correctAnswer = 1;
                    if ($option['id'] == $answer[0]) {
                        $score++;
                    }
                }

                ResponseDetail::create([
                    'exam_id' => $exam_id,
                    'question' => $question,
                    'option' => $option['id'],
                    'checked' => $answer[0],
                    'true_answer' => $correctAnswer,
                ]);
            }

            $totalQuestions++;
        }

        $response = Response::find($exam_id);
        $response->total_score = $score;
        $response->max_marks = $totalQuestions;
        $response->save();

        return view('student-response.result',compact('totalQuestions','score'));
    }

    public function show(Course $course)
    {
        $courses = $course->loadMissing('questions', 'questions.options');
        return view('student-response.test', compact('courses'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function showResult()
    {
        $responses=Response::query()
        ->where('user_id',Auth::user()->getKey())
        ->get();

        $course=Auth::user()->courses->pluck('course_name')->toArray();
        
        return view('student.result',compact('responses','course'));
    }
}
