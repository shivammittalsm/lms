@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs', [
        'links' => [
        'show-students' => '/students',
        ],
        ])
        Result
    @endcomponent

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">Student Name:- {{ $responses['user']->name }}</div>
                            @foreach ($responses['course'] as $course)
                                <div class="col-6">Course Name:- {{ $course->course_name }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Test no.</th>
                                    <th>Max marks</th>
                                    <th>Marks obtained</th>
                                    <th>Marks in %</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=0;
                                @endphp
                                @foreach ($responses['responses'] as $response)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $response->max_marks }}</td>
                                        <td>{{ $response->total_score }}</td>
                                        <td>{{ ($response->total_score * 100) / $response->max_marks }}%</td>
                                        <td>{{ $response->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <br>
        <h3 class="text-center">Chart Representation of <u><strong class="text-info">{{$responses['user']->name}}</strong></u> result</h3>
            <div id="linechart" style="width: 1000px; height: 400px"></div>
            <script type="text/javascript">
                var chart = <?php echo $chartDetails; ?>;
                google.charts.load('current', {
                    'packages': ['corechart']
                });
                google.charts.setOnLoadCallback(lineChart);

                function lineChart() {
                    var data = google.visualization.arrayToDataTable(chart);
                    var options = {
                        title: 'Student Result',
                        curveType: 'function',
                        legend: {
                            position: 'bottom'
                        }
                    };
                    var charts = new google.visualization.LineChart(document.getElementById("linechart"));
                    charts.draw(data, options);
                }
            </script>
        </div>
    </div>

@endsection
