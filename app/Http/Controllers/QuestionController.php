<?php
namespace App\Http\Controllers;
use App\Http\Requests\AskQuestionRequest;
use App\Question;
use Illuminate\Http\Request;
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware('auth',['except' =>['index','show']]);
    }

    public function index()
    {
        $questions = Question::latest()->with('user')->paginate(10);
        return view('question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AskQuestionRequest $request)
    {
        $request->user()->question()->create($request->only('title','body'));
        return redirect()->route('question.index')->with('success','your question has been submitted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('question.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
          $this->authorize('update', $question);
          return view('question.edit',compact('question'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(AskQuestionRequest $request, Question $question)
    {

        $question->update($request->only('title','body'));
        return redirect()->route('question.index')->with('success','Question updated succefully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $this->authorize('delete', $question);
        $question->delete();
        return redirect()->route('question.index')->with('success','Question deleted succefully');

    }

}
