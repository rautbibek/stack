@extends('layouts.app')
@section('content')
<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex align-item-center">
                    <h2>All Questions</h2>
                    <div class="ml-auto">
                      <a class="btn btn-outline-success btn-sm" href="{{route('question.create')}}">Ask Queston</a>
                    </div>
                  </div>
                  <hr>
                    @include('layouts._messages')
                    @forelse($questions as $question)
                        @include('question._question')
                        
                        @empty
                        <div class="alert alert-warning">
                          <strong>Sorry </strong> No question Available;
                        </div>
                    @endforelse


                </div>
                <div class="ml-2">
                  {{$questions->links()}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
