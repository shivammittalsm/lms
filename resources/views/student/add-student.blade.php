@extends('layouts.app')

@section('content')

    @component('components.breadcrumbs')
        Add-students
    @endcomponent

    <div class="container">
        <h3 class="text-center text-primary text-uppercase">Add New Student</h3>
        <form method="POST" action="{{ route('students.store') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">Name:-</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control" name="name" required value="{{ old('name') }}">
                    @if ($errors->has('name'))
                        <span class="help-block text-danger fade-message">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">Email:-</label>
                <div class="col-md-6">
                    <input id="email" type="text" class="form-control" name="email" required value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block text-danger fade-message">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">Phone:-</label>
                <div class="col-md-6">
                    <input id="phone" type="number" class="form-control" name="phone" required value="{{ old('phone') }}">
                    @if ($errors->has('phone'))
                        <span class="help-block text-danger fade-message">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="course" class="col-md-4 col-form-label text-md-right">Course:-</label>
                <div class="col-md-6">
                    <select class="form-control" name="courseId">
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('course'))
                        <span class="help-block text-danger fade-message">
                            <strong>{{ $errors->first('course') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary"> {{ __('Register') }} </button>
                </div>
            </div>
        </form>
    </div>
@endsection
