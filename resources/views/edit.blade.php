
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
                    <label class="col-sm-4 col-label-form">@lang("public.name")</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_name" class="form-control" value="{{ $student->student_name }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">@lang("public.email")</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_email" class="form-control" value="{{ $student->student_email }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">@lang("public.username")</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_username" class="form-control" value="{{ $student->student_username }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">@lang("public.phone")</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_phone" class="form-control" value="{{ $student->student_phone }}" />
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-4 col-label-form">@lang("public.address")</label>
                    <div class="col-sm-8">
                        <input type="text" name="student_address" class="form-control" value="{{ $student->student_address }}" />
                    </div>
                </div>
				<div class="row mb-2">
					<label class="col-sm-4 col-label-form"><b>@lang("public.oldpassword")</b></label>
					<div class="col-sm-8">
						<input type="password" name="old_password" class="form-control" />
					</div>
				</div>
				<div class="row mb-2">
					<label class="col-sm-4 col-label-form"><b>@lang("public.newpassword")</b></label>
					<div class="col-sm-8">
						<input type="password" name="new_password" class="form-control" />
					</div>
				</div>
				<div class="row mb-2">
					<label class="col-sm-4 col-label-form"><b>@lang("public.confirm")</b></label>
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
                        <img id="student_image_preview" src="{{ asset('images/' . $student->student_image) }}" width="200" class="img-thumbnail" />
                        <div class="col-sm-12 mt-2">
                            <input type="file" name="student_image" id="student_image" style="width: 113px;" onchange="previewImage();" />
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
<script>
    function previewImage() {
        var fileInput = document.getElementById('student_image');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onload = function(e) {
            $('#student_image_preview').attr('src', e.target.result);
        };

        if (file) {
            reader.readAsDataURL(file); // Convert file to data URL
        }
    }
    $(document).ready(function() {
        $('#student_image').change(function() {
            var formData = new FormData();
            formData.append('student_image', $('#student_image')[0].files[0]);

            $.ajax({
                type: 'POST',
                url: "{{ route('students.uploadImage') }}", // Define your route for image upload
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Update hidden input with new image filename
                    $('input[name="hidden_student_image"]').val(response.filename);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    });

</script>
@endsection('content')
