<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Models\Option;

class QuestionController extends Controller
{

    public function __construct()
    {
         $this->authorizeResource(Question::class);
    }

    public function index()
    {
        $questions = Question::query()
                                ->where('created_by', Auth::user()->getKey())
                                ->get();

        return view('question/show-question', compact('questions'));
    }

    public function create()
    {
        return view('question.add-question');
    }

    public function store(QuestionRequest $request)
    {

        $question = new Question();
        $option = new Option();

        $allOptions = [];

        $getOptions = $request->input('options');
        $getRightOptions = array_values($request->input('correctOptions'));

        $questionTitle=$request['question_title'];

        foreach($getOptions as $option => $value) {
            $isAnswer = false;
            if(in_array($option, $getRightOptions)) {
                $isAnswer = true;
            }

            array_push($allOptions, [
                'title' => $value,
                'answer' => $isAnswer,
            ]);
        }

        $question->title = $questionTitle;
        $question->created_by = Auth::user()->id;
        if($question->save()) {
            $questionId = $question->id;
            foreach($allOptions as $option) {
               if(!empty($option['title'])) {
                    Option::create([
                        'question_id' => $questionId,
                        'option' => $option['title'],
                        'answer' => $option['answer'],
                    ]);
               }
            }

            alert()->success('Question inserted successfully');
            return redirect('/questions');
        }
        else {
            alert()->success('Question insertion failed');
            return redirect('/questions');
        }

    }


    public function show($id)
    {
        //
    }

    public function edit(Question $question)
    {
        $options=Question::find($question->id)->options;

        return view('question.update-question', compact('question','options'));
    }

    public function update(QuestionRequest $request,Question $question)
    {
        $question = new Question();
        $option = new Option();

        $allOptions = [];

        $getOptions = $request->input('options');
        $getRightOptions = array_values($request->input('correctOptions'));

        $questionTitle=$request['question_title'];
        $questionId=$request['question_id'];

        foreach($getOptions as $option => $value) {
            $isAnswer = false;
            if(in_array($option, $getRightOptions)) {
                $isAnswer = true;
            }

            array_push($allOptions, [
                'title' => $value,
                'answer' => $isAnswer,
            ]);
        }

        $result=Question::find($questionId)->delete();
        if($result) {
            $question->title = $questionTitle;
            $question->created_by = Auth::user()->getKey();

            if($question->save()) {
                $questionId = $question->id;
                foreach($allOptions as $option) {
                   if(!empty($option['title'])) {
                        Option::create([
                            'question_id' => $questionId,
                            'option' => $option['title'],
                            'answer' => $option['answer'],
                        ]);
                   }
                }
            }
        }
        alert()->success('Question updated successfully');
        return redirect('/questions');
    }

    public function destroy(Question $question)
    {
        Question::find($question->id)->delete();
        
        alert()->danger('Question deleted successfully');
    }
}
