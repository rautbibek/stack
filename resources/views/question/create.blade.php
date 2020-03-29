@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex align-item-center">
                    <h2>Ask Question</h2>
                    <div class="ml-auto">
                      <a class="btn btn-outline-success btn-sm" href="{{route('question.index')}}">all questions</a>
                    </div>
                  </div>

                </div>

                <div class="card-body">
                  <form action="{{route('question.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="question-title">Question Title</label>
                      <input class="form-control {{ $errors->has('title')?'is-invalid':''}}" value="{{old('title')}}" name="title" id="question-title" type="text" >
                      @if($errors->has('title'))
                      <div class="invalid-feedback">
                        {{$errors->first('title')}}
                      </div>
                      @endif
                    </div>
                    <div class="form-group">
                      <label for="question-title">Explain Question</label>
                      <textarea class="form-control {{ $errors->has('body')?'is-invalid':''}}" name="body" id="question-body" rows="10" >{{old('body')}}</textarea>
                      @if($errors->has('body'))
                      <div class="invalid-feedback">
                        {{$errors->first('body')}}
                      </div>
                      @endif
                    </div>

                    <div class="form-group">
                      <button class="btn btn-outline-success " type="submit" name="button">Ask this question</button>
                    </div>
                  </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
