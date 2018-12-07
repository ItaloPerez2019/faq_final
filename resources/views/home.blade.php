@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Questions <span class="badge badge-secondary">{{$questions->count()}}</span>
                        <span class="badge badge-danger"></span>
                        <a class="btn btn-primary btn-sm float-right" href="{{ route('question.create')}}">
                            Create a Question
                        </a>
                    </div>

                    <div class="card-body">
                            <div class="card-deck">
                                @forelse($questions as $question)
                                    <div class="col-sm-4 d-flex align-items-stretch">
                                        <div class="card mb-3 ">
                                            <div class="card-header">
                                                <small class="text-muted">
                                                    Updated: {{ $question->created_at->diffForHumans() }}
                                                </small>
                                                <small class="text-muted float-right" style="">
                                                    Answers: <span class="badge badge-primary">{{ $question->answers()->count() }}</span>
                                                </small>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">{{$question->body}}</p>
                                            </div>
                                            <div class="card-footer">
                                                <p class="card-text">

                                                    <a class="btn btn-primary float-right" href="{{ route('question.show', ['id' => $question->id]) }} ">
                                                        View
                                                    </a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                        There are not question to view, you can create a new question.
                                @endforelse
                            </div>
                        </div>

                    <div class="float-right">
                        {{ $questions->links() }}
                    </div>

                    </div>
                </div>
            </div>
        </div>

@endsection