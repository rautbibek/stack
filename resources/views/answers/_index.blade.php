<div class="card mt-3">
                <div class="card-body">
                <h3>{{$answerCount ." ".str_plural('Answer',$answerCount)}}</h3>
                  <hr>
                    @include('layouts._messages')
                  @foreach ($answers as $answer)
                      <div class="media">
                         <div class="d-flex flex-column vote-controls">
                      <a title="vote up" class="vote-up">
                        <i class="fas fa-caret-up fa-3x"></i>
                      </a>
                      <span class="votes-count">1230</span>
                      <a title="vote down thi question is not useful" class="vote-down off">
                        <i class="fas fa-caret-down fa-3x"></i>
                      </a>
                    @can('view',$answer)
                      <a title="Mark this as a best answer" class="{{$answer->best}} mt-5"
                      onclick="event.preventDefault; document.getElementById('best-answer-{{$answer->id}}').submit()"
                        >
                        <i class="fas fa-check fa-2x"></i><br>
                        <span class="favorites-count" >12489</span>
                      </a>
                    <form id="best-answer-{{$answer->id}}" action="{{route('accept.answer',$answer->id)}}" method="POST">
                        @csrf
                    </form>
                    @else 
                    @if($answer->is_best)
                    <a title="question author Mark this answer as a best answer" class="{{$answer->best}} mt-5">
                        <i class="fas fa-check fa-2x"></i><br>
                        <span class="favorites-count" >12489</span>
                      </a>
                      @endif
                    @endcan
                    </div>
                        <div class="media-body">
                          {!!$answer->body!!}
                            <div class="row mt-5">
                                <div class="col-4">
                                    <div class="btn-group">
                                        @can('update',$answer)
                                        <a class="btn btn-outline-success btn-sm mr-1" href="{{route('question.answer.edit',[$question->id,$answer->id])}}">Edit</a>
                                        @endcan
                                        @can('delete',$answer)
                                        <form action="{{route('question.answer.destroy',[$question->id,$answer->id])}}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button name="submit" onclick="return confirm('are you suer??')" class="btn btn-outline-danger btn-sm">Delete</button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                                <div class="col-4"></div>
                                 <div class="col-4 ">
                                    <div class="float-right">
                                    <span class="text-muted">
                                    Answered {{$answer->created_at->diffForHumans()}}
                                    </span>
                                    
                                    <div class="media mt-2">
                                    <a href="{{$answer->user->url}}" class="pr-2">
                                        <img src="{{$answer->user->avatar}}" alt="image not found">
                                    </a>
                                    <div class="media-body mt-1">
                                    <a href="{{$answer->user->url}}">{{$answer->user->name}}</a>
                                    </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                         
                        </div>
                      </div>
                      <hr>
                      
                  @endforeach

                </div>
            </div>