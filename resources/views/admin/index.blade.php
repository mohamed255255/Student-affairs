@extends('admin.master')

@section('content')
    <!-- Check for success message and display it -->
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <!-- Buttons to navigate to studentCRUD and courseCRUD pages -->
    <div class="d-flex justify-content-center mb-4">
       <a href="{{ route('admin.studentCRUD') }}" class="btn btn-primary mx-2">Student CRUD</a>
       <a href="{{ route('admin.courseCRUD') }}" class="btn btn-secondary mx-2">Course CRUD</a>
    </div>

@endsection
