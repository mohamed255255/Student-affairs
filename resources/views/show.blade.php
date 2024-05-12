
@extends('master')

@section('content')

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col col-md-6"><b>Student Details</b></div>
			<div class="col col-md-6">
				<a href="{{ route('students.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
			</div>
		</div>
	</div>
	<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Student Profile</h5>
    </div>
    <div class="card-body">
    <div class="row">
        <!-- Left Column - Student Details -->
        <div class="col-md-6">
            <div class="row mb-3">
                <label class="col-sm-4 col-label-form"><b>Student Name</b></label>
                <div class="col-sm-8">
                    {{ $student->student_name }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-label-form"><b>Student Email</b></label>
                <div class="col-sm-8">
                    {{ $student->student_email }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-label-form"><b>Student Username</b></label>
                <div class="col-sm-8">
                    {{ $student->student_username }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-label-form"><b>Student Birthdate</b></label>
                <div class="col-sm-8">
                    {{ $student->student_birthdate }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-label-form"><b>Student Phone</b></label>
                <div class="col-sm-8">
                    {{ $student->student_phone }}
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-label-form"><b>Student Address</b></label>
                <div class="col-sm-8">
                    {{ $student->student_address }}
                </div>
            </div>
        </div>

        <!-- Right Column - Student Image -->
        <div class="col-md-6">
            <div class="row mb-3">
                <div class="col-sm-12 text-center">
                    <b>Student Image</b>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <img src="{{ asset('images/' . $student->student_image) }}" width="200" class="img-thumbnail" />
                </div>
            </div>
        </div>
    </div>
</div>

</div>


@endsection('content')
