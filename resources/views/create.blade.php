
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
	<div class="card-header">Add Student</div>
	<div class="card-body">
	<form method="post" action="{{ route('students.store') }}" enctype="multipart/form-data">
		@csrf
		<div class="row">
			<!-- Left Column - First Four Fields -->
			<div class="col-md-6">
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Name</label>
					<div class="col-sm-8">
						<input type="text" name="student_name" class="form-control" />
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Birthdate</label>
					<div class="col-sm-8">
						<input type="date" name="student_birthdate" class="form-control" />
                        <div><button type="button" id="fetchActorsButton" style="background-color: white; border: 0;">Discover shared celebrity birthdays!<i class="fa-solid fa-circle-user" style=" margin-left: 3px;"></i></button> </div>
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Phone</label>
					<div class="col-sm-8">
						<input type="text" name="student_phone" class="form-control" />
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Address</label>
					<div class="col-sm-8">
						<input type="text" name="student_address" class="form-control" />
					</div>
				</div>
			</div>

			<!-- Right Column - Second Four Fields -->
			<div class="col-md-6">
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Username</label>
					<div class="col-sm-8">
						<input type="text" name="student_username" class="form-control" />
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Email</label>
					<div class="col-sm-8">
						<input type="text" name="student_email" class="form-control" />
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Password</label>
					<div class="col-sm-8">
						<input type="password" name="student_password" class="form-control" />
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Confirm Password</label>
					<div class="col-sm-8">
						<input type="password" name="student_password_confirmation" class="form-control" />
					</div>
				</div>
				<div class="row mb-3">
					<label class="col-sm-4 col-label-form">Image</label>
					<div class="col-sm-8">
						<input type="file" name="student_image" class="form-control-file" />
					</div>
				</div>
			</div>
		</div>

		<!-- Submit Button - Centered -->
		<div class="row justify-content-center">
			<div class="col-md-6 text-center">
				<button type="submit" class="btn btn-primary">Add</button>
			</div>
		</div>
	</form>
	<!-- In your create.blade.php -->
	<div class="actor-list" id="response_container">


		<ul class="actor-items">
			<li></li>
		</ul>
	</div>
	</div>
</div>
<script>
    $(document).ready(function() {
		document.getElementById('fetchActorsButton').addEventListener('click', function() {
			

        event.preventDefault();

        var birthdate = $('input[name="student_birthdate"]').val();

        $.ajax({
            type: 'POST',
            url: "{{ route('discover.celebrities') }}",
            data: {_token: "{{ csrf_token() }}",
                    birthdate: birthdate},
            success: function(response) {
                // Display actors' names in the response container
                document.getElementById('response_container').innerHTML = response;
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Display error message in the response container
                $('.response_container').html('<p>Error occurred. Please try again later.</p>');
            }
        });
    });
});
</script>
@endsection('content')