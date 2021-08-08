@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
    @endcomponent

    <div class="container">
        <span class="float-left alert-info"><u><strong>Leaderboard</strong></u></span>
        <student-result :results='@json($results)'></student-result>
    </div>

@endsection
