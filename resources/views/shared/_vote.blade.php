@if($model instanceof App\Question)
    @php 
        $name = 'question';
        $firstURISegments = 'question';
    @endphp
@elseif($model instanceof App\Answer) 
    @php 
        $name = 'answer';
        $firstURISegments = 'answer';
    @endphp
@endif

<div class="d-flex flex-column vote-controls">
        <a title="this {{$name}} is useful" class="vote-up {{Auth::guest()?'off':''}}" onclick="event.preventDefault(); 
        document.getElementById('up-vote-{{$name}}-{{$model->id}}').submit();">
            <i class="fas fa-caret-up fa-3x"></i>
        </a>
        <form id="up-vote-{{$name}}-{{$model->id}}" action="/{{$firstURISegments}}/{{$model->id}}/vote" method="POST">
        @csrf
          <input type="hidden" name="vote" value="1">
        </form>
        <span class="votes-count">
        @if($model->question_id)
          {{$model->votes_count}}
        @else 
        {{$model->votes}}
        @endif
          
          
        </span>
          <a title="this {{$name}} is not useful" class="vote-down " onclick="event.preventDefault(); 
        document.getElementById('vote-down-{{$name}}-{{$model->id}}').submit();">
            <i class="fas fa-caret-down fa-3x"></i>
          </a>
        <form id="vote-down-{{$name}}-{{$model->id}}" action="/{{$firstURISegments}}/{{$model->id}}/vote" method="POST">
           @csrf
          <input type="hidden" name="vote" value="-1">
        </form>
    @if($model instanceof App\Question) 
      <favorite :question="{{$model}}"></favorite>
    @elseif($model instanceof App\Answer)
     <accept :answer="{{$model}}"></accept>
    @endif
 </div>