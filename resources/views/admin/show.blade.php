@extends('admin.master')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>@lang("public.details")</b></div>
                <div class="col col-md-6">
                    <a href="{{ route('admin.index') }}"
                       class="btn btn-primary btn-sm float-end">@lang("public.viewall")</a>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">@lang("public.profile")</h5>
            </div>
            <div class="card-body">
                <div class="row">

                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form"><b>@lang("public.name")</b></label>
                            <div class="col-sm-8">
                                {{ $student->student_name }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form"><b>@lang("public.email")</b></label>
                            <div class="col-sm-8">
                                {{ $student->student_email }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form"><b>@lang("public.username")</b></label>
                            <div class="col-sm-8">
                                {{ $student->student_username }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form"><b>@lang("public.birthdate")</b></label>
                            <div class="col-sm-8">
                                {{ $student->student_birthdate }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form"><b>@lang("public.phone")</b></label>
                            <div class="col-sm-8">
                                {{ $student->student_phone }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-label-form"><b>@lang("public.address")</b></label>
                            <div class="col-sm-8">
                                {{ $student->student_address }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="row mb-3">
                            <div class="col-sm-12 text-center">
                                <b>@lang("public.image")</b>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <img src="{{ asset('images/' . $student->student_image) }}" width="200"
                                     class="img-thumbnail"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

@endsection('content')
