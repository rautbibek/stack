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
                      <a class="btn btn-outline-success btn-sm" href="{{route('question.index')}}">all questions</a>
                    </div>
                  </div>
                  <hr>
                   <div class="media">
                    <div class="d-flex flex-column vote-controls">
                      <a title="vote up" class="vote-up">
                        <i class="fas fa-caret-up fa-3x"></i>
                      </a>
                      <span class="votes-count">1230</span>
                      <a title="vote down thi question is not useful" class="vote-down off">
                        <i class="fas fa-caret-down fa-3x"></i>
                      </a>
                    
                      <a title="click again to make it favouit" class="fav-ans mt-5">
                        <i class="fas fa-star fa-2x"></i><br>
                      <span class="favorites-count" >{{$question->favorites->count()}}</span>
                      </a>
                      
                    </div>
                     <div class="media-body">
                          {!! $question->body !!}
                          <div class="float-right mt-5 mb-2">
                            <span class="text-muted">
                              Asked {{$question->created_at->diffForHumans()}}
                            </span>
                            
                            <div class="media mt-2">
                              <a href="{{$question->user->url}}" class="pr-2">
                                 <img src="{{$question->user->avatar}}" alt="image not found">
                              </a>
                              <div class="media-body mt-1">
                              <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                              </div>
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
