@extends('admin.index')

@section('content')

    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col col-md-6"><b>@lang('public.data')</b></div>
                <div class="col col-md-6">
                    <a href="{{ route('admin.create') }}" class="btn btn-success btn-sm float-end">@lang('public.add')</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>@lang('public.image')</th>
                    <th>@lang('public.name')</th>
                    <th>@lang('public.email')</th>
                    <th>@lang('public.phone')</th>
                    <th>@lang('public.action')</th>
                </tr>
                @if(count($data) > 0)
                    @foreach($data as $row)
                        <tr>
                            <td><img src="{{ asset('images/' . $row->student_image) }}" width="75"/></td>
                            <td>{{ $row->student_name }}</td>
                            <td>{{ $row->student_email }}</td>
                            <td>{{ $row->student_phone }}</td>
                            <td>
                                <form method="post" action="{{ route('admin.destroy', $row->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.show', $row->id) }}" class="btn btn-primary btn-sm">@lang('public.view')</a>
                                    <a href="{{ route('admin.edit', $row->id) }}" class="btn btn-warning btn-sm">@lang('public.edit')</a>
                                    <input type="submit" class="btn btn-danger btn-sm" value="@lang('public.delete')"/>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">@lang('public.nodatafound')</td>
                    </tr>
                @endif
            </table>
            {!! $data->links() !!}
        </div>
    </div>

@endsection


