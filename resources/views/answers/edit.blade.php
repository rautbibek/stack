@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-5">
                <div class="card-body">
                    <h3>Q. {{$question->title}}</h3>
                    <hr>
                    <form action="{{route('question.answer.update',[$question->id,$answer->id])}}" >
                        @method('PUT')
                        @csrf
                      <div class="form-group">
                        <label for="answer">Answer Body</label>
                      <textarea name="body" class="form-control {{$errors->has('body')?'is-invalid':''}}" cols="30" rows="10">{{old('body',$answer->body)}}</textarea>
                       </div>
                       <button type="submit" class="btn btn-outline-success">Update Answer</button>
                    <a href="{{route('question.show',$question->slug)}}" class="btn btn-outline-danger">Cancel</a>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
