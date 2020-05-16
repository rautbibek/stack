<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Http\Request;

class VoteQuestionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function __invoke(Question $question){
        $vote = request()->vote;
        auth()->user()->voteQuestion($question,$vote);
        if(request()->expectsJson()){
            return response()->json([
                'message' => 'thank you for your feedback',
            ]);
        }
        return back(); 
    }
}
