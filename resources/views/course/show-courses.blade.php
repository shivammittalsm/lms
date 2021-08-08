@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
        show-courses
    @endcomponent

    <div class="container">
        <div>
            @if (session()->has('courseDeletionSuccess'))
                <div class="alert alert-success fade-message">
                    {{ session()->get('courseDeletionSuccess') }}
                </div>
            @elseif(session()->has('courseDeletionFail'))
                <div class="alert alert-danger fade-message">
                    {{ session()->get('courseDeletionFail') }}
                </div>
            @elseif(session()->has('courseUpdated'))
                <div class="alert alert-success fade-message">
                    {{ session()->get('courseUpdated') }}
                </div>
            @endif
        </div>
        <div>
            @if (session()->has('addCourseSuccess'))
                <div class="alert alert-success fade-message">
                    {{ session()->get('addCourseSuccess') }}
                </div>
            @elseif(session()->has('addCourseFail'))
                <div class="alert alert-danger fade-message">
                    {{ session()->get('addCourseFail') }}
                </div>
            @endif
        </div>
        <br>
        <div class="row">
            <div class="col-10">
                <table class="table table-hover border">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Course Name</th>
                            <th>View Questions</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <?php $id = 1; ?>
                    <tbody>
                        @foreach ($courses_list as $course)
                            <tr>
                                <td>{{ $id }}</td>
                                <td>{{ $course->course_name }}</td>
                                <td><a href="{{ route('courses.show', $course) }}">Questions</a></td>
                                <td> <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Edit</a> </td>
                                <td>
                                    <form action="{{ route('courses.destroy', $course) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            <?php $id++; ?>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
