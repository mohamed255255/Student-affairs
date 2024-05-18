
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
            <form method="post" action=" {{ route('students.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- Left Column - First Four Fields -->
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.name")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_name" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.birthdate")</label>
                            <div class="col-sm-8">
                                <input type="date" name="student_birthdate" class="form-control" />
                                <div><button type="button" id="fetchActorsButton" style="background-color: white; border: 0;">@lang("public.celebrity")<i class="fa-solid fa-circle-user" style=" margin-left: 3px;"></i></button> </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.phone")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_phone" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.address")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_address" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <!-- Right Column - Second Four Fields -->
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.username")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_username" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.email")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_email" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.password")</label>
                            <div class="col-sm-8">
                                <input type="password" name="student_password" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.confirm")</label>
                            <div class="col-sm-8">
                                <input type="password" name="student_password_confirmation" class="form-control" />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.image")</label>
                            <div class="col-sm-8">
                                <input type="file" name="student_image" class="form-control-file" />
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button - Centered -->
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-primary">@lang("public.add")</button>
                    </div>
                </div>
            </form>


            <!-- In your create.blade.php -->
            <div class="actor-list" id="response_container">
                <ul class="actor-items"  style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr 1fr;">
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
                        // Parse JSON response
                        var actorNames = response.actorNames;

                        // Prepare HTML for displaying actor names
                        var htmlContent = '<ul class="actor-items">';
                        actorNames.forEach(function(actorName) {
                            htmlContent += '<li>' + actorName + '</li>';
                        });
                        htmlContent += '</ul>';

                        // Display actors' names in the response container
                        $('#response_container').html(htmlContent);
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
