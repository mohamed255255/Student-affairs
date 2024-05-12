
@extends('master')

@section('content')


@if($errors->any())

<div class="alert alert-danger">
	<ul>
	@foreach($errors->all() as $error)

		<li>{{ $error }}</li>

	@endforeach
	</ul>
</div>

@endif

<div class="card">
	<div class="card-header">Edit Student</div>
	<div class="card-body">
    <form method="post" action="{{ route('students.update', $student->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <!-- Left Column - Student Details -->
            <div class="col-md-6">
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">Student Name</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_name" class="form-control" value="{{ $student->student_name }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">Student Email</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_email" class="form-control" value="{{ $student->student_email }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">Student Username</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_username" class="form-control" value="{{ $student->student_username }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">Student Phone</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_phone" class="form-control" value="{{ $student->student_phone }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">Student Address</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_address" class="form-control" value="{{ $student->student_address }}" />
                    </div>
                </div>
				<div class="row mb-2">
					<label class="col-sm-4 col-label-form"><b>Old Password</b></label>
					<div class="col-sm-8">
						<input type="password" name="old_password" class="form-control" />
					</div>
				</div>
				<div class="row mb-2">
					<label class="col-sm-4 col-label-form"><b>New Password</b></label>
					<div class="col-sm-8">
						<input type="password" name="new_password" class="form-control" />
					</div>
				</div>
				<div class="row mb-2">
					<label class="col-sm-4 col-label-form"><b>Confirm Password</b></label>
					<div class="col-sm-8">
						<input type="password" name="new_password_confirmation" class="form-control" />
					</div>
				</div>
            </div>

            <!-- Right Column - Student Image -->
            <div class="col-md-6">
                <div class="row mb-2">
                    <label class="col-sm-12 col-label-form text-center">Student Image</label>
                </div>
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <img src="{{ asset('images/' . $student->student_image) }}" width="200" class="img-thumbnail" />
						<div class="col-sm-12">
							<input type="file" name="student_image" style=" width: 113px;" /> 
							<input type="hidden" name="hidden_student_image" value="{{ $student->student_image }}" />
						</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <input type="hidden" name="hidden_id" value="{{ $student->id }}" />
            <input type="submit" class="btn btn-primary" value="Edit" />
        </div>
    </form>
</div>

</div>

@endsection('content')
