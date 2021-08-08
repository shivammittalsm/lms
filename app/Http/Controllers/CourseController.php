<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseQuestion;
use App\Models\Question;

class CourseController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Course::class);
    }

    public function index()
    {
        $courses_list = Course::query()
                                ->where('created_by', Auth::user()->getKey())
                                ->get();

        return view('course/show-courses', compact('courses_list'));
    }

    public function create()
    {
        $questions = Question::query()
                                ->where('created_by', Auth::user()->getKey())
                                ->get();

        return view('course/add-course', compact('questions'));
    }

    public function store(CourseRequest $request)
    {
        $course = new Course();
        $courseTitle = $request->input('course_title');
        $questionIds = array_values($request->input('question_ids'));

        $course->course_name = $courseTitle;
        $course->created_by = Auth::user()->getKey();

        if ($course->save()) {
            $courseId = $course->id;
            // $course->questions->attach(['questions_id' => $questionIds]);
            foreach ($questionIds as $questionId) {
                $Course_Question = CourseQuestion::create([
                    'course_id' => $courseId,
                    'question_id' => $questionId,
                ]);
            }

            return redirect('courses')->with('addCourseSuccess', 'Course inserted successfully');
        } 
        else {
            return redirect('courses')->with('addCourseFail', 'Course insertion failed');
        }
    }

    public function show(Course $course)
    {
        $courseDetails = $course->loadMissing('questions', 'questions.options');

        return view('course.course-detail', compact('courseDetails'));
    }

    public function edit(Course $course)
    {
        $courseQuestion = Course::find($course->id)->questions;         //fetching questions based on course id
        $questions = Question::query()
                                ->where('created_by', Auth::user()->getKey())
                                ->get(); 

        return view('course.update-course', compact('course', 'courseQuestion', 'questions'));
    }

    public function update(Request $request,Course $course)
    {
        $courseId = $request->input('course_id');
        $courseTitle = $request->input('course_title');
        $courseQuestions = array_values($request->input('question_ids'));

        CourseQuestion::query()
                        ->where('course_id', $courseId)
                        ->delete();

        Course::query()
                ->where('id', $courseId)
                ->update(['course_name' => $courseTitle]);

        foreach ($courseQuestions as $questionId) {
            CourseQuestion::create([
                'course_id' => $courseId,
                'question_id' => $questionId,
            ]);
        }

        return redirect('courses')->with('courseUpdated', 'courses updated successfully');
    }

    public function destroy(Course $course)
    {
        $result = Course::find($course->id)->delete();
        
        if ($result) {
            return redirect('courses')->with('courseDeletionSuccess', 'Course deleted successfully');
        } 
        else {
            return redirect('courses')->with('courseDeletionFail', 'Course deletion failed');
        }
    }
}
