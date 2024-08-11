@extends('admin.master')

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
            <form method="post" action=" {{ route('admin.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.name")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_name" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.birthdate")</label>
                            <div class="col-sm-8">
                                <input type="date" name="student_birthdate" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.phone")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_phone" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.address")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_address" class="form-control"/>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.username")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_username" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.email")</label>
                            <div class="col-sm-8">
                                <input type="text" name="student_email" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.password")</label>
                            <div class="col-sm-8">
                                <input type="password" name="student_password" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.confirm")</label>
                            <div class="col-sm-8">
                                <input type="password" name="student_password_confirmation" class="form-control"/>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form">@lang("public.image")</label>
                            <div class="col-sm-8">
                                <input type="file" name="student_image" class="form-control-file"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <button type="submit" class="btn btn-primary">@lang("public.add")</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection('content')
