<div class="container">
    <table class="table table-hover border">
        <thead>
            <tr>
                <th class="border">Record</th>
                <th>Student Name</th>
                <th>Email Id</th>
                <th>Course Name</th>
                <th>Rank</th>
                <th>Average Marks in %</th>
                <th>Total attempt</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($results as $key => $result)
                <tr>
                    <td class="border">{{++$key}}</td>
                    <td>{{$result['name']}}</td>
                    <td>{{$result['email']}}</td>
                    <td>{{$result['course']}}</td>
                    <td>{{$key}}</td>
                    <td>{{$result['percentage']}}%</td>
                    <td>{{$result['attempt']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

