@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
    @endcomponent

    <?php use Illuminate\Support\Facades\Auth; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
