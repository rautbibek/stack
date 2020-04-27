@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex align-item-center">
                    <h2>All Questions</h2>
                    <div class="ml-auto">
                      <a class="btn btn-outline-success btn-sm" href="{{route('question.create')}}">Ask Queston</a>
                    </div>
                  </div>

                </div>

                <div class="card-body">

                    @include('layouts._messages')
                    @foreach($questions as $question)
                        <div class="media">
                          <div class="d-flex flex-column countersr">
                            <div class="vote">
                              <strong>{{$question->votes}}</strong> {{str_plural('vote',$question->votes)}}
                            </div>

                            <div class="status {{$question->status}}">
                              <strong>{{$question->answers}}</strong> {{str_plural('answer',$question->answers)}}
                            </div>

                            <div class="view">
                              <strong>{{$question->views}}</strong> {{str_plural('view',$question->views)}}
                            </div>

                          </div>
                          <div class="media-body">
                            <div class="d-flex align-item-center">
                              <h3 class="mt-0">
                                <a href="{{$question->url}}">
                                  {{$question->title}}
                                </a>
                              </h3>
                              <div class="ml-auto">
                                <a class="btn btn-outline-success btn-sm" href="{{route('question.edit',$question->id)}}">Edit</a>
                                <form class="d-inline" action="{{route('question.destroy',$question->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-outline-danger btn-sm" type="submit" onclick="return confirm('are you sure ??)">delete</button>

                                </form>
                              </div>
                            </div>

                            <p class="lead">
                              Asked By
                              <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                              <small class="text-muted">{{$question->created_date}}</small>
                            </p>
                            {{str_limit($question->body,250)}}
                          </div>
                        </div>
                        <hr>
                    @endforeach


                </div>
                <div class="ml-2">
                  {{$questions->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
