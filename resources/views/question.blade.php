@extends('layouts.app')
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <style>
        .card-inner{
            margin-left: 50px;
        }

    </style>
@section('content')

<div class="container">
        <h2 class="text-center">Question & Answers</h2>
        <br/>
        <div class="card">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-2">
                        <img src="{{asset('user.png')}}" class="img img-rounded img-fluid"/>
                        <p class="text-secondary text-center">{{ $question->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="col-md-10">
                        <a href="{{ route('answer.create', ['question_id'=> $question->id])}}" class="float-right btn text-white btn-success "> <i class="fa fa-reply"></i> Answer The Question</a>
                        <div class="pull-left meta">
                            <div class="title h5">
                                <a href="#"><b>{{ucfirst($question->user->email)}}</b></a>
                                Asked Question.
                            </div>
                            <a class="btn btn-primary btn-sm float-left" title="Edit The Question"
                               href="{{ route('question.edit',['id'=> $question->id])}}">
                                <i class="fa fa-edit"></i>
                            </a>
                            {{ Form::open(['method' => 'DELETE', 'route' => ['question.destroy', $question->id]])}}
                            <button title="Delete the Question" class="btn btn-danger btn-sm float-left ml-3" value="sumit" id="sumit"><i class="fa fa-trash"></i>
                            </button>
                            {!! Form::close() !!}
                            <br/>
                        </div>

                        <div class="clearfix"></div>
                        <p>
                            {{$question->body}}
                        </p>
                        <p>
                            <a class="question_vote_btn float-right btn text-white btn-danger" id="qs_vote_down" data-id="down" data-value="{{$question->dislikes}}">
                                <i class="fa fa-thumbs-down"></i> DisLike (<span id="dislikeSpan">{{$question->dislikes}}</span>)
                            </a>

                            <a class="question_vote_btn float-right btn text-white btn-primary mr-2" id="qs_vote_up" data-id="up" data-value="{{$question->likes}}">
                                <i class="fa fa-thumbs-up"></i> Like (<span id="likeSpan">{{$question->likes}}</span>)
                            </a>

                        </p>

                    </div>

                </div>
                <br/>
                <br/>
                @forelse($question->answers as $answer)
                    <div class="card card-inner">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left meta">
                                    <div class="title h5">
                                        <a href="#"><b>{{ucfirst($answer->user->email)}}</b></a>
                                        Answered.
                                    </div>
                                    <h6 class="text-muted time">
                                        {{$answer->created_at->diffForHumans()}}
                                    </h6>
                                </div>
                                <div class="clearfix"></div>
                                <p>
                                    {{$answer->body}}
                                    <a class="btn btn-primary float-right"
                                       href="{{ route('answer.show', ['question_id'=> $question->id,'answer_id' => $answer->id]) }}">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                    <div class="alert alert-danger">
                        <strong>Oops.!</strong> No answer found.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

@endsection
@push('scripts.end.body')
    <script type="text/javascript">
        jQuery(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            //Content voting
            $(document).on("click", '.question_vote_btn', function (event) {

                var question_id = "{{$question->id}}";

                var id = $(this).attr('id');
                var type = $(this).attr('data-id');
                var total = $(this).attr('data-value');


                if (type == 'up') {
                    var likes = parseInt(total);
                    likes++;
                    $("#likeSpan").text(likes);
                    $(this).attr('data-value', likes);
                }
                else {
                    var dislikes = parseInt(total);
                    dislikes++;
                    $("#dislikeSpan").text(dislikes);
                    $(this).attr('data-value', dislikes);
                }

                var request = $.ajax({
                    method: "POST",
                    url: "{{route('question.likeDislike')}}",
                    dataType: 'html',
                    data: {
                        "type":type,
                        "question_id": question_id
                    }
                });

                request.done(function(data) {
                    toastr.success("Your feedback saved successfully", "Message");
                });

                request.fail(function( jqXHR, textStatus ) {
                    toastr.error('Something went wrong', "Message");
                });
            });
        });
    </script>

@endpush