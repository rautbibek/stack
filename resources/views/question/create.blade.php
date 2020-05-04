@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-item-center">
                    <h2>Ask Question</h2>
                    <div class="ml-auto">
                      <a class="btn btn-outline-success btn-sm" href="{{route('question.index')}}">all questions</a>
                    </div>
                  </div>
                  <hr>
                  <form action="{{route('question.store')}}" method="POST">
                    @csrf
                    @include('question._form',['buttonText'=>'Ask Question'])
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
