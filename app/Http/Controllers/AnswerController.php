<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{

    public function __construct(){
        $this->middleware('auth')->except('index');
    }
    public function index(Question $question){
        return $question->answer()->with('user')->simplePaginate(3);

    }

    public function store(Question $question,Request $request)
    {
        $this->validate($request,[
            'body' => 'required',
        ]);
        $question->answer()->create([
            'body' => $request->body,
            'user_id'=> \Auth::id(),
            ]
        );
        return back()->with('success',' your answer submitted succefully ');
    }


    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers.edit',compact('question','answer'));
    }

    public function update(Request $request, Question $question, Answer $answer)
    {
        $this->authorize('update',$answer);
        $this->validate($request,[
            'body' => 'required',
        ]);
        $answer->update([
            'body' => $request->body,
            ]
        );
        if($request->expectsJson()){
            return response()->json([
                'message' => 'Your answer has been updated successfully !',
                'body_html' =>$answer->body_html
            ]);
        }
        return redirect()->route('question.show',$question->slug)->with('success',' your answer updated succefully ');
    }

    public function destroy(Question $question , Answer $answer)
    {
        $this->authorize('delete', $answer);
        $answer->delete();
        if(request()->expectsJson()){
            return response()->json([
                "message" => 'Your answer deleted succefuly',
            ]);
        }
        return back()->with('success','answer deleted succefully !!');
    }
}
