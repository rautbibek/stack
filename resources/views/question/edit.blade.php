@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-item-center">
                    <h2>Edit Question</h2>
                    <div class="ml-auto">
                      <a class="btn btn-outline-success btn-sm" href="{{route('question.index')}}">all questions</a>
                    </div>
                  </div>
                  <hr>
                  <form action="{{route('question.update',$question->id)}}" method="POST">
                  @csrf
                  @method('PUT')
                    @include('question._form',['buttonText'=>'Update Question'])
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
