<div class="media post">
                          <div class="d-flex flex-column countersr">
                            <div class="vote">
                              <strong>{{$question->votes}}</strong> {{str_plural('vote',$question->votes)}}
                            </div>

                            <div class="status {{$question->status}} py-1 mb-2">
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
                                  {{$question->title}} ?
                                </a>
                              </h3>
                              <div class="ml-auto">
                                @can('update',$question)
                                <a class="btn btn-outline-success btn-sm" href="{{route('question.edit',$question->id)}}">Edit</a>
                                @endcan
                                @can('delete', $question)

                                <form class="d-inline" action="{{route('question.destroy',$question->id)}}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button class="btn btn-outline-danger btn-sm" type="submit" onclick="return confirm('are you sure ??')">delete</button>
                                </form>
                                                                  
                                @endcan
                              </div>
                            </div>

                            <p class="lead">
                              Asked By
                              <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                              <small class="text-muted">{{$question->created_date}}</small>
                            </p>
                            
                            {!!$question->excerpt !!}
                            
                          </div>
                        </div>