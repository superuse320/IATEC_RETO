@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.employee.title_singular') }}
    </div>

    <div class="card-body">
        <form action="{{ route("admin.employees.update", [$employee->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                <label for="first_name">{{ trans('cruds.employee.fields.first_name') }}*</label>
                <input type="text" id="first_name" name="first_name" class="form-control" value="{{ old('first_name', $employee->first_name) }}" required>
                @if($errors->has('first_name'))
                    <p class="help-block">
                        {{ $errors->first('first_name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.employee.fields.first_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                <label for="last_name">{{ trans('cruds.employee.fields.last_name') }}*</label>
                <input type="text" id="last_name" name="last_name" class="form-control" value="{{ old('last_name', $employee->last_name) }}" required>
                @if($errors->has('last_name'))
                    <p class="help-block">
                        {{ $errors->first('last_name') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.employee.fields.last_name_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                <label for="phone">{{ trans('cruds.employee.fields.phone') }}</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}">
                @if($errors->has('phone'))
                    <p class="help-block">
                        {{ $errors->first('phone') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.employee.fields.phone_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                <label for="email">{{ trans('cruds.employee.fields.email') }}</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}">
                @if($errors->has('email'))
                    <p class="help-block">
                        {{ $errors->first('email') }}
                    </p>
                @endif
                <p class="helper-block">
                    {{ trans('cruds.employee.fields.email_helper') }}
                </p>
            </div>
            <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
    <label for="start_date">{{ trans('cruds.employee.fields.start_date') }}</label>
    <input type="datetime-local" id="start_date" name="start_date" class="form-control" value="{{ old('start_date', $employee->start_date ? Carbon\Carbon::parse($employee->start_date)->format('Y-m-d\TH:i') : '') }}">
    @if($errors->has('start_date'))
        <p class="help-block">
            {{ $errors->first('start_date') }}
        </p>
    @endif
    <p class="helper-block">
        {{ trans('cruds.employee.fields.start_date_helper') }}
    </p>
</div>


           
            <div>
                <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')

@stop
