@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.vacation_request.title') }}
    </div>

    <div class="card-body">
        <div class="mb-2">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.vacation_request.fields.id') }}
                        </th>
                        <td>
                            {{ $vacationRequest->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacation_request.fields.user') }}
                        </th>
                        <td>
                            {{ $vacationRequest->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacation_request.fields.start_date') }}
                        </th>
                        <td>
                            {{ $vacationRequest->start_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacation_request.fields.description') }}
                        </th>
                        <td>
                            <textarea rows="4" cols="50" readonly>{!! $vacationRequest->description !!}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacation_request.fields.end_date') }}
                        </th>
                        <td>
                            {{ $vacationRequest->end_date }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.vacation_request.fields.status') }}
                        </th>
                        <td>
                            {{ $vacationRequest->status }}
                        </td>
                    </tr>
                </tbody>
            </table>
            @can('vacation_approval')
            <form action="{{ route('admin.vacation.approval', $vacationRequest->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-success">  {{ trans('cruds.vacation_request.fields.approved') }}</button>
</form>

<form action="{{ route('admin.vacation.reject', $vacationRequest->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger">  {{ trans('cruds.vacation_request.fields.rejected') }}</button>
</form>
@endcan
@if ($vacationRequest->status === 'approved')
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#printModal">
                       Recibo
                    </button>
                @endif

       
        </div>
    </div>
</div>


<div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printModalLabel">Recibo De Vacaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="printContent">
              
                <p>Restaurante: Gustov</p>
                <p>Fecha de Solicitud: {{ $vacationRequest->created_at }}</p>
                <p>Carta de Solicitud: {{ $vacationRequest->description}}</p>
                <p>Empleado: {{ $vacationRequest->employee->first_name ?? '' }} {{ $vacationRequest->employee->last_name ?? '' }}</p>
                <p>Aprobado por : {{ $vacationRequest->user->name ?? '' }}</p>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="printContent()">Imprimir</button>
            </div>
        </div>
    </div>
</div>

<script>
  
    function printContent() {
        var printDiv = document.getElementById('printContent').innerHTML;
        var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Recibo de Vacaciones </title></head><body>' + printDiv + '</body></html>');
        printWindow.document.close();
        printWindow.print();
        printWindow.close();
    }
</script>

@endsection 