@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
    student-results
    @endcomponent

    <div class="container">
        <table class="table table-hover border">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course Name</th>
                    <th>Max marks</th>
                    <th>Marks obtained</th>
                    <th>Test Date & Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($responses as $response)
                    <tr>
                        <td>{{ Auth::user()->name }}</td>
                        <td>{{ $course[0] }}</td>
                        <td>{{ $response->max_marks }}</td>
                        <td>{{ $response->total_score }}</td>
                        <td>{{ $response->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
