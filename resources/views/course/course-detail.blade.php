@extends('layouts.app')

@section('content')

@component('components.breadcrumbs',[
    'links'=>[
      'courses' => '/courses'
    ]] )
Course-details
@endcomponent

<div class="container">
    <h3 class="text-primary text-uppercase">
        Course Name:-  {{$courseDetails->course_name}}
    </h3>

    <?php $count=0; ?>
    @foreach ($courseDetails->questions as $question)
        <div class="row border p-2">
            <div class="col-2 border">Question <?php echo ++$count; ?></div>
            <div class="col-10 fw-bold">{{$question->title}}</div>
        </div>
        @foreach ($question->options as $key=>$option)
            <div class="row">
                <div class="col-3 border">
                    <p class="{{($option->answer) ? "text-success" : "text-black" }}"> {{ $option->option }}</p>
                </div>
            </div>
        @endforeach
        <br>
    @endforeach
</div>
@endsection
