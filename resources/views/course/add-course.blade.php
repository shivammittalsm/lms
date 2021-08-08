@extends('layouts.app')

@section('content')

@component('components.breadcrumbs', [
  'links'=>[
    'showcourses' => '/courses'
  ]])
  Add-courses
@endcomponent

<div class="container">
    <div class="row">
        <div class="col-2"> </div>
        <div class="col-8 col-md-offset-3">
            <div class="well well-sm">
                <!-- error messages section -->


                <form class="form-horizontal" action="{{ route('courses.store') }}" method="POST">
                    @csrf
                    <fieldset>
                        <legend class="text-center">New Course</legend>

                        <div class="form-group">
                            <label class="col-6 control-label" for="course_title">Title</label>
                            <div class="col-9">
                                <input id="course_title" name="course_title" type="text" placeholder="Title" class="form-control" value="{{ old('course_title') }}">
                                @if($errors->has('course_title'))
                                <span class="help-block text-danger fade-message">
                                    <strong>{{ $errors->first('course_title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="newQuestion"></div>


                        @if($errors->has('question_ids'))
                            <span class="help-block text-danger fade-message">
                                <strong>{{ $errors->first('question_ids') }}</strong>
                            </span>
                        @endif

                        <div class="form-group row">
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">Save Course</button>
                            </div>
                            <div class="col-7 text-right">
                                <button class="addQuestion btn btn-success" type="button">Add Question</button>
                            </div>

                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>
<script>
    jQuery(document).ready(function($){
        $(document).on('click', '#removeQuestion', function () {
            $(this).parent().parent('.form-group').remove();
        });

        $('.addQuestion').click(function() {
            var html = "";
            html += '<div class="form-group row">';
            html += '<label class="col-1 control-label text-primary" for="question">Question</label>';
            html += '<div class="col-8">';
            html += ' <div class="form-group"> <select class="form-control" name="question_ids[]"> @foreach($questions as $question) <option value="{{$question->id}}">{{$question->title}}</option>  @endforeach  </select> </div>';
            html += '</div>';
            html += '<div class="col-1">';
            html += '<button id="removeQuestion" type="button" class="btn btn-danger">Remove</button>';
            html += '</div>';
            html += '</div>';
            $('.newQuestion').append(html);
        });
    });

</script>
@endsection

