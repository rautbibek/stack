                    @can('view',$answer)
                      <a title="Mark this as a best answer" class="{{$answer->best}} mt-5"
                      onclick="event.preventDefault; document.getElementById('best-answer-{{$answer->id}}').submit()"
                        >
                        <i class="fas fa-check fa-2x"></i><br>
                        
                      </a>
                    <form id="best-answer-{{$answer->id}}" action="{{route('accept.answer',$answer->id)}}" method="POST">
                        @csrf
                    </form>
                    @else 
                    @if($answer->is_best)
                    <a title="question author Mark this answer as a best answer" class="{{$answer->best}} mt-5">
                        <i class="fas fa-check fa-2x"></i><br>
                        
                      </a>
                    @endif
                    @endcan