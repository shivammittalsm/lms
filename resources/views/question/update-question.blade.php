@extends('layouts.app')

@section('content')

@component('components.breadcrumbs',[
    'links'=>[
      'show-questions' => '/questions',
    ]])
  update-questions
@endcomponent

<div class="container">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-7">
            <div class="well well-lg">
                <form class="form-horizontal" action="{{ route('questions.update',$question) }}" method="post">
                    @csrf
                    @method('put')
                    <legend class="text-center">Update Question</legend>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="question_title">Question Title</label>
                        <div class="col-md-9">
                            <input id="question_title" name="question_title" value="{{ $question->title }}" type="text" class="form-control">
                            @if($errors->has('question_title'))
                                <span class="help-block fade-message">
                                    <strong>{{ $errors->first('question_title') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div>
                            <input type="hidden" value="{{$question->id}}" name="question_id">
                        </div>
                    </div>

                    <?php $count=0; ?>
                    @foreach($options as $opt)
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="text" id="option<?php echo $count; ?>" name="options[]" value="{{$opt->option}}" placeholder="Option<?php echo $count; ?>">
                            </div>
                            <div>
                                <input type="checkbox" name="correctOptions[]" id="correctOption<?php echo $count; ?>" value="<?php echo $count; ?>" <?php if($opt->answer){ ?> checked <?php } ?>>
                            </div>
                        </div>
                        <br>
                        <?php $count++; ?>
                    @endforeach

                    <?php
                        for($row=$count; $row<5; $row++)
                        {
                    ?>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <input type="text" id="option<?php echo $row; ?>" name="options[]" placeholder="Option<?php echo $row; ?>">
                            </div>
                            <div>
                                <input type="checkbox" id="correctOption<?php echo $row; ?>" value="<?php echo $row; ?>"  name="correctOptions[]">
                            </div>
                        </div>
                        <br>
                    <?php
                        }
                    ?>

                    @if ($errors->has('options'))
                        <span class="help-block fade-message">
                            <strong>{{ $errors->first('options') }}</strong>
                        </span>
                    @endif

                    <div class="row">
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary">Update question</button>
                        </div>
                        <div class="col-2">
                            <a href="/questions" class="btn btn-danger">Cancle</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
