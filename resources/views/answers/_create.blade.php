<div class="card mt-3">
  <div class="card-body">
    <h3>Your Answer</h3>
   <hr>
  <form action="{{route('question.answer.store',$question)}}" method="POST">
    @csrf
        <div class="form-group">
        <textarea name="body" class="form-control {{$errors->has('body')?'is-invalid':''}}" cols="30" rows="7"></textarea>
        </div>
        @auth
        <button class="btn  btn-outline-success">Submit</button>
        @else 
      <a href="{{route('login')}}" class="btn  btn-outline-success">Login first</a>
        @endauth
    </form>

 </div>
</div>