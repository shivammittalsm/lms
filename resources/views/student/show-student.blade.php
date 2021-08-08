@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs', [
        'links' => [
        'add-students' => '/students/create',
            ],
        ])
        show-students
    @endcomponent


    <div class="container">
        <div class="fade-message">
            @if (session()->has('studentDeleteSuccess'))
                <div class="alert alert-success fade-message">
                    {{ session()->get('studentDeleteSuccess') }}
                </div>
            @elseif(session()->has('studentDeleteFail'))
                <div class="alert alert-danger fade-message">
                    {{ session()->get('studentDeleteFail') }}
                </div>
            @elseif(session()->has('success'))
                <div class="alert alert-success fade-message">
                    {{ session()->get('success') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-1 font-italic border">S.No</div>
            <div class="col-2 text-uppercase font-italic border">Name</div>
            <div class="col-3 text-uppercase font-italic border">emailId</div>
            <div class="col-2 text-uppercase font-italic border">Total Courses</div>
            <div class="col-2 text-uppercase font-italic border">Course Name</div>
            <div class="col-2 text-uppercase font-italic border">Action</div>
        </div>
        <br>
        @php
        $i=0;
        @endphp

        @foreach ($students as $student)
            <div class="row">
                <div class="col-1 border text-center"><?php echo ++$i; ?></div>
                <div class="col-2 border text-center">{{ $student['name'] }}</div>
                <div class="col-3 border text-center">{{ $student['email'] }}</div>
                <div class="col-2 border text-center">{{ $student['counter'] }}</div>
                <div class="col-2 border text-center">
                    @foreach ($student->courses as $course)
                        {{ $course['course_name'] }}
                    @endforeach
                </div>
                <div class="col-1 border">
                    <a href="{{ route('students.show', $student->id) }}" class="btn btn-success">Result</a>
                </div>
                <div class="col-1 border">
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endsection
