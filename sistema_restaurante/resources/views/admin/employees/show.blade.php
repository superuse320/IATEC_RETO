@extends('layouts.admin')

@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('cruds.employee.title') }}
        </div>

        <div class="card-body">
            <div class="mb-2">
                <table class="table table-bordered table-striped">
                    <tbody>
                      
                        <tr>
                            <th>
                                {{ trans('cruds.employee.fields.first_name') }}
                            </th>
                            <td>
                                {{ $employee->first_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.employee.fields.last_name') }}
                            </th>
                            <td>
                                {{ $employee->last_name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.employee.fields.email') }}
                            </th>
                            <td>
                                {{ $employee->email }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.employee.fields.phone') }}
                            </th>
                            <td>
                                {{ $employee->phone }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.employee.fields.start_date') }}
                            </th>
                           
                            <td>{{ $employee->start_date ? \Carbon\Carbon::parse($employee->start_date)->format('Y-m-d H:i:s') : '' }}</td>
                          
                        </tr>
                       
                        <tr>
                            <th>
                                {{ trans('cruds.employee.fields.user') }}
                            </th>
                            <td>
                                {{ $employee->user ? $employee->user->name : '' }}
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <a style="margin-top:20px;" class="btn btn-default" href="{{ url()->previous() }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>

            <nav class="mb-3">
                <div class="nav nav-tabs">

                </div>
            </nav>
            <div class="tab-content">

            </div>
        </div>
    </div>
@endsection
