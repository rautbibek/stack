@if($answerCount)
<div class="card mt-3" v-cloak>
                <div class="card-body">
                <h3>{{$answerCount ." ".str_plural('Answer',$answerCount)}}</h3>
                  <hr>
                  @include('layouts._messages')
                  @foreach ($answers as $answer)
                    @include('answers._answer')    
                  @endforeach

                </div>
            </div>
@endif