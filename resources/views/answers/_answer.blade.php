                    <div class="media post">
                        @include('shared._vote',[
                          'model' => $answer,
                        ])
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
                                  @include('shared._author',[
                                    'model' => $answer,
                                    'label' => 'Answered',
                                  ])
                                </div>
                            </div>
                         
                        </div>
                  </div>