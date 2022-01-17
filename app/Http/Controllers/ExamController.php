<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function index()
    {
        $exams = Exam::with([
            'questions' => function($query){
                $query->with('options');
            }
        ])->get();

        return response()->json($exams);
    }



    public function store(Request $request)
    {
        $exam = new Exam();
        $exam->fill($request->all());
        $exam->save();

        return response()->json($exam);
    }


    public function show($exam_id)
    {
        $exam = Exam::with([
            'questions' => function($query){
                $query->with('options');
            }
        ])->find($exam_id);

        return response()->json($exam);
    }

    public function submit(Request $request, $exam_id)
    {
        $exam = Exam::find($exam_id);
        foreach ($request->questions as $question){
            $quiz = Question::find( $question['id']);
            $quiz->fill($question);
            $quiz->save();
        }

        return response()->json($exam);
    }

    public function destroy($exam_id)
    {
        $exam = Exam::find($exam_id);

        $exam->questions->each( function ($question){
            $question->options->each(function ($option){
                $option->delete();
            });
            $question->delete();
        });

        $exam->delete();

        return response()->json(['message' => "Deleted"], 202);

    }
}
