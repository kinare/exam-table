<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
    {
        $question = new Question();
        $question->fill($request->all());
        $question->save();

        foreach ($request->options as $option){
            $item = new Option();
            $item->description = $option;
            $item->question_id = $question->id;
            $item->save();
        }

        return response()->json($question);
    }


    public function update(Request $request, $question_id)
    {
        $question = Question::find($question_id);
        $question->fill($request->all());
        $question->save();

        foreach ($request->options as $option){
            $item = Option::updateOrCreate(
                ['id' => $option['id'], 'question_id'=> $option['question_id']],
                $option
            );
            $item->save();
        }

        return response()->json($question);
    }

    public function destroy($question_id)
    {
        $question = Question::find($question_id);
        $question->options->each(function ($option){
            $option->delete();
        });

        $question->delete();

        return response()->json(['message' => "Deleted"], 202);
    }
}
