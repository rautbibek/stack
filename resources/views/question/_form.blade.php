@csrf
@if(isset($question))
<div class="form-group">
  <label for="question-title">Question Title</label>
  <input class="form-control {{ $errors->has('title')?'is-invalid':''}}" value="{{old('title',$question->title)}}" name="title" id="question-title" type="text" >
  @if($errors->has('title'))
  <div class="invalid-feedback">
    {{$errors->first('title')}}
  </div>
  @endif
</div>
@else 
<div class="form-group">
  <label for="question-title">Question Title</label>
  <input class="form-control {{ $errors->has('title')?'is-invalid':''}}" value="{{old('title')}}" name="title" id="question-title" type="text" >
  @if($errors->has('title'))
  <div class="invalid-feedback">
    {{$errors->first('title')}}
  </div>
  @endif
</div>
@endif
@if(isset($question))
<div class="form-group">
  <label for="question-title">Explain Question</label>
  <textarea class="form-control {{ $errors->has('body')?'is-invalid':''}}" name="body" id="question-body" rows="10" >{{old('body',$question->body)}}</textarea>
  @if($errors->has('body'))
  <div class="invalid-feedback">
    {{$errors->first('body')}}
  </div>
  @endif
</div>
@else 
<div class="form-group">
  <label for="question-title">Explain Question</label>
  <textarea class="form-control {{ $errors->has('body')?'is-invalid':''}}" name="body" id="question-body" rows="10" >{{old('body')}}</textarea>
  @if($errors->has('body'))
  <div class="invalid-feedback">
    {{$errors->first('body')}}
  </div>
  @endif
</div>
@endif

<div class="form-group">
  <button class="btn btn-outline-success " type="submit" name="button">{{$buttonText}}</button>
</div>
