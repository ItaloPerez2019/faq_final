@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Answer</div>
                    <div class="card-body">
                        {{$answer->body}}
                    </div>
                    <div class="card-footer">
                    {{ Form::open(['method' => 'DELETE', 'onsubmit' =>"return confirm('Are you sure you to delete?');" ,'route' => ['answer.destroy', $question,$answer->id]])}}
                    <button class ="btn btn-danger float-right ml-2" value="submit" type="submit"
                            id="submit"> Delete</button>
                        {!! Form::close() !!}
                        <a class="btn btn-primary float-right" href="{{ route ('answer.edit',['question_id' => $question,'answer_id'=> $answer ->id,])}}">
                    Edit Answer
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection



