@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
    @endcomponent

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="card col-6" style="width: 18rem;">
                <div class="card-header card-title ">
                    Test result
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total Marks:- {{ $score }}</li>
                    <li class="list-group-item">Total Questions:- {{ $totalQuestions }}</li>
                    <li class="list-group-item">Marks in % :- {{ ($score * 100) / $totalQuestions }}</li>
                    <li class="list-group-item">
                        @if (($score * 100) / $totalQuestions > 33)
                            Congratulations on your great achievement. Never run after success; gain worthiness, and success
                            will run after you.
                        @else
                            You did not pass the exam <br> Better luck next time
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
