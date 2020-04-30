@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                  <div class="d-flex align-item-center">
                    <h2>Question</h2>
                    <div class="ml-auto">
                      <a class="btn btn-outline-success btn-sm" href="{{route('question.index')}}">all questions</a>
                    </div>
                  </div>

                </div>

                <div class="card-body">
                  <h3>{{$question->title}} ?</h3>
                  <hr>
                  {!!$question->body!!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
