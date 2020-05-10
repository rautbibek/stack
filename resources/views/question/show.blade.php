@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-item-center">
                    <h3>Q. {{$question->title}} ?</h3>
                    <div class="ml-auto">
                      <a class="btn btn-outline-success btn-sm" href="{{route('question.index')}}">All Questions</a>
                    </div>
                  </div>
                  <hr>
                   <div class="media">
                      @include('shared._vote',[
                        'model' => $question,
                      ])
                     <div class="media-body">
                          {!! $question->html_body !!}
                        <div class="row mt-5">
                          <div class="col-4"></div>
                          <div class="col-4"></div>
                          <div class="col-4">
                            
                            <user-info :model="{{$question}}" label="Asked"></user-info>
                          </div>
                        </div>
                      </div>
                   </div>
                </div>
            </div>

            @include('answers._index',[
              'answers' => $question->answer,
              'answerCount' => $question->answers,
            ])
            @include('answers._create')
        </div>
    </div>
</div>
@endsection
