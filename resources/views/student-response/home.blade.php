@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
    @endcomponent

    <div class="container">
        <div class="card">
            <h5 class="card-header text-uppercase">Course Name:-
                <span class="text-primary">{{ $course['course_name'] }}</span></h5>
            <div class="card-body">
                <h5 class="card-title fw-bold text-uppercase">About Course</h5>
                <p class="card-text lh-1 text-start">Laravel is a web application framework with expressive, elegant syntax.
                    A web framework provides a structure and starting point for creating your application,
                    allowing you to focus on creating something amazing while we sweat the details. <br>
                    Laravel strives to provide an amazing developer experience, while providing powerful features such as
                    thorough dependency injection,
                    an expressive database abstraction layer, queues and scheduled jobs, unit and integration testing, and
                    more.
                    Whether you are new to PHP or web frameworks or have years of experience, Laravel is a framework that
                    can grow with you.
                    We'll help you take your first steps as a web developer or give you a boost as you take your expertise
                    to the next level.
                    We can't wait to see what you build.
                </p>
                <p>
                    Instruction:
                <ol>
                    <li>You will get 30 mins to complete the quiz.</li>
                    <li>You should submit your form before 30 mins over otherwise you will not be able to submit the form.
                    </li>
                    <li>You are not allowed to search your question on Google</li>
                    <li>Do not refresh or use back button of the browser.</li>
                    <li> <strong>Every question is mandatory</strong> </li>
                    <li>Best Of Luck</li>
                </ol>

                </p>
                <a href="{{ route('student-responses.show', $course->id) }}" class="btn btn-primary">Take Test</a>
            </div>
        </div>
    </div>
@endsection
