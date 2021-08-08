@extends('layouts.app')
@section('content')

    <div class="container">
        <div>
            <h4 class="text-center">Update Course</h4>
        </div>

        <form class="form-horizontal" action="{{ route('courses.update', $course) }}" method="post">
            @method('PUT')
            @csrf
            <div>
                <label class="col-6 control-label" for="course_title">Title</label>
                <div class="col-9">
                    <input id="course_title" name="course_title" type="text" placeholder="Course Title"
                        value="{{ $course->course_name }}" class="form-control">
                    <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
                </div>
            </div>
            <fieldset>
                <div>
                    <br>
                    @foreach ($courseQuestion as $trueQuestion)
                        <div class="form-group row">
                            <label class="col-1 control-label text-primary" for="question">Previous Question</label>
                            <div class="form-group col-8">
                                <select class="form-control" name="question_ids[]">
                                    @foreach ($questions as $question)
                                        <option value="{{ $question->id }}" <?php if ($question->id ===
                                            $trueQuestion->id) { ?> selected <?php } ?> >{{ $question->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <button id="removeQuestion" type="button" class="btn btn-danger">Remove</button>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="newQuestion"></div>

                <div class="form-group row">
                    <div class="col-2">
                        <button type="submit" class="btn btn-primary">Save Course</button>
                    </div>
                    <div class="col-1">
                        <a href="/courses" class="btn btn-danger">Cancel</a>
                    </div>
                    <div class="col-6 text-right">
                        <button class="addQuestion btn btn-success" type="button">Add Question</button>
                    </div>
                </div>
            </fieldset>
        </form>

        <script>
            jQuery(document).ready(function($) {
                $(document).on('click', '#removeQuestion', function() {
                    $(this).parent().parent('.form-group').remove();
                });
                $('.addQuestion').click(function() {
                    var html = "";
                    html += '<div class="form-group row">';
                    html += '<label class="col-1 control-label text-primary" for="question">New Question</label>';
                    html += '<div class="col-8">';
                    html +=
                        ' <div class="form-group"> <select class="form-control" name="question_ids[]"> @foreach ($questions as $question) <option value="{{ $question->id }}">{{ $question->title }}</option>  @endforeach  </select> </div>';
                    html += '</div>';
                    html += '<div class="col-1">';
                    html += '<button id="removeQuestion" type="button" class="btn btn-danger">Remove</button>';
                    html += '</div>';
                    html += '</div>';
                    $('.newQuestion').append(html);
                });
            });
        </script>
    </div>
@endsection
