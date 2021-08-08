@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
        show-questions
    @endcomponent

    @include('alert::bootstrap')

    <div class="container">
        <div class="row">
            <div class="col-12">
                @if (Session()->has('success'))
                    @validationMessage('success')
                @endif
            </div>
        </div>
        <show-question :questions='@json($questions)'></show-question>
    </div>
@endsection
