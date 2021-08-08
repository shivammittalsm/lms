@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs', [
        'links' => [ 'showquestions' => '/questions', ],
        ])
        Add-questions
    @endcomponent
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6 col-md-offset-3">
                <div class="well well-lg border">
                    <form class="form-horizontal" action="{{ route('questions.store') }}" method="POST">
                        @csrf
                        <legend class="text-center">Add Questions</legend>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="question_title">Question Title</label>
                            <div class="col-md-9">
                                <input id="question_title" name="question_title" type="text"
                                    placeholder="What is your name?" value="{{ old('question_title') }}"
                                    class="form-control" required>
                                @if ($errors->has('question_title'))
                                    <span class="help-block text-danger fade-message">
                                        <strong>{{ $errors->first('question_title') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="text" id="option1" name="options[]" placeholder="Option1">
                            </div>
                            <div class="col-1">
                                <input type="checkbox" id="correctOption1" value="0" name="correctOptions[]">
                            </div>
                        </div> <br>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="text" id="option2" name="options[]" placeholder="Option2">
                            </div>
                            <div class="col-1">
                                <input type="checkbox" id="correctOption2" value="1" name="correctOptions[]">
                            </div>
                        </div> <br>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="text" id="option3" name="options[]" placeholder="Optional">
                            </div>
                            <div class="col-1">
                                <input type="checkbox" id="correctOption3" value="2" name="correctOptions[]">
                            </div>
                        </div> <br>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="text" id="option4" name="options[]" placeholder="Optional">
                            </div>
                            <div class="col-1">
                                <input type="checkbox" id="correctOption4" value="3" name="correctOptions[]">
                            </div>
                        </div> <br>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="text" id="option5" name="options[]" placeholder="Optional">
                            </div>
                            <div class="col-1">
                                <input type="checkbox" id="correctOption5" value="4" name="correctOptions[]">
                            </div>
                        </div> <br>
                        <div>
                            @if ($errors->has('options'))
                                <span class="help-block text-danger fade-message">
                                    <strong>{{ $errors->first('options') }}</strong>
                                </span>
                            @endif
                            <br>
                            @if ($errors->has('correctOptions'))
                                <span class="help-block text-danger fade-message">
                                    <strong>{{ $errors->first('correctOptions') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-6"></div>
                            <div class="form-group col-6">
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Add Question</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
