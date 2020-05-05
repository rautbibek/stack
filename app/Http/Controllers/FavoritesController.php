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
       return back();
    }

    public function destroy(question $question){
       $question->favorites()->detach(Auth::id());
       return back();
    }
}
