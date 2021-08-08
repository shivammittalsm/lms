<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromView;


class ScoreExport implements FromView, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function calculateRecord()
    {
        $singleRecord = array();
        $marksObtained = null;
        $maxMarks = 0;
        $results = array();
        $records = User::query()
        ->where('invited_by',Auth::user()->id)
        ->with('courses','responses')
        ->get();

        //calculating student marks in % and Rank
        foreach($records as $record)
        {
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
        return $results;
    }
    
    public function view(): view
    {
        $results = $this->calculateRecord();
        return view('student-response.export', [
            'results' => $results,
        ]);
    }
}
