<?php

namespace App\Http\Controllers;
use App\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{

    public function __construct(){
        return $this->middleware('auth');
    }

    public function store(Question $question){
       $question->favorites()->attach(Auth::id());
        if(request()->expectsJson()){
            return response()->json([
                "message" => 'Succefully added to favorite list',
            ]);
        }
    }

    public function destroy(question $question){
       $question->favorites()->detach(Auth::id());
        if(request()->expectsJson()){
            return response()->json([
                "message" => 'Removed form favourite list',
            ]);
        }
    }
}
