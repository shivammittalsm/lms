@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
    @endcomponent

    <div class="container">

        <div class="card">
            <h5 class="card-header">Course Name:- <span class="text-primary">{{ $courses['course_name'] }}</span></h5>
        </div>
        <br>
        <div class="row">
            <div class="col-8">
                <form class="form-horizontal" action="{{ route('student-responses.store') }}" method="POST">
                    @csrf

                    @foreach ($courses->questions as $question)
                        <div class="form-group">
                            <div class="col-md-9">
                                <input type="hidden" name="question_title[]" value="{{ $question->id }}">
                                <span><strong>Question : </strong> {{ $question->title }}</span><br>
                            </div>
                        </div>
                        @foreach ($question->options as $option)
                            <div class="row">
                                <div class="col-1"></div>
                                <div class="col-3">
                                    <input type="hidden" name="options[{{ $question->id }}][]" value="{{ $option->id }}">
                                    <span>{{ $option->option }}</span><br>
                                </div>
                                <div class="col-1">
                                    <input type="checkbox" id="correctOption" name="correctOptions[{{ $question->id }}][]"
                                        value="{{ $option->id }}">
                                </div>
                            </div>
                        @endforeach
                        <br>
                    @endforeach
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4">
                <div class="card">
                    <h3 class="card-header">Test results</h3>
                    <div class="card-body">
                        <p>Median calculation and distribution of tests results*</p>
                        <table class="table">
                            <tbody class="border">
                                <tr class="border">
                                    <td class="border">Results between 1-5 / 20</td>
                                    <td>12.08%</td>
                                </tr>
                                <tr class="border">
                                    <td class="border">Results between 6-10 / 20</td>
                                    <td>42.06%</td>
                                </tr>
                                <tr class="border">
                                    <td class="border">Results between 11-15 / 20</td>
                                    <td>34.13%</td>
                                </tr>
                                <tr class="border">
                                    <td class="border">Results between 16-20 / 20</td>
                                    <td>11.73%</td>
                                </tr>
                                <tr class="border">
                                    <td>Average results 10 / 20</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
